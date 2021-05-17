<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Transaction_logediting;
use App\Transaction_bookingediting;
use App\Transaction_bookingeditingdetail;
use App\Transaction_logeditingpriviledge;
use App\User;
use DataTables;

class NonReferenceController extends Controller
{
    public function non_reference(Request $request){
        $non_reference_N = Transaction_logediting::orderBy('logediting_generateddate', 'DESC')->where('logediting_isreferenced',0)->where('logediting_generatedby', session()->get('nik'))->paginate(10);
        $non_reference_R = Transaction_bookingediting::orderBy('bookingediting_id', 'DESC')->get();
        $non_reference_R2 = Transaction_bookingediting::select('show_name')
                            ->where('bookingediting_createddate','>=','2020-02-08')
                            ->distinct()
                            ->orderBy('show_name', 'asc')
                            ->get();
        $data_N = Transaction_logediting::latest('id')->first();
        $user_NR = DB::table('HRIS.HRIS.dbo.MasterEisAktif')->get();

        //select list booth
        $select_date = $request->get('editing_date');
        $select_shift = $request->get('editing_shift');
        
        $booth_NR = DB::table(DB::raw('master_booth_logediting.*', 'table_1.*'))
        ->from(DB::raw("(SELECT a.*
                         FROM transaction_logediting a
                         WHERE a.logediting_useddate = '".$select_date."'
                         AND a.logediting_usedshift = '".$select_shift."'
                         ) as table_1"))
        ->rightJoin('master_booth_logediting', ('table_1.logeditingboot_id'), '=', ('master_booth_logediting.id'))
        ->where('table_1.logeditingboot_id', '=', NULL)
        ->orderBy('master_booth_logediting.id', 'ASC')
        ->get();
        return view('non_reference', compact('non_reference_N', 'non_reference_R', 'data_N', 'non_reference_R2', 'user_NR', 'booth_NR'));
    }
    public function fetch_NR(Request $request)
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
    public function fetchs_NR(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('transaction_bookingeditingdetail')
                    ->leftJoin(('transaction_bookingediting'),
                    ('transaction_bookingeditingdetail.bookingediting_id'),'=',('transaction_bookingediting.bookingediting_id'))
                    ->where('transaction_bookingediting.bookingediting_createddate','>=','2020-02-08')
                    ->where($select, $value)
                    ->orderBy('transaction_bookingeditingdetail.bookingeditingdetail_date', 'DESC')
                    ->select($dependent, 'transaction_bookingeditingdetail.bookingeditingdetail_date', 'transaction_bookingeditingdetail.bookingeditingdetail_shift')
                    ->distinct()
                    ->get();
        $output = '<option value="">--Selected--</option>';
        foreach($data as $row){
            // $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
            $output .= '<option value="'.$row->$dependent.'">'." Date: ".date('d M Y', strtotime($row->bookingeditingdetail_date))." , "." Shift: ".$row->bookingeditingdetail_shift.'</option>'; 
        }
        echo $output;
            
    }
    public function autofill_NR(Request $request)
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
    public function booth(Request $request){
        
        $select_date = $request->get('editing_date');
        $select_shift = $request->get('editing_shift');
        
        $data = DB::table(DB::raw('master_booth_logediting.*', 'table_1.*'))
        ->from(DB::raw("(SELECT a.*
                         FROM transaction_logediting a
                         WHERE a.logediting_useddate = '".$select_date."'
                         AND a.logediting_usedshift = '".$select_shift."'
                         ) as table_1"))
        ->rightJoin('master_booth_logediting', ('table_1.logeditingboot_id'), '=', ('master_booth_logediting.id'))
        ->where('table_1.logeditingboot_id', '=', NULL)
        ->orderBy('master_booth_logediting.id', 'ASC')
        ->select('master_booth_logediting.id', 'master_booth_logediting.nama_booth')
        ->get();

        // echo $data;
        $output = '<option value="">--Select Booth--</option>';
        foreach($data as $row){
            $output .= '<option value="'.$row->id.'">'.$row->nama_booth.'</option>';
            // $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent." "."( "." Date: ".date('d M Y', strtotime($row->bookingeditingdetail_date))." , "." Shift: ".$row->bookingeditingdetail_shift." )".'</option>'; 
        }
        echo $output;
    }
    public function autocomplete(Request $request)
    {
        $data = [];


        if($request->has('q')){
            $search = $request->q;
            $data = DB::table('HRIS.HRIS.dbo.MasterEisAktif')
            		->select('NIK', 'Nama')
            		->where('Nama','LIKE',"%$search%")
                    ->orwhere('NIK', 'LIKE',"%$search%")
            		->get();
        }

        return response()->json($data);
    }
    public function autocomplete_program(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = Transaction_bookingediting::select('show_name')
                    ->where('bookingediting_createddate','>=','2020-02-08')
                    ->where('show_name','LIKE',"%$search%")
                    ->distinct()
                    // ->orderBy('show_name', 'asc')
                    ->get();
            		
        }

        return response()->json($data);
    }

    public function autofill_editorNR(Request $request)
    {
        
        $editor_nik = $request->get('editor_nik');
        $data = DB::table('HRIS.HRIS.dbo.MasterEisAktif')
                    ->where('NIK', $editor_nik)
                    ->select('Nama', 'NomorHP')
                    ->get();
        echo $data;
    }

    public function store_NR(Request $request)
    {
        // insert data ke table 
        // date_default_timezone_set('Asia/Jakarta');
        $time = str_pad(substr(microtime(true), 12,3), 3, STR_PAD_RIGHT);
        DB::table('transaction_logediting')->insert([
            'logediting_code' =>date('H').substr(date('Y'), -2).date('i').date('m').date('s').date('d').$time,
            'logediting_useddate' => $request->editing_date,
            'logediting_usedshift' => $request->editing_shift,
            'logediting_reference_id' => $request->bookingediting_id,
            'logediting_reference_line' => $request->bookingeditingdetail_line,
            'logediting_reference_code' => $request->kode_eps,
            'logediting_reason' => $request->editing_reason,
            'logediting_isreferenced' => 0,
            'logediting_generatedby' => $request->session()->get('nik'),
            'logediting_generateddate' => date('Y-m-d H:i:s.').$time,
            'logediting_generatedtime' => date('H:i:s.').$time,
            'logediting_program' => $request->show_name,
            'logediting_requestid' => $request->request_id,
            'logediting_prabudgetid' => $request->bookingediting_ref_id,
            'logediting_editor_nik' => $request->editor_nik,
            'logediting_editor_name' => $request->editor_name,
            'logediting_editor_phone' => $request->editor_phone,
            'logeditingboot_id' => $request->booth

            //sisanya null
        ]);
        return redirect('/non_reference');
    }
    public function search_N(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction_logediting::leftJoin(('master_booth_logediting'),
                    ('transaction_logediting.logeditingboot_id'), '=', ('master_booth_logediting.id'))
                    ->orderBy('logediting_generateddate', 'DESC')
                    ->where('logediting_isreferenced',0)
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
                            //kondisi untuk editor nik
                            if ($row->logediting_editor_nik != NULL){
                                $editor_nik = $row->logediting_editor_nik;
                            }else{
                                $editor_nik = "- -";
                            }  
                            //kondisi untuk editor name
                            if ($row->logediting_editor_name != NULL){
                                $editor_name = $row->logediting_editor_name;
                            }else{
                                $editor_name = "- -";
                            } 
                            //kondisi untuk editor phone
                            if ($row->logediting_editor_phone != NULL){
                                $editor_phone = $row->logediting_editor_phone;
                            }else{
                                $editor_phone = "- -";
                            }
                            //kondisi untuk booth
                            if ($row->logeditingboot_id != NULL){
                                $editor_booth = $row->nama_booth;
                            }else{
                                $editor_booth = "- -";
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

                           $btn = '<center><p><button type="button" class="btn btn-blue btn-sm" data-toggle="modal" data-target="#show-user-'.$row->id.'">View Detail</button></p></center>
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
                                                                <p style="font-size:17px;">Editor NIK</p>
                                                            </div>
                                                            <div class="col-sm-8 col-form-label">
                                                                <p style="font-size:17px;">'.$editor_nik.'</p>
                                                            </div>
                                                            <div class="col-sm-4 col-form-label">
                                                                <p style="font-size:17px;">Editor Name</p>
                                                            </div>
                                                            <div class="col-sm-8 col-form-label">
                                                                <p style="font-size:17px;">'.$editor_name.'</p>
                                                            </div>
                                                            <div class="col-sm-4 col-form-label">
                                                                <p style="font-size:17px;">Editor Phone</p>
                                                            </div>
                                                            <div class="col-sm-8 col-form-label">
                                                                <p style="font-size:17px;">'.$editor_phone.'</p>
                                                            </div>
                                                            <div class="col-sm-4 col-form-label">
                                                                <p style="font-size:17px;">Booth</p>
                                                            </div>
                                                            <div class="col-sm-8 col-form-label">
                                                                <p style="font-size:17px;">'.$editor_booth.'</p>
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
        
        return view('non_reference');
    }
}
