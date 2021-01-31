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
    public function export_excel(Request $request){
        return Excel::download(new ReportExport, 'Report_Logediting.xlsx');
    }
    public function fetch_data(Request $request){
        if($request->ajax()){
            $start = Carbon::parse($request->from_date)->startOfDay();
            $end = Carbon::parse($request->to_date)->endOfDay();
            if($start != '' && $end != ''){
                $data = Transaction_report::where('logeditingreport_date', '>=', $start->toDateTimeString())->where('logeditingreport_date', '<=', $end->toDateTimeString())->orderBy('logeditingreport_id', 'ASC')->orderBy('logeditingreport_date','ASC')->orderBy('logeditingreport_shift','ASC')->get();
            }
            else
            {
                $data = Transaction_report::orderBy('logeditingreport_id', 'ASC')->orderBy('logeditingreport_date','ASC')->orderBy('logeditingreport_shift','ASC')->get();
            }
            echo json_encode($data);
        }
    }
    public function fetch_dataNIK(Request $request){
        if($request->ajax()){
            $nik = $request->nik;
            if($nik != ''){
                $data = Transaction_report::where('logeditingreport_editor_nik','like',"%".$nik."%")->orderBy('logeditingreport_id', 'ASC')->orderBy('logeditingreport_date','ASC')->orderBy('logeditingreport_shift','ASC')->get();
                
            }
            else
            {
                $data = Transaction_report::orderBy('logeditingreport_id', 'ASC')->orderBy('logeditingreport_date','ASC')->orderBy('logeditingreport_shift','ASC')->get();
            }
            echo json_encode($data);
        }
    }
    public function fetch_dataName(Request $request){
        if($request->ajax()){
            $name = $request->name;
            if($name != ''){
                $data = Transaction_report::where('logeditingreport_editor_name','like',"%".$name."%")->orderBy('logeditingreport_id', 'ASC')->orderBy('logeditingreport_date','ASC')->orderBy('logeditingreport_shift','ASC')->get();
                
            }
            else
            {
                $data = Transaction_report::orderBy('logeditingreport_id', 'ASC')->orderBy('logeditingreport_date','ASC')->orderBy('logeditingreport_shift','ASC')->get();
            }
            echo json_encode($data);
        }
    }
    public function fetch_dataProgram(Request $request){
        if($request->ajax()){
            $program = $request->program;
            if($program != ''){
                $data = Transaction_report::where('logeditingreport_program','like',"%".$program."%")->orderBy('logeditingreport_id', 'ASC')->orderBy('logeditingreport_date','ASC')->orderBy('logeditingreport_shift','ASC')->get();
                
            }
            else
            {
                $data = Transaction_report::orderBy('logeditingreport_id', 'ASC')->orderBy('logeditingreport_date','ASC')->orderBy('logeditingreport_shift','ASC')->get();
            }
            echo json_encode($data);
        }
    }
    public function fetch_dataKerja(Request $request){
        if($request->ajax()){
            $kerja = $request->kerja;
            if($kerja != ''){
                $data = Transaction_report::where('logeditingreport_systemkerja','like',"%".$kerja."%")->orderBy('logeditingreport_id', 'ASC')->orderBy('logeditingreport_date','ASC')->orderBy('logeditingreport_shift','ASC')->get();
                
            }
            else
            {
                $data = Transaction_report::orderBy('logeditingreport_id', 'ASC')->orderBy('logeditingreport_date','ASC')->orderBy('logeditingreport_shift','ASC')->get();
            }
            echo json_encode($data);
        }
    }
}
