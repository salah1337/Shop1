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
        $productOptions = ProductOption::all();
        $data = [
            'success' => true,
            'data' =>  [
                'count' => $productOptions->count(),
                'productOptions' => $productOptions
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
    public function store(StoreProductOptionRequest $request)
    {
        $productOption = ProductOption::create([
            'priceIncrement' => $request->get('priceIncrement'),
            'option_id' => $request->get('option_id'),
            'option_group_id' => $request->get('option_group_id'),
            'product_id' => $request->get('product_id'),
        ]);
        $data = [
            'success' => true,
            'data' =>  [
                'message' => 'product option created',
                'productOption' => $productOption
            ]
        ];
        return \response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productOption = ProductOption::find($id);
        if( !$productOption ){
            $data = [
                'success' => false,
                'data' =>  [
                    'message' => 'product option not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $data = [
            'success' => true,
            'data' =>  [
                'productOption' => $productOption
            ]
        ];
        return \response()->json($data, 200);
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
    public function update(StoreProductOptionRequest $request, $id)
    {
        $productOption = ProductOption::find($id);
        if( !$productOption ){
            $data = [
                'success' => false,
                'data' =>  [
                    'message' => 'product option not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $productOption->update([
            'priceIncrement' => $request->get('priceIncrement'),
            'option_id' => $request->get('option_id'),
            'option_group_id' => $request->get('option_group_id'),
            'product_id' => $request->get('product_id'),
        ]);
        $data = [
            'success' => true,
            'data' =>  [
                'message' => 'product option updated',
                'productOption' => $productOption
            ]
        ];
        return \response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productOption = ProductOption::find($id);
        if( !$productOption ){
            $data = [
                'success' => false,
                'data' =>  [
                    'message' => 'product option not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $option->delete();
        $data = [
            'success' => true,
            'data' =>  [
                'message' => 'product option deleted',
                'productOption' => $productOption
            ]
        ];
        return \response()->json($data, 200);
    }
}
