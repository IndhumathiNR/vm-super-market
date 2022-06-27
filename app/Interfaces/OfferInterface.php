<?php

namespace App\Interfaces;

interface OfferInterface{

    public function getAll();
    
    public function store($request);

    public function destroy($id);

    public function getOffersBasedOnProductId($productId);

}
?>