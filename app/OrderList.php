<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
  protected $fillable = [
      'order_id',
      'order_by',
      'order_branch',
      'pay_option',
      'contact',
      'comment',
      'order_price'
  ];

  public static function get_order($order_id)
  {
    $orders = OrderList::where('order_id', $order_id)->first();
    return $orders;
  }

  public static function add_order($order_id, $order_by, $location, $phone_number, $comment, $total_price, $pay_option)
  {
    $orders = OrderList::where('order_id', $order_id)->first();
    if (!$orders)
        $orders = OrderList::create([
            'order_id' => $order_id,
            'order_by' => $order_by,
            'order_branch' => $location,
            'contact' => $phone_number,
            'comment' => $comment,
            'order_price' => $total_price,
            'pay_option' => $pay_option
        ]);
    return $orders;
  }

  public static function get_order_date($order_id)
  {
      $orders = OrderList::select('created_at')->where('order_id', $order_id)->first();
      return $orders;
  }

  public static function get_order_pay_option($order_id)
  {
      $orders = OrderList::select('pay_option')->where('order_id', $order_id)->first();
      return $orders;
  }

  public static function get_order_cost($order_id)
  {
      $orders = OrderList::select('order_price')->where('order_id', $order_id)->first();
      return $orders;
  }

}
