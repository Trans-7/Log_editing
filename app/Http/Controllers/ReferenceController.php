<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Transaction_logediting;
use App\Transaction_bookingediting;
use App\Transaction_bookingeditingdetail;
use App\Transaction_logeditingpriviledge;
use App\User;
use DataTables;


class ReferenceController extends Controller
{
    public function reference(Request $request)
    {
        $reference_N = Transaction_logediting::orderBy('logediting_generateddate', 'DESC')->where('logediting_isreferenced',1)->where('logediting_generatedby', session()->get('nik'))->paginate(10);
        $reference_R = Transaction_bookingediting::orderBy('bookingediting_id', 'DESC')->get();
        $reference_R2 = Transaction_bookingediting::select('show_name')
                        ->where('bookingediting_createddate','>=','2020-02-08')
                        ->distinct()
                        ->orderBy('show_name', 'asc')
                        ->get();
        $data_R = Transaction_logediting::latest('id')->first();
        return view('reference', compact('reference_N', 'reference_R','data_R', 'reference_R2'));
        
    }
    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('transaction_bookingediting')
                    ->leftJoin(('relation_bookingediting_editingrequest'),
                    ('transaction_bookingediting.bookingediting_id'),'=',('relation_bookingediting_editingrequest.bookingediting_id'))
                    ->where('transaction_bookingediting.bookingediting_createddate','>=','2020-02-08')
                    ->where($select, $value)
                    ->orderBy($dependent, 'DESC')
                    ->select($dependent)
                    ->distinct()
                    ->get();
        $output = '<option value="">--Selected--</option>';
        foreach($data as $row){
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
            // $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent." "."( "." Date: ".date('d M Y', strtotime($row->bookingeditingdetail_date))." , "." Shift: ".$row->bookingeditingdetail_shift." )".'</option>'; 
        }
        echo $output;
            
    }

    public function fetchs(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('transaction_bookingeditingdetail')
                    ->leftJoin(('transaction_bookingediting'),
                    ('transaction_bookingeditingdetail.bookingediting_id'),'=',('transaction_bookingediting.bookingediting_id'))
                    ->where('transaction_bookingediting.bookingediting_createddate','>=','2020-02-08')
                    ->where($select, $value)
                    ->orderBy($dependent, 'DESC')
                    ->select($dependent, 'transaction_bookingeditingdetail.bookingeditingdetail_date', 'transaction_bookingeditingdetail.bookingeditingdetail_shift')
                    ->distinct()
                    ->get();
        $output = '<option value="">--Selected--</option>';
        foreach($data as $row){
            // $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent." "."( "." Date: ".date('d M Y', strtotime($row->bookingeditingdetail_date))." , "." Shift: ".$row->bookingeditingdetail_shift." )".'</option>'; 
        }
        echo $output;
            
    }

    public function autofill(Request $request)
    {
        
        $show_name = $request->get('show_name');
        $booking_line = $request->get('booking_line');
        $request_id = $request->get('request_id');
        $bookingediting_ref_id = $request->get('bookingediting_ref_id');
        $data = DB::table('transaction_bookingeditingdetail')
                    ->leftJoin(('transaction_bookingediting'),
                    ('transaction_bookingeditingdetail.bookingediting_id'), '=', ('transaction_bookingediting.bookingediting_id'))
                    ->where('transaction_bookingediting.bookingediting_createddate','>=','2020-02-08')
                    ->where('show_name', $show_name)
                    ->where('bookingeditingdetail_line', $booking_line)
                    ->where('bookingediting_ref_id', $bookingediting_ref_id)
                    ->select('transaction_bookingediting.bookingediting_id', 'transaction_bookingeditingdetail.eps_code', 'transaction_bookingeditingdetail.bookingeditingdetail_date', 'transaction_bookingeditingdetail.bookingeditingdetail_shift')
                    ->get();
        echo $data;
    }
    public function store_R(Request $request)
    {
        // insert data ke table 
        $time = str_pad(substr(microtime(true), 11,3), 3, STR_PAD_RIGHT);
        DB::table('transaction_logediting')->insert([
            'logediting_code' => date('H').substr(date('Y'), -2).date('i').date('m').date('s').date('d').$time,
            'logediting_reference_id' => $request->bookingediting_id,
            'logediting_reference_line' => $request->bookingeditingdetail_line,
            'logediting_reference_code' => $request->kode_eps,
            'logediting_useddate' => $request->editing_date ,
            'logediting_usedshift' => $request->editing_shift,
            'logediting_isreferenced' => 1,
            'logediting_generatedby' => $request->session()->get('nik'),
            'logediting_generateddate' => date('Y-m-d H:i:s.').$time,
            'logediting_generatedtime' => date('H:i:s.').$time,
            'logediting_program' => $request->show_name,
            'logediting_requestid' => $request->request_id,
            'logediting_prabudgetid' => $request->bookingediting_ref_id
            //sisanya null
        ]);
        
        return redirect('/');
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction_logediting::orderBy('logediting_generateddate', 'DESC')
                    ->where('logediting_isreferenced',1)
                    ->where('logediting_generatedby', session()->get('nik'))
                    ->select('*')
                    ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            //kondisi untuk nama program
                            if ($row->logediting_program != NULL){
                                $program = $row->logediting_program;
                            }else{
                                $program = "- -";
                            }  
                            //kondisi untuk status login
                            if ($row->logediting_logindate != NULL){
                                $login = "Sudah Login";
                            }else{
                                $login = "Belum Login";
                            } 
                            //kondisi untuk login by
                            if (($row->logediting_loginnik != NULL) && ($row->logediting_loginname != NULL)){
                                $loginby = $row->logediting_loginnik.' / '.$row->logediting_loginname;
                            }else{
                                $loginby = "- -";
                            } 
                            //kondisi untuk login time
                            if ($row->logediting_logindate != NULL){
                                $logintime = date('d M Y', strtotime($row->logediting_logindate));
                            }else{
                                $logintime = "-";
                            } 
                            if ($row->logediting_logintime != NULL){
                                $logintime2 = $row->logediting_logintime;
                            }else{
                                $logintime2 = "-";
                            }
                            //kondisi untuk status logout
                            if ($row->logediting_logoutdate != NULL){
                                $logout = "Sudah Logout";
                            }else{
                                $logout = "Belum Logout";
                            }
                            //kondisi untuk logout time
                            if ($row->logediting_logoutdate != NULL){
                                $logouttime = date('d M Y', strtotime($row->logediting_logoutdate));
                            }else{
                                $logouttime = "-";
                            } 
                            if ($row->logediting_logouttime != NULL){
                                $logouttime2 = $row->logediting_logouttime;
                            }else{
                                $logouttime2 = "-";
                            }
                            //kondisi untuk remark
                            if ($row->logediting_remark != NULL){
                                $remark = $row->logediting_remark;
                            }else{
                                $remark = "- -";
                            }

                           $btn = '<button type="button" class="btn btn-blue btn-sm" data-toggle="modal" data-target="#show-user-'.$row->id.'">View Detail</button>
                                        <div class="modal fade" id="show-user-'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel" style="color:#1b215a;">Detail Login Status</h3>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row m-1">
                                                            <div class="col-sm-4 col-form-label">
                                                                <p style="font-size:17px;">Code</p>
                                                            </div>
                                                            <div class="col-sm-8 col-form-label">
                                                                <p style="font-size:17px;">'.$row->logediting_code.'</p>
                                                            </div>
                                                            <div class="col-sm-4 col-form-label">
                                                                <p style="font-size:17px;">Program Name</p>
                                                            </div>
                                                            <div class="col-sm-8 col-form-label">
                                                                <p style="font-size:17px;">'.$program.'</p>
                                                            </div>
                                                            <div class="col-sm-4 col-form-label">
                                                                <p style="font-size:17px;">Status Login</p>
                                                            </div>
                                                            <div class="col-sm-8 col-form-label">
                                                                <p style="font-size:17px;">'.$login.'</p>
                                                            </div>
                                                            <div class="col-sm-4 col-form-label">
                                                                <p style="font-size:17px;">Login By</p>
                                                            </div>
                                                            <div class="col-sm-8 col-form-label">
                                                                <p style="font-size:17px;">'.$loginby.'</p>
                                                            </div>
                                                            <div class="col-sm-4 col-form-label">
                                                                <p style="font-size:17px;">Login Time</p>
                                                            </div>
                                                            <div class="col-sm-8 col-form-label">
                                                                <p style="font-size:17px;">'.$logintime.' '.$logintime2.'</p>
                                                            </div>
                                                            <div class="col-sm-4 col-form-label">
                                                                <p style="font-size:17px;">Status Logout</p>
                                                            </div>
                                                            <div class="col-sm-8 col-form-label">
                                                                <p style="font-size:17px;">'.$logout.'</p>
                                                            </div>
                                                            <div class="col-sm-4 col-form-label">
                                                                <p style="font-size:17px;">Logout Time</p>
                                                            </div>
                                                            <div class="col-sm-8 col-form-label">
                                                                <p style="font-size:17px;">'.$logouttime.' '.$logouttime2.'</p>
                                                            </div>
                                                            <div class="col-sm-4 col-form-label">
                                                                <p style="font-size:17px;">Remark Logout</p>
                                                            </div>
                                                            <div class="col-sm-8 col-form-label">
                                                                <p style="font-size:17px;">'.$remark.'</p>
                                                            </div>
                                                        </div
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
       
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('reference');
    }
}

