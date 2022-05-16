<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'product_price', 'product_units'
    ];

    public static function get_products()
    {
        $products = Product::all();
        return $products;
    }
}
