<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetProductList(){
        $response = $this->json('GET', '/api/products');
            $response =$response->assertStatus(200);
            $response =$response->assertSuccessful();
            $response =$response->assertJsonStructure([
                'products'=>[
                    '*' => [
                        'id',
                        'product_name',
                        'product_price'
                    ]
                ]
            ]);
    }

    
    public function testCreateProduct(){
        $data=[
            'product_name'=>'F',
            'product_price'=>10
        ];
        $response = $this->json('POST', '/api/products/create',$data);
        $response =$response->assertStatus(200);
        $response =$response->assertSuccessful();
        $response =$response->assertJsonStructure([
                               'product'=>
                                 [
                                     'id',
                                      'product_name',
                                      'product_price'
                                 ]
         ]);
    }
}
