<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    /*
        Mass Assignable
    */
    protected $fillable = [
        'product_id',
        'price',
        'order_id',
        'quantity',
        'total',
    ];

    public function product() {
        return $this->belongsTo('App\Product');
    }
}
