<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Transaction_logediting;

class Apicontroller extends Controller
{
    public function get_all_logediting($nik){
        $date = date('d M Y');
        $test = DB::table('transaction_logediting')->leftJoin(('master_booth_logediting'),
                ('transaction_logediting.logeditingboot_id'), '=', ('master_booth_logediting.id'))
                ->where('transaction_logediting.logediting_useddate', $date)
                ->where('transaction_logediting.logediting_editor_nik', $nik)
                ->orderBy('transaction_logediting.id', 'ASC')
                ->get();
        
        if(count($test)){
            
            foreach ($test as $t){
                
                $return_api[] = [
                                    "Code" => $t->logediting_code,
                                    "Shift" =>  'Shift'.' '.$t->logediting_usedshift,
                                    "Tanggal_editing" => date('d M Y', strtotime($t->logediting_useddate)),
                                    "Booth" => 'Booth'.' '.$t->nama_booth
                                ];
            }
            
            return response()->json(['data' => $return_api, "success" => true], 200);
            
        }
        else{
            
            return response()->json(['data' => [], "success" => true], 200);
        }
    }
}
