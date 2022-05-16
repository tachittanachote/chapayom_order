<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
  protected $fillable = [
      'order_id', 'product_name', 'order_amount', 'total_price'
  ];

  public static function add_order_product($order_id, $name, $amount, $price)
  {
    $order_product = OrderProduct::where('order_id', $order_id)->first();
    if (!$order_product)
      $order_product = OrderProduct::create([
        'order_id' => $order_id,
        'product_name' => $name,
        'order_amount' => $amount,
        'total_price' => $price
      ]);
    return $order_product;
  }
}
