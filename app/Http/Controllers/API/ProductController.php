<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\ProductInterface;


class ProductController extends Controller
{
    public function __construct(ProductInterface $product){
        $this->product=$product;
    }

    public function getAllProducts(){
       $products=$this->product->getAll();
       return response()->json(['products'=>$products]);
    }

    public function createProduct(Request $request){
        $product=$this->product->store($request);
        return response()->json(['product'=>$product]);
    }
}
