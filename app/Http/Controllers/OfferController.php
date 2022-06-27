<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Interfaces\OfferInterface;
use App\Interfaces\ProductInterface;
use App\Http\Requests\Offer\StoreOfferRequest;

class OfferController extends Controller
{

    public function __construct(OfferInterface $offer,ProductInterface $product){
        $this->offer=$offer;
        $this->product=$product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers=$this->offer->getAll();
        return view('offers.index',compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products=$this->product->getAll();
        return view('offers.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfferRequest $request)
    {
        try {
            $offer=$this->offer->store($request);
            return redirect()->route('offers.index')
                ->with('success', 'Offer Added successfully');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Offer Create failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        try {
            $this->offer->destroy($offer->id);
            return redirect()->route('offers.index')
                ->with('success', 'Offer Deleted successfully');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Offer Delete failed');
        }
    }
}
