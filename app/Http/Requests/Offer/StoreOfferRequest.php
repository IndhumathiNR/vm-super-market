<?php

namespace App\Http\Requests\Offer;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Offer;

class StoreOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id'=>'required',
            'quantity'=>'required_without:offer_check_box',
            'offer_price'=>'required|numeric',
            'related_product_id'=>'required_if:offer_check_box,==,on|required_without:quantity',
        ];
    }
}
