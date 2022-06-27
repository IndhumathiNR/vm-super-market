<?php

namespace App\Repositories;
use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface {

    private $product;

    public function __construct(Product $product) {
        $this->product = $product;
    }

    /*******************************
     Name: getAll
     Purpose: gets all the products data
     Version: 1.0
     Date: 26th Jun 2022
     Author: Indhumathi
     Description: Can call this function when we need to get all the products data from products table
    *********************************/
    public function getAll() {
        return $this->product->orderBy('id', 'DESC')->get();
    }

    /*******************************
     Name: store
     Purpose: To store the product data
     Version: 1.0
     Date: 26th Jun 2022
     Author: Indhumathi
     Description: Can call this function when we need to insert product data into products table
    *********************************/
    public function store($request) {
        $product = $this->product;
        $this->buildObject($request, $product);
        return $product;
    }

    /*******************************
     Name: update
     Purpose: To update the product data based on product ID
     Version: 1.0
     Date: 26th Jun 2022
     Author: Indhumathi
     Description: Can call this function when we need to update product data
    *********************************/
    public function update($request, $id) {
        $product = $this->product->find($id);
        $this->buildObject($request, $product);
        return $product;
    }

    /*******************************
     Name: buildObject
     Purpose: Prepartion of an object for storing/updating the records
     Version: 1.0
     Date: 26th Jun 2022
     Author: Indhumathi
     Description: Can call this function when we need to prepare an object for storing/updating the records in the database
    *********************************/
    private function buildObject($request, $product) {
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->save();
        return $product;
    }

    /*******************************
     Name: destroy
     Purpose: To delete a record
     Version: 1.0
     Date: 26th Jun 2022
     Author: Indhumathi
     Description: Can call this function when we need to delete an record from products table
    *********************************/
    public function destroy($id) {
        $product = $this->product->find($id);
        $product->delete();
    }

    /*******************************
     Name: getProductPrice
     Purpose: To get product price
     Version: 1.0
     Date: 26th Jun 2022
     Author: Indhumathi
     Description: Can call this function when we need to get the price for the given product id
    *********************************/
    public function getProductPrice($id) {
        $product_price = $this->product->where('id', $id)->pluck('product_price')->first();
        return $product_price;
    }
}
?>