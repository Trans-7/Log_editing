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

class HistorycalController extends Controller
{
    
    public function index(Request $request){
        if ($request->ajax()) {
            $data = DB::table('master_booth_logediting')->rightJoin(('transaction_logediting'),
                    ('master_booth_logediting.id'), '=', ('transaction_logediting.logeditingboot_id'))
                    ->orderBy('transaction_logediting.id', 'DESC')
                    ->get();
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
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
                                            <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel" style="color:#1b215a;">Detail History</h3>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="panel-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead class="text-center">
                                                                        <tr>
                                                                            <th>Code</th>
                                                                            <th>Booking Editing ID</th>
                                                                            <th>Booking Editing Line</th>
                                                                            <th>Request ID</th>
                                                                            <th>Prabudget ID</th>
                                                                            <th>Login By</th>
                                                                            <th>Login Datetime</th>
                                                                            <th>Status Login</th>
                                                                            <th>Logout Datetime</th>
                                                                            <th>Status Logout</th>
                                                                            <th>Remark</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="table-body text-center">
                                                                        <td>'.$row->logediting_code.'</td>
                                                                        <td>'.$row->logediting_reference_id.'</td>
                                                                        <td>'.$row->logediting_reference_line.'</td>
                                                                        <td>'.$row->logediting_requestid.'</td>
                                                                        <td>'.$row->logediting_prabudgetid.'</td>
                                                                        <td>'.$loginby.'</td>
                                                                        <td>'.$logintime.' '.$logintime2.'</td>
                                                                        <td>'.$login.'</td>
                                                                        <td>'.$logouttime.' '.$logouttime2.'</td>
                                                                        <td>'.$logout.'</td>
                                                                        <td>'.$remark.'</td>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer"><button type="button" class="btn btn-blue btn-md" data-dismiss="modal">Close</button></div>
                                                </div>
                                            </div>
                                        </div>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $data2 = DB::table('HRIS.HRIS.dbo.MasterEisAktif')->get();
        $select_date = $request->get('editing_date');
        $select_shift = $request->get('editing_shift');

        $booth_H = DB::table(DB::raw('master_booth_logediting.*', 'table_1.*'))
        ->from(DB::raw("(SELECT a.*
                         FROM transaction_logediting a
                         WHERE a.logediting_useddate = '".$select_date."'
                         AND a.logediting_usedshift = '".$select_shift."'
                         ) as table_1"))
        ->rightJoin('master_booth_logediting', ('table_1.logeditingboot_id'), '=', ('master_booth_logediting.id'))
        ->where('table_1.logeditingboot_id', '=', NULL)
        ->orderBy('master_booth_logediting.id', 'ASC')
        ->get();
        
        return view('historycal', compact('data2', 'booth_H'));
    }
    public function autocomplete(Request $request)
    {
        $data = [];


        if($request->has('q')){
            $search = $request->q;
            $data = DB::table('HRIS.HRIS.dbo.MasterEisAktif')
            		->select('NIK', 'Nama')
            		->where('NIK','LIKE',"%$search%")
            		->get();
        }

        return response()->json($data);
    }

    public function autofill_editor(Request $request)
    {
        
        $editor_nik = $request->get('editor_nik');
        $data = DB::table('HRIS.HRIS.dbo.MasterEisAktif')
                    ->where('NIK', $editor_nik)
                    ->select('Nama', 'NomorHP')
                    ->get();
        echo $data;
    }

    public function update(Request $request) {
        $item_id = $request->post('id');
        $item = Transaction_logediting::find($item_id);
        if(empty($item)) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found!',
            ], 404);
        } else {
            $item->logediting_editor_nik = $request->post('logediting_editor_nik');
            $item->logediting_editor_name = $request->post('logediting_editor_name');
            $item->logediting_editor_phone = $request->post('logediting_editor_phone');
            $item->logediting_useddate = $request->post('logediting_useddate');
            $item->logediting_usedshift = $request->post('logediting_usedshift');
            $item->logeditingboot_id = $request->post('nama_booth');
            $item->save();
            return response()->json([
                'success' => true,
                'message' => 'Item successfully updated.',
            ], 200);
        }
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
    
}
