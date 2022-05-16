<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    //
    function index(){
        return view('pay');
    }

    function invoice(Request $request){
        Payment::add_payment($request->payment_id, $request->gbp_id, $request->qrcode, 'pending');
        return response()->json([
            'status' => 'success'
        ]);
    }
	
	function process(Request $request){
		$target = Payment::get_payment_id($request->referenceNo);
		if($target && $target->status == 'pending') {
			return Payment::mark_as_paid($request->referenceNo);
		}
		else {
			return Log::info("GBP Payment error.");
		}
    }
	
}
