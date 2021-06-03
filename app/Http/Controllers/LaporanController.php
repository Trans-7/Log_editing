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

class LaporanController extends Controller
{
    public function laporan(){
        return view('laporan');
    }
    public function export() 
    {
        /*request
            inpput text sercing
        */

        return Excel::download(new ReportExport, 'log_harian.xlsx');
    }
    public function fetch_data_laporan(Request $request){
        if($request->ajax()){

            $start = $request->start;
            $end = $request->end;
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
                ->orderBy('logeditingreport_id', 'DESC')
                ->orderBy('logeditingreport_date','DESC')
                ->orderBy('logeditingreport_shift','DESC')
                ->get();
            }else if($start != '' && $end != ''){
                $data = Transaction_report::where('logeditingreport_date', '>=', array($start))
                ->where('logeditingreport_date', '<=', array($end))
                ->orderBy('logeditingreport_id', 'DESC')
                ->orderBy('logeditingreport_date','DESC')
                ->orderBy('logeditingreport_shift','DESC')
                ->get();
            }else{
                $data = Transaction_report::orderBy('logeditingreport_id', 'DESC')->orderBy('logeditingreport_date','DESC')->orderBy('logeditingreport_shift','DESC')->get();
            }
            echo json_encode($data);
        }
    }
}
