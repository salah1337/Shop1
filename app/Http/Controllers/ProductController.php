<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductCategory;
use App\Models\OptionGroup;
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
        foreach ($products as $key => $product) {
            $product['category'] = ProductCategory::find($product->product_category_id);
            $product['options'] = $product->options;
            foreach ($product['options'] as $key => $option) {
                $option['name'] = $option->option->name;
                $option['group'] = OptionGroup::find($option->option_group_id);
            }
        }
        $data = [
            'success' => true,
            'data' =>  [
                'count' => $products->count(),
                'categories' => ProductCategory::all(),
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
        

        $images = json_decode($request->get('images'));
        // $imgFiles = json_decode($request->images);
        // return \response()->json($request->images, 500);

        $thumbnailName = time().'_'.$request->thumb->getClientOriginalName();
        $imageNames = [];
        foreach ($images as $key => $image) {
            $imageNames[$key] = time().'_'.$request->images[$key]->getClientOriginalName();
        }

        $request->thumb->storeAs('public', $thumbnailName);
        
        foreach ($images as $key => $image) {
            $request->images[$key]->storeAs('public', $imageNames[$key]);
        }
        $product = Product::create([
            'name' => $request->get('name'), 
            'location' => $request->get('location'), 
            'SKU' => $request->get('SKU'), 
            'price' => $request->get('price'), 
            'weight' => $request->get('weight'), 
            'cartDesc' => $request->get('cartDesc'), 
            'shortDesc' => $request->get('shortDesc'), 
            'longDesc' => $request->get('longDesc'), 
            'thumb' => $thumbnailName, 
            'image' => json_encode($imageNames), 
            'stock' => $request->get('stock'), 
            'tax' => $request->get('tax'), 
            'live' => $request->get('live'), 
            'unlimited' => $request->get('unlimited'), 
            'product_category_id' => $request->get('product_category_id'), 
            'featured' => 0, 
            ]);
            $productOptions = \json_decode($request->get('options'));
            foreach ($productOptions as $key => $option) {
                ProductOption::create([
                    'option_id' => $option->id,
                    'option_group_id' => $option->group_id,
                    'product_id' => $product->id,
                    'priceIncrement' => $option->increment
                ]);
            }
            
            
            
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
        $product['category'] = ProductCategory::find($product->product_category_id);
        $product['options'] = $product->options;
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
    public function update(UpdateProductRequest $request, $id)
    {
        // return \response()->json($request, 500);
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
        $images = json_decode($request->get('images'));
        // $imgFiles = json_decode($request->images);
        
        
        $imageNamesRaw = $request->get('image');
        if ( $request->get('image') != ''){
            $imageNames = \explode(",", $request->get('image'));
        }else{
            $imageNames = [];
        }
        // $imageNames = json_decode($request->get('image'));
        foreach ($images as $key => $image) {
            // $imageNames[$key] = time().'_'.$request->images[$key]->getClientOriginalName();
            \array_push($imageNames, time().'_'.$request->images[$key]->getClientOriginalName());
        }
        
        
        foreach ($images as $key => $image) {
            $request->images[$key]->storeAs('public', time().'_'.$request->images[$key]->getClientOriginalName());
        }
        $product->update([
            'image' => \json_encode($imageNames), 
            ]);
        
        if ($request->thumb){
            $thumbnailName = time().'_'.$request->thumb->getClientOriginalName();
            $request->thumb->storeAs('public', $thumbnailName);
            $product->update([
                'thumb' => $thumbnailName, 
            ]);
        }
        
        $product->update([
            $request
        ]);
        // $product->update([
        //     'name' => $request->get('name'),
        //     'location' => $request->get('location'), 
        //     'SKU' => $request->get('SKU'), 
        //     'price' => $request->get('price'), 
        //     'weight' => $request->get('weight'), 
        //     'cartDesc' => $request->get('cartDesc'), 
        //     'shortDesc' => $request->get('shortDesc'), 
        //     'longDesc' => $request->get('longDesc'), 
        //     'thumb' => $thumbnailName, 
        //     'image' => json_encode($imageNames), 
        //     'stock' => $request->get('stock'), 
        //     'live' => $request->get('live'), 
        //     'unlimited' => $request->get('unlimited'), 
        //     'product_category_id' => $request->get('product_category_id'), 
        // ]);
        $product['category'] = ProductCategory::find($product->product_category_id);
        $product['options'] = $product->options;
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
            ]
        ];
        return \response()->json($data, 200);
    }

    public function toggleStatus($id)
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
            'live' => $product->live == 1 ? 0 : 1
        ]);
        $data = [
            'success' => true,
            'data' =>  [
                'message' => 'product updated',
            ]
        ];
        return \response()->json($data, 200);
    }

    public function toggleFeature($id)
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
            'featured' => $product->featured == 1 ? 0 : 1
        ]);
        $data = [
            'success' => true,
            'data' =>  [
                'message' => 'product updated',
            ]
        ];
        return \response()->json($data, 200);
    }
}
