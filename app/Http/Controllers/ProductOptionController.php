<?php

namespace App\Http\Controllers;

use App\Models\ProductOption;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductOptionRequest;

class ProductOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductOption::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductOptionRequest $request)
    {
        return ProductOption::create([
            'priceIncrement' => $request->get('priceIncrement'),
            'option_id' => $request->get('option_id'),
            'option_group_id' => $request->get('option_group_id'),
            'product_id' => $request->get('product_id'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ProductOption::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductOption $productOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductOption  $productOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductOption $productOption)
    {
        $option = ProductOption::find($id);
        if ( !$option ) return 'Not Found';

        return $option->update([
            'priceIncrement' => $request->get('priceIncrement'),
            'option_id' => $request->get('option_id'),
            'option_group_id' => $request->get('option_group_id'),
            'product_id' => $request->get('product_id'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductOption $productOption)
    {
        $option = ProductOption::find($id);
        if ( !$option ) return 'Not Found';

        $option->delete();
    }
}
