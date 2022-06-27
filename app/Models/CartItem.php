<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model {

    protected $fillable = ['product_id', 'quantity', 'actual_price', 'offer_price'];

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }

    public function product() {
        return $this->belongsTo(product::class);
    }

}
