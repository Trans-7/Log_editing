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
    public function autocomplete_laporan(Request $request)
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
    public function export(Request $request)
    {
        /*request
            inpput text sercing
        */
        // $method = $req->method();
        // if ($req->isMethod('post')){
        //     $program = $req->input('program');
        //     if($req->has('exportExcel')){
        //         return Excel::download(new ReportExport($program), 'log_harian.xlsx');
        //     }
        // }
        // if($request->ajax()){
        //     $nik = $request->nik;
        //     $name = $request->name;
        //     $program = $request->program;
        //     $kerja = $request->kerja;
        //     if ($nik != '' || $name != '' || $program != '' || $kerja != ''){
        //         return Excel::download(new ReportExport($nik, $name, $program, $kerja), 'log_harian.xlsx');
        //     }
        // }
        // $method = $request->method();
        // if ($request->isMethod('POST')){
        //     $program = $request->get('program');
        //     if($request->has('export')){
        //         return Excel::download(new ReportExport($program), 'log_harian.xlsx');
        //         // return view('laporan');
        //         // Excel::download(new ReportExport($start, $end), 'log_harian.xlsx');
        //     }
        // }
        // $nik = $request->get('nik', '');
        // $name = $request->get('name', '');
        // if ($request->isMethod('post')) {
        //     return Excel::download(new ReportExport('ssj'), 'log_harian.xlsx');
        // }
        $program = $request->get('program','ssj');
        // $program = Request::post('program');
        // dd($program);exit();
        return Excel::download(new ReportExport($program), 'log_harian.xlsx');
        // if($request->has('export')){
        //     $program = $_POST('program');
        //     dd($program);exit();
        // }
        // echo $program;
        // $kerja = $request->get('kerja', '');

        // $program = Input::get('program');
        // dd($name);exit();
        // return Excel::download(new ReportExport($nik, $name, $program, $kerja), 'log_harian.xlsx');
        
        // return Excel::download(new ReportExport($program), 'log_harian_'.$program.'.xlsx');
        // return (new ReportExport())->download('log_harian.xlsx');
        // return (new ReportExport(2021))->download('log_harian.xlsx');
        // return (new ReportExport)->forYear('2021-05-11')->download('log_harian.xlsx');
        
        
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
