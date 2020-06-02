<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductCategoryRequest;
class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return csrf_token();
        return ProductCategory::all();
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
    public function store(StoreProductCategoryRequest $request)
    {
            return ProductCategory::create([
                'name' => $request->get('name')
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ProductCategory::find($id) ?? 'Not Found';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductCategoryRequest $request, $id)
    {
        $productCategory = ProductCategory::find($id);
        if (!$productCategory ) return 'Not Found';
        return $productCategory->update([
            'name' => $request->get('name')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $id)
    {
        $productCategory = ProductCategory::find($id);
        if (!$productCategory ) return 'Not Found';
        return $productCategory->delete();
    }
}
