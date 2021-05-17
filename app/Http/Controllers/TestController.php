<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\User;
use App\Transaction_report;
use App\Transaction_logediting;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function test(){
        
        $test = Transaction_logediting::leftJoin(('master_booth_logediting'),
                ('transaction_logediting.logeditingboot_id'),'=',('master_booth_logediting.id'))
                ->orderBy('transaction_logediting.id', 'DESC')
                ->get();
        $test2 = DB::table('master_booth_logediting')->get();
        
        return view('test', compact('test', 'test2'));
    }
    public function fetch_data_test(Request $request){
        if($request->ajax()){
            $start = $request->start;
            $end = $request->end;

            if($start != '' && $end != ''){
                $data = Transaction_logediting::leftJoin(('master_booth_logediting'),
                        ('transaction_logediting.logeditingboot_id'),'=',('master_booth_logediting.id'))
                        ->where('logediting_useddate', '>=', array($start))
                        ->where('logediting_useddate', '<=', array($end))
                        
                        ->orderBy('transaction_logediting.nama_booth', 'ASC')
                        // ->select('logediting_editor_name')
                        // ->groupBy('logediting_editor_name')
                        ->select('*')
                        ->get();
            }
            else{
                $data = Transaction_logediting::leftJoin(('master_booth_logediting'),
                        ('transaction_logediting.logeditingboot_id'),'=',('master_booth_logediting.id'))
                        ->orderBy('transaction_logediting.logediting_editor_name')
                        ->select('*')
                        ->get();
            }
            
            echo json_encode($data);
        }
    }
}
