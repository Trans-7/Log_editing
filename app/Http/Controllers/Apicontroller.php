<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Transaction_logediting;

class Apicontroller extends Controller
{
    public function get_all_logediting($nik){
        $test = DB::table('transaction_logediting')->leftJoin(('master_booth_logediting'),
                ('transaction_logediting.logeditingboot_id'), '=', ('master_booth_logediting.id'))
                ->orderBy('transaction_logediting.id', 'ASC')
                ->get();
        foreach ($test as $t){
            $nik = $t->logediting_editor_nik;
            $w = $t->logediting_code;
            $x = $t->logediting_usedshift;
            $y = $t->logediting_useddate;
            $z = $t->nama_booth;
        }
        

        // return response()->json('Code:'.$w.' '.', Shift:'.$x.' '.', tanggal_editing:'.$y.' '.', Booth:'.$z.' ', 200);
        return response([
            'Code' => $w,
            'Shift' => $x,
            'Tanggal_editing' => date('d M Y', strtotime($y)),
            'Booth' => $z,

        ], 200);
        return $nik;
    }
}
