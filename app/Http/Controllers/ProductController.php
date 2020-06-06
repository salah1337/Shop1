<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Providers\AppServiceProvider;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $data = [
            'success' => true,
            'data' =>  [
                'count' => $products->count(),
                'products' => $products
            ]
        ];
        return \response()->json($data, 200);
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
    public function store(StoreProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->get('name'), 
            'location' => $request->get('location'), 
            'SKU' => $request->get('SKU'), 
            'price' => $request->get('price'), 
            'weight' => $request->get('weight'), 
            'cartDesc' => $request->get('cartDesc'), 
            'shortDesc' => $request->get('shortDesc'), 
            'longDesc' => $request->get('longDesc'), 
            'thumb' => $request->get('thumb'), 
            'image' => $request->get('image'), 
            'stock' => $request->get('stock'), 
            'live' => $request->get('live'), 
            'unlimited' => $request->get('unlimited'), 
            'category_id' => $request->get('category_id'), 
        ]);
        $data = [
            'success' => true,
            'data' =>  [
                'message' => 'product created',
                'product' => $product
            ]
        ];
        return \response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if( !$product ){
            $data = [
                'success' => false,
                'data' =>  [
                    'message' => 'product not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $data = [
            'success' => true,
            'data' =>  [
                'product' => $product
            ]
        ];
        return \response()->json($data, 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, $id)
    {
        $product = Product::find($id);
        if( !$product ){
            $data = [
                'success' => false,
                'data' =>  [
                    'message' => 'product not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $product->update([
            'name' => $request->get('name'), 
            'location' => $request->get('location'), 
            'SKU' => $request->get('SKU'), 
            'price' => $request->get('price'), 
            'weight' => $request->get('weight'), 
            'cartDesc' => $request->get('cartDesc'), 
            'shortDesc' => $request->get('shortDesc'), 
            'longDesc' => $request->get('longDesc'), 
            'thumb' => $request->get('thumb'), 
            'image' => $request->get('image'), 
            'stock' => $request->get('stock'), 
            'live' => $request->get('live'), 
            'unlimited' => $request->get('unlimited'),
            'category_id' => $request->get('category_id'), 
        ]);
        $data = [
            'success' => true,
            'data' =>  [
                'message' => 'product updated',
                'product' => $product
            ]
        ];
        return \response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if( !$product ){
            $data = [
                'success' => false,
                'data' =>  [
                    'message' => 'product not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $product->delete();
        $data = [
            'success' => true,
            'data' =>  [
                'message' => 'product deleted',
                'product' => $product
            ]
        ];
        return \response()->json($data, 200);
    }
}
