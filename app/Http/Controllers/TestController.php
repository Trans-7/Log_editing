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
            }

            $data_booth_count[]= array (
                "booth_name" => "A",
                "count" => 1
            );

            $data_booth_count[]= array (
                "booth_name" => "B",
                "count" => 1
            );

            

            // echo $data_json;
            // echo json_encode($data_json, true);
            // echo json_decode($json_file, true); array('result1'=>$arr1,'result2'=>$arr2)
            $data = json_encode(array('data_booth_count'=>$data_booth_count,'data_json'=>$data_json), true);
            // $data = json_decode($json, true);
            // dd($data);
            // print_r($data);
            echo $data;
            // echo json_decode(json_encode($data_json, true)),true;
            // echo $data;
            // $json_file = json_encode($data_json, true);
            // //print_r($json_file);exit();
            // $data = json_decode($json_file, true);

            // echo $data;
        }
    }
}
