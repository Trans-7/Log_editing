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

class ReportController extends Controller
{
    public function report(){
        
        $report = Transaction_logediting::leftJoin(('master_booth_logediting'),
                ('transaction_logediting.logeditingboot_id'),'=',('master_booth_logediting.id'))
                // ->select('logediting_generateddate')
                // ->where('logediting_generateddate', '>=', '2021-04-06')
                ->distinct()
                ->orderBy('logediting_useddate', 'asc')
                // ->orderBy('transaction_logediting.id', 'DESC')
                ->get();
        $priviledge_R = User::select('logeditingpriviledge_nik','logeditingpriviledge_level')->where('logeditingpriviledge_level',1)->first();
        return view('report', compact('report','priviledge_R'));
    }

    public function fetch_data(Request $request){
        if($request->ajax()){
            $start = $request->start;
            $end = $request->end;
            // $end = Carbon::parse($request->to_date)->endOfDay();
            

            if($start != '' && $end != ''){
                $data = Transaction_logediting::leftJoin(('master_booth_logediting'),
                        ('transaction_logediting.logeditingboot_id'),'=',('master_booth_logediting.id'))
                        ->where('logediting_useddate', '>=', array($start))
                        ->where('logediting_useddate', '<=', array($end))
                        // ->distinct()
                        ->orderBy('transaction_logediting.logediting_editor_name', 'ASC')
                        ->orderBy('transaction_logediting.logediting_useddate', 'DESC')
                        ->select('*')
                        ->get();
            }
            else{
                $data = Transaction_logediting::leftJoin(('master_booth_logediting'),
                            ('transaction_logediting.logeditingboot_id'),'=',('master_booth_logediting.id'))
                            // ->distinct()
                            ->orderBy('transaction_logediting.logediting_useddate', 'DESC')
                            ->select('*')
                            ->get();
            }
            
            echo json_encode($data);
        }
    }
}
