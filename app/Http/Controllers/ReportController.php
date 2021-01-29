<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\User;
use App\Transaction_report;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function report(){
        $report = Transaction_report::orderBy('logeditingreport_id', 'asc')->get();
        $priviledge_R = User::select('logeditingpriviledge_nik','logeditingpriviledge_level')->where('logeditingpriviledge_level',1)->first();
        return view('report', compact('report','priviledge_R'));
    }
    public function export_excel(){
		return Excel::download(new ReportExport, 'Report_Logediting.xlsx');
    }
    public function fetch_data(Request $request){
        if($request->ajax()){
            $start = Carbon::parse($request->from_date)->startOfDay();
            $end = Carbon::parse($request->to_date)->endOfDay(); 
            if($start != '' && $end != ''){
                $data = Transaction_report::whereBetween(('logeditingreport_date'), [$start, $end])->get();
            }
            else
            {
                $data = Transaction_report::orderBy('logeditingreport_date','asc')->get();
            }
            echo json_encode($data);
        }
    }
}
