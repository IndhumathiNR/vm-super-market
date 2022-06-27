<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function offers() {
        return $this->hasMany(Offer::class);
    }

    public function getProductNameAttribute($value){
        return ucfirst($value);
    }
}
