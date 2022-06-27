<?php

namespace App\Repositories;
use App\Interfaces\OfferInterface;
use App\Models\Offer;

class OfferRepository implements OfferInterface{
    
    private $offer;
    
    public function __construct(Offer $offer){
      $this->offer=$offer;
    }

    /*******************************
     Name: getAll
     Purpose: gets all the offer data
     Version: 1.0
     Date: 26th Jun 2022
     Author: Indhumathi
     Description: Can call this function when we need to get all the offer data from offers table
    *********************************/
    public function getAll(){
        return $this->offer->orderBy('id', 'DESC')->get();
    }

     /*******************************
     Name: store
     Purpose: To store the offer data
     Version: 1.0
     Date: 26th Jun 2022
     Author: Indhumathi
     Description: Can call this function when we need to insert offer data into offers table
    *********************************/
    public function store($request){
         $offer=$this->offer;
         $this->buildObject($request,$offer);
         return $offer;
    }

    /*******************************
     Name: buildObject
     Purpose: Prepartion of an object for storing/updating the records
     Version: 1.0
     Date: 26th Jun 2022
     Author: Indhumathi
     Description: Can call this function when we need to prepare an object for storing/updating the records in the database
    *********************************/
    private function buildObject($request,$offer){
        $offer->product_id=$request->product_id;
        $offer->quantity=isset($request->quantity)?$request->quantity:NULL;
        $offer->offer_price=$request->offer_price;
        $offer->related_product_id=isset($request->related_product_id)?$request->related_product_id:NULL;
        $offer->save();
        return $offer;
    }

    /*******************************
     Name: destroy
     Purpose: To delete a record
     Version: 1.0
     Date: 26th Jun 2022
     Author: Indhumathi
     Description: Can call this function when we need to delete an record from offers table
    *********************************/
    public function destroy($id){
        $offer=$this->offer->find($id);
        $offer->delete();
    }

    /*******************************
     Name: getOffersBasedOnProductId
     Purpose: To get offer details
     Version: 1.0
     Date: 26th Jun 2022
     Author: Indhumathi
     Description: Can call this function when we need to get all the offers for the given product Id
    *********************************/
    public function getOffersBasedOnProductId($productId){
        $offers=$this->offer->where('product_id',$productId)->reorder('quantity','desc')->get(['product_id','related_product_id','offer_price','quantity','id']);
        return $offers;
    }
}