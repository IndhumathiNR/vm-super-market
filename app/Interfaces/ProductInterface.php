<?php

namespace App\Interfaces;

interface ProductInterface{

    public function getAll();
    
    public function store($request);

    public function update($request,$id);

    public function destroy($id);

    public function getProductPrice($id);

}
?>