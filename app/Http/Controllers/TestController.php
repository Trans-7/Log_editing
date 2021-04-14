<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaction_logediting;

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
}
