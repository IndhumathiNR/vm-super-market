<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }

    public function getPurchaseDateAttribute($value) {
        return date("d M Y h:i A", strtotime($value));
    }
}
