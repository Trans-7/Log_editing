<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Transaction_logediting;
use App\Transaction_bookingediting;
use App\Transaction_bookingeditingdetail;
use App\Transaction_logeditingpriviledge;
use App\User;


class ReferenceController extends Controller
{
    public function reference(Request $request)
    {
        $reference_N = Transaction_logediting::orderBy('logediting_generateddate', 'DESC')->where('logediting_isreferenced',1)->where('logediting_generatedby', session()->get('nik'))->paginate(5);
        $reference_R = Transaction_bookingediting::orderBy('bookingediting_id', 'DESC')->get();
        $reference_R2 = Transaction_bookingediting::select('show_name')->distinct()->orderBy('show_name', 'asc')->get();
        $data_R = Transaction_logediting::latest('id')->first();
        return view('reference', compact('reference_N', 'reference_R','data_R', 'reference_R2'));
        
    }
    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('transaction_bookingeditingdetail')
                    ->leftJoin(('transaction_bookingediting'),
                     ('transaction_bookingeditingdetail.bookingediting_id'), '=', ('transaction_bookingediting.bookingediting_id'))
                    ->where($select, $value)
                    ->orderBy('bookingeditingdetail_date', 'DESC')
                    ->orderBy('bookingeditingdetail_shift')
                    ->get();
        $output = '<option value="">--Select Booking Editing Date & Shift--</option>';
        foreach($data as $row){
            // $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent." "."( "." Date: ".date('d M Y', strtotime($row->bookingeditingdetail_date))." , "." Shift: ".$row->bookingeditingdetail_shift." )".'</option>';
            $output .= '<option value="'.$row->$dependent.'">'." Date: ".date('d M Y', strtotime($row->bookingeditingdetail_date))." , "." Shift: ".$row->bookingeditingdetail_shift.'</option>';
        }
        echo $output;
    }
    public function autofill(Request $request)
    {
        
        $show_name = $request->get('show_name');
        $booking_line = $request->get('booking_line');
        $data = DB::table('transaction_bookingeditingdetail')
                    ->leftJoin(('transaction_bookingediting'),
                    ('transaction_bookingeditingdetail.bookingediting_id'), '=', ('transaction_bookingediting.bookingediting_id'))
                    ->where('show_name', $show_name)
                    ->where('bookingeditingdetail_line', $booking_line)
                    ->orderBy('transaction_bookingediting.show_name')
                    ->select('transaction_bookingediting.bookingediting_id', 'transaction_bookingeditingdetail.eps_code', 'transaction_bookingeditingdetail.bookingeditingdetail_date', 'transaction_bookingeditingdetail.bookingeditingdetail_shift')
                    ->get();
        echo $data;
    }
    public function store_R(Request $request)
    {
        // insert data ke table 
        $time = str_pad(substr(microtime(true), 11,3), 3, STR_PAD_RIGHT);
        DB::table('transaction_logediting')->insert([
            'logediting_code' => date('H').substr(date('Y'), -2).date('i').date('m').date('s').date('d').$time,
            'logediting_reference_id' => $request->bookingediting_id,
            'logediting_reference_line' => $request->bookingeditingdetail_line,
            'logediting_reference_code' => $request->kode_eps,
            'logediting_useddate' => $request->editing_date ,
            'logediting_usedshift' => $request->editing_shift,
            'logediting_isreferenced' => 1,
            'logediting_generatedby' => $request->session()->get('nik'),
            'logediting_generateddate' => date('Y-m-d H:i:s.').$time,
            'logediting_generatedtime' => date('H:i:s.').$time,
            'logediting_program' => $request->show_name
            //sisanya null
        ]);
        
        return redirect('/');
    }
}

