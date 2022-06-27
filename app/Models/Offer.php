<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function getProductName() {
        if (!empty($this->related_product_id)) {
            return Product::find($this->related_product_id)->product_name;
        }
        return "-";
    }

}
