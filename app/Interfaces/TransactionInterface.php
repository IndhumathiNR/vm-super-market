<?php
namespace App\Interfaces;

interface TransactionInterface {

    public function getAll();

    public function store($request);
    
    public function find($id);

}
?>