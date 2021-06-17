<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    /*
        Mass Assignable
    */
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'discount_coupons_id'
    ];

    public function product()
    {
       return $this->belongsTo(Product::class);
    }
}
