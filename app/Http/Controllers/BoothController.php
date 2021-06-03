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

class BoothController extends Controller
{
    public function booth(){
        
        $test = Transaction_logediting::leftJoin(('master_booth_logediting'),
                ('transaction_logediting.logeditingboot_id'),'=',('master_booth_logediting.id'))
                ->orderBy('transaction_logediting.id', 'DESC')
                ->get();
        $test2 = DB::table('master_booth_logediting')->get();
        
        return view('booth', compact('test', 'test2'));
    }
    public function fetch_data_booth(Request $request){
        if($request->ajax()){
            $start = $request->start;
            $end = $request->end;

            if($start != '' && $end != ''){
                $report = Transaction_logediting::leftJoin(('master_booth_logediting'),
                        ('transaction_logediting.logeditingboot_id'),'=',('master_booth_logediting.id'))
                        ->where('logediting_useddate', '>=', array($start))
                        ->where('logediting_useddate', '<=', array($end))
                        ->orderBy('transaction_logediting.logeditingboot_id', 'ASC')
                        ->orderBy('transaction_logediting.logediting_useddate', 'ASC')
                        ->orderBy('transaction_logediting.logediting_usedshift', 'ASC')
                        ->get();

                $data_json = array();
                foreach ($report as $t){
                    $data_json[]=  array(
                                    "Nama" => $t->logediting_editor_name,
                                    "NIK" => $t->logediting_editor_nik,
                                    "Telp" => $t->logediting_editor_phone,
                                    "Nama" => $t->logediting_editor_name,
                                    "Tanggal" => date('Y-m-d', strtotime($t->logediting_useddate)),
                                    "Program" => $t->logediting_program,
                                    "Shift" =>  $t->logediting_usedshift,
                                    "Booth" => $t->nama_booth,
                                    "Type_booth" => $t->type_booth
                    );
                }
                $booth = Transaction_logediting::leftJoin(('master_booth_logediting'),
                    ('transaction_logediting.logeditingboot_id'),'=',('master_booth_logediting.id'))
                    // ->where('logediting_useddate', '>=', '2021-05-01 00:00:00.000')
                    // ->where('logediting_useddate', '<=', '2021-06-06 00:00:00.000')
                    ->where('logediting_useddate', '>=', array($start))
                    ->where('logediting_useddate', '<=', array($end))
                    ->select('master_booth_logediting.nama_booth', \DB::raw('COUNT(transaction_logediting.logeditingboot_id) AS jumlah_data'))
                    ->groupBy('master_booth_logediting.nama_booth')
                    ->get();
                $data_booth_count = array();
                foreach ($booth as $b){
                    $data_booth_count[]=  array(
                        "Booth" => $b->nama_booth,
                        "Jumlah_data" => $b->jumlah_data
                    );
                }
            }
            
            $data = json_encode(array('data_booth_count'=>$data_booth_count,'data_json'=>$data_json), true);
            
            echo $data;
            
        }
    }
}
