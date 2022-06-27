<?php
namespace App\Repositories;
use App\Interfaces\TransactionInterface;
use App\Models\Transaction;
use Carbon\Carbon;
use App\Interfaces\OfferInterface;
use App\Interfaces\ProductInterface;
use App\Models\CartItem;

class TransactionRepository implements TransactionInterface {

    private $transaction;
    private $offer;
    private $product;

    public function __construct(Transaction $transaction, OfferInterface $offer, ProductInterface $product) {
        $this->transaction = $transaction;
        $this->offer = $offer;
        $this->product = $product;
    }

    /*******************************
     Name: getAll
     Purpose: gets all the transactions data
     Version: 1.0
     Date: 26th Jun 2022
     Author: Indhumathi M
     Description: Can call this function when we need to get all the transactions data from transactions table
    *********************************/
    public function getAll() {
        return $this->transaction->orderBy('id', 'DESC')->get();
    }

    /*******************************
     Name: store
     Purpose: To store the transaction data
     Version: 1.0
     Date: 26th Jun 2022
     Author: Indhumathi
     Description: Can call this function when we need to insert transaction data into transactions table
    *********************************/
    public function store($request) {
        $transaction = $this->transaction;
        $transaction->customer_name = $request->customer_name;
        $transaction->purchase_date = Carbon::now();
        $count = 0;
        $total_cart_amount = 0;
        
        //Iterating the prodcust_ids array inorder to calculate the offer for each product
        foreach ($request->product_ids as $product_id) {
            $data = $this->getOfferPrice($product_id, $request->quantities[$count], $request->product_ids, $request->quantities);
            //Calculating total amount
            $total_cart_amount+= $data['totalPriceWithOffer'];
            //Building object to store the product and its offer price in cart item table
            $cart_item[] = new CartItem(['product_id' => $product_id, 'quantity' => $request->quantities[$count], 'actual_price' => $data['totalPriceWithoutOffer'], 'offer_price' => $data['totalPriceWithOffer']]);
            $count++;
        }
        $transaction->total_amount = $total_cart_amount;
        $transaction->save();
        $transaction->cartItems()->saveMany($cart_item);
        return $transaction;
    }

    /*******************************
     Name: getOfferPrice
     Purpose: To apply offers for the selected products
     Version: 1.0
     Date: 26th Jun 2022
     Author: Indhumathi
     Description: Can call this function when we need to check and apply all the applicable offers
    *********************************/
    private function getOfferPrice($productId, $quantity, $productIds, $quantities) {
        //To get all the offers from offers table for the given product ID
        $offers = $this->offer->getOffersBasedOnProductId($productId);
        //To get actual price for the product based on given product ID
        $actual_price = $this->product->getProductPrice($productId);
        $special_price = 0;
        $returnData['totalPriceWithoutOffer'] = $quantity * $actual_price;
        //Iterating offers array,to check and apply the applicable offers
        foreach ($offers as $offer) {
            if ($quantity > 0) {
                //Condition added to check is the offer for the product rely on other product
                if ($related_product_id = !empty($offer->related_product_id) ? $offer->related_product_id : false) {
                    //To check the related product is added to cart or not
                    if (in_array($related_product_id, $productIds)) {
                        $key = array_search($related_product_id, $productIds);
                        $offer_applicable_qty_count = ($quantity > $quantities[$key]) ? $quantities[$key] : $quantity;
                        $quantity-= $quantities[$key];
                        $special_price+= $offer_applicable_qty_count * $offer->offer_price;
                    }
                } else {
                    $qty_count = intdiv($quantity, $offer->quantity);
                    $special_price+= $qty_count * $offer->offer_price;
                    $quantity = fmod($quantity, $offer->quantity);
                }
            }
        }
        //Calculating the price for remaining quantity that is not applicable for any offers
        $unit_price = $quantity > 0 ? $quantity * $actual_price : 0;
        $returnData['totalPriceWithOffer'] = ($special_price + $unit_price);
        return $returnData;
    }

    /*******************************
     Name: find
     Purpose: To get transaction data based on transaction id
     Version: 1.0
     Date: 26th Jun 2022
     Author: Indhumathi
     Description: Can call this function when we need to get transaction data along with cart items 
    *********************************/
    public function find($id) {
        $transaction = $this->transaction->with('cartItems')->find($id);
        return $transaction;
    }
}
?>