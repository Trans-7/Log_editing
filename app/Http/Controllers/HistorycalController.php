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
use Validator;

class HistorycalController extends Controller
{
    
    public function index(Request $request){
        if ($request->ajax()) {
            $data = DB::table('transaction_logediting')->leftJoin(('master_booth_logediting'),
                    ('transaction_logediting.logeditingboot_id'), '=', ('master_booth_logediting.id'))
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
                                                                            <th>Editing Date</th>
                                                                            <th>Editing Shift</th>
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
                                                                        <td>'.$row->logediting_useddate.'</td>
                                                                        <td>'.$row->logediting_usedshift.'</td>
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

                                // $btn = $btn.'&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$row->id.'" class="edit btn btn-blue btn-sm">Edit Detail</button>';

                                        $btn = $btn.'<center><p><a href="javascript:void(0)"><button type="button" name="edit" class="btn btn-blue btn-sm" data-toggle="modal" data-target="#edit'.$row->id.'">Edit Detail</button></a></p></center>
                                        <div class="modal fade" id="edit'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel" style="color:#1b215a;">Edit History</h3>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span id="form_result"></span>
                                                        <form method="post" id="sample_form" class="form-horizontal">
                                                            <div class="form-group">
                                                                <label for="editor-nik" class="col-form-label">Editor NIK:</label>
                                                                    <select name="editor_nik" id="editor_nik" class="form-control">
                                                                        <option value="" selected="false">--Select Editor NIK--</option>
                                                                        <option value="" selected="false">'.$row->logediting_editor_nik.'</option>
                                                                    </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editor-name" class="col-form-label">Editor Name:</label>
                                                                <input type="text" class="form-control" id="editor-name" value="'.$row->logediting_editor_name.'">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editor-phone" class="col-form-label">Editor Phone:</label>
                                                                <input type="text" class="form-control" id="editor-phone" value="'.$row->logediting_editor_phone.'">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editor-booth" class="col-form-label">Editor Booth:</label>
                                                                <select name="booth" id="booth" class="form-control">
                                                                    <option value="" selected="false">--Select Booth--</option>
                                                                    <option value="" selected="false">'.$row->nama_booth.'</option>
                                                                </select>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="form-group" align="center">
                                                            <input type="hidden" name="action" id="action" value="Edit" />
                                                            <input type="hidden" name="hidden_id" id="hidden_id" />
                                                            <button type="submit" name="action_button" id="action_button" class="btn btn-blue btn-md edit">Edit</button>
                                                            <button type="button" class="btn btn-blue btn-md" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('historycal');
    }
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Transaction_logediting::leftJoin(('master_booth_logediting'),('transaction_logediting.logeditingboot_id'), '=', ('master_booth_logediting.id'))
                    ->findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }
    public function update(Request $request)
    {
        Transaction_logediting::leftJoin(('master_booth_logediting'),('transaction_logediting.logeditingboot_id'), '=', ('master_booth_logediting.id'))
                ->updateOrCreate(['id' => $request->hidden_id],
                ['logediting_editor_nik' => $request->editor_nik,
                 'logediting_editor_name' => $request->editor_name,
                 'logediting_editor_phone' => $request->editor_phone,
                 'nama_booth' => $request->booth
                ]);        

        return response()->json(['success'=>'Customer saved successfully!']);

    }
}
