<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    //

    public function hasManyProducts() {
        return $this->hasMany('App\Product');
    }
}
