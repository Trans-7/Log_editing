<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Transaction_logediting;
use App\Transaction_bookingediting;
use App\Transaction_bookingeditingdetail;
use App\Transaction_logeditingpriviledge;
use App\User;

class NonReferenceController extends Controller
{
    public function non_reference(){
        $non_reference_N = Transaction_logediting::orderBy('logediting_generateddate', 'DESC')->where('logediting_isreferenced',0)->where('logediting_generatedby', session()->get('nik'))->paginate(5);
        $non_reference_R = Transaction_bookingediting::orderBy('bookingediting_id', 'DESC')->get();
        $non_reference_R2 = Transaction_bookingediting::select('show_name')->distinct()->orderBy('show_name', 'asc')->get();
        $data_N = Transaction_logediting::latest('id')->first();
        return view('non_reference', compact('non_reference_N', 'non_reference_R', 'data_N', 'non_reference_R2'));
    }
    public function fetch_NR(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('transaction_bookingediting')
                    ->leftJoin(('relation_bookingediting_editingrequest'),
                    ('transaction_bookingediting.bookingediting_id'),'=',('relation_bookingediting_editingrequest.bookingediting_id'))
                    ->where($select, $value)
                    ->orderBy($dependent, 'DESC')
                    ->select($dependent)
                    ->distinct()
                    ->get();
        $output = '<option value="">--Selected--</option>';
        foreach($data as $row){
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
            // $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent." "."( "." Date: ".date('d M Y', strtotime($row->bookingeditingdetail_date))." , "." Shift: ".$row->bookingeditingdetail_shift." )".'</option>'; 
        }
        echo $output;
    }
    public function fetchs_NR(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('transaction_bookingeditingdetail')
                    ->leftJoin(('transaction_bookingediting'),
                    ('transaction_bookingeditingdetail.bookingediting_id'),'=',('transaction_bookingediting.bookingediting_id'))
                    ->where($select, $value)
                    ->orderBy($dependent, 'DESC')
                    ->select($dependent, 'transaction_bookingeditingdetail.bookingeditingdetail_date', 'transaction_bookingeditingdetail.bookingeditingdetail_shift')
                    ->distinct()
                    ->get();
        $output = '<option value="">--Selected--</option>';
        foreach($data as $row){
            // $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent." "."( "." Date: ".date('d M Y', strtotime($row->bookingeditingdetail_date))." , "." Shift: ".$row->bookingeditingdetail_shift." )".'</option>'; 
        }
        echo $output;
            
    }
    public function autofill_NR(Request $request)
    {
        $show_name = $request->get('show_name');
        $booking_line = $request->get('booking_line');
        $request_id = $request->get('request_id');
        $bookingediting_ref_id = $request->get('bookingediting_ref_id');
        $data = DB::table('transaction_bookingeditingdetail')
                    ->leftJoin(('transaction_bookingediting'),
                    ('transaction_bookingeditingdetail.bookingediting_id'), '=', ('transaction_bookingediting.bookingediting_id'))
                    ->where('show_name', $show_name)
                    ->where('bookingeditingdetail_line', $booking_line)
                    ->where('bookingediting_ref_id', $bookingediting_ref_id)
                    ->select('transaction_bookingediting.bookingediting_id', 'transaction_bookingeditingdetail.eps_code', 'transaction_bookingeditingdetail.bookingeditingdetail_date', 'transaction_bookingeditingdetail.bookingeditingdetail_shift')
                    ->get();
        echo $data;
    }

    public function store_NR(Request $request)
    {
        // insert data ke table 
        // date_default_timezone_set('Asia/Jakarta');
        $time = str_pad(substr(microtime(true), 12,3), 3, STR_PAD_RIGHT);
        DB::table('transaction_logediting')->insert([
            'logediting_code' =>date('H').substr(date('Y'), -2).date('i').date('m').date('s').date('d').$time,
            'logediting_useddate' => $request->editing_date." ".date('H:i:s.').$time,
            'logediting_usedshift' => $request->editing_shift,
            'logediting_reference_id' => $request->bookingediting_id,
            'logediting_reference_line' => $request->bookingeditingdetail_line,
            'logediting_reference_code' => $request->kode_eps,
            'logediting_reason' => $request->editing_reason,
            'logediting_isreferenced' => 0,
            'logediting_generatedby' => $request->session()->get('nik'),
            'logediting_generateddate' => date('Y-m-d H:i:s.').$time,
            'logediting_generatedtime' => date('H:i:s.').$time,
            'logediting_program' => $request->show_name,
            'logediting_requestid' => $request->request_id,
            'logediting_prabudgetid' => $request->bookingediting_ref_id
            //sisanya null
        ]);
        return redirect('/non_reference');
    }
}
