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
        $productCategories = ProductCategory::all();
        $data = [
            'success' => true,
            'data' =>  [
                'count' => $productCategories->count(),
                'productCategories' => $productCategories
            ]
        ];
        return \response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $productCategory = ProductCategory::create([
            'name' => $request->get('name')
        ]);
        $data = [
            'success' => true,
            'data' =>  [
                'message' => 'product category created',
                'productCategory' => $productCategory
            ]
        ];
        return \response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productCategory = ProductCategory::find($id);
        if( !$productCategory ){
            $data = [
                'success' => false,
                'data' =>  [
                    'message' => 'product category not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $data = [
            'success' => true,
            'data' =>  [
                'productCategory' => $productCategory
            ]
        ];
        return \response()->json($data, 200);
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
        if( !$productCategory ){
            $data = [
                'success' => false,
                'data' =>  [
                    'message' => 'product category not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $productCategory->update([
            'name' => $request->get('name')
        ]);
        $data = [
            'success' => true,
            'data' =>  [
                'message' => 'product category updated',
                'productCategory' => $productCategory
            ]
        ];
        return \response()->json($data, 200);
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
        if( !$productCategory ){
            $data = [
                'success' => false,
                'data' =>  [
                    'message' => 'product category not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $productCategory->delete();
        $data = [
            'success' => true,
            'data' =>  [
                'message' => 'product category deleted',
                'productCategory' => $productCategory
            ]
        ];
        return \response()->json($data, 200);
    }
}
