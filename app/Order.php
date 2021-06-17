<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    /*
        Mass Assignable
    */
    protected $fillable = [
        'user_id',
        'order_details_id',
        'discount_coupons_id',
        'order_number',
        'tax'
    ];

    public function hasManyOrderDetails() {
        return $this->hasMany('App\OrderDetail');
    }

    public function discountCoupon() {
        return $this->belongsTo('App\DiscountCoupon', 'discount_coupons_id', 'id');
    }
}
