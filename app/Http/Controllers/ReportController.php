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
        $report = Transaction_report::orderBy('logeditingreport_id', 'ASC')->orderBy('logeditingreport_date','ASC')->orderBy('logeditingreport_shift','ASC')->get();
        $priviledge_R = User::select('logeditingpriviledge_nik','logeditingpriviledge_level')->where('logeditingpriviledge_level',1)->first();
        return view('report', compact('report','priviledge_R'));
    }
    public function export_excel(){
        $nama_file = 'Report_Logediting_'.date('Y-m-d').'.xlsx';
        return Excel::download(new ReportExport, $nama_file);
    }
    public function fetch_data(Request $request){
        if($request->ajax()){
            $start = Carbon::parse($request->from_date)->startOfDay();
            $end = Carbon::parse($request->to_date)->endOfDay();
            $nik = $request->nik;
            $name = $request->name;
            $program = $request->program;
            $kerja = $request->kerja;
            if($nik != '' || $name != '' || $program != '' || $kerja != ''){
                $data = Transaction_report::where('logeditingreport_editor_nik','like',"%".$nik."%")
                ->where('logeditingreport_editor_name','like',"%".$name."%")
                ->where('logeditingreport_program','like',"%".$program."%")
                ->where('logeditingreport_systemkerja','like',"%".$kerja."%")
                // ->where('logeditingreport_date', '>=', $start->toDateTimeString())
                // ->where('logeditingreport_date', '<=', $end->toDateTimeString())
                ->orderBy('logeditingreport_date','DESC')
                ->orderBy('logeditingreport_shift','ASC')
                ->get();
            }else if($start != '' && $end != ''){
                $data = Transaction_report::where('logeditingreport_date', '>=', $start->toDateTimeString())
                ->where('logeditingreport_date', '<=', $end->toDateTimeString())
                ->orderBy('logeditingreport_date','DESC')
                ->orderBy('logeditingreport_shift','ASC')
                ->get();
            }
            else
            {
                $data = Transaction_report::orderBy('logeditingreport_date','DESC')->orderBy('logeditingreport_shift','ASC')->get();
            }
            echo json_encode($data);
        }
    }
}
