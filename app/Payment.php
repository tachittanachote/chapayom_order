<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $fillable = [
      'payment_id',
      'gbp_id',
      'qrcode',
	  'status',
  ];

  public static function get_payment_id($payment_id)
  {
    $payment = Payment::where('payment_id', $payment_id)->first();
    return $payment;
  }
  
  public static function mark_as_paid($payment_id)
  {
    $payment = Payment::where('payment_id', $payment_id)->first();
    $payment->status = 'paid';
	$payment->save();
	return $payment;
  }


  public static function add_payment($payment_id, $gbp_id, $qrcode, $status)
  {
    $payment = Payment::where('payment_id', $payment_id)->first();
    if (!$payment)
        $payment = Payment::create([
            'payment_id' => $payment_id,
            'gbp_id' => $gbp_id,
            'qrcode' => $qrcode,
			'status' => $status
        ]);
    return $payment;
  }

}
