<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Ability;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductOption;
use App\Models\Order;
class AdminController extends Controller
{
    public function __construct(){
        // $this->middleware('admin');
    }
    public function abilities(){
        $abilities = Ability::all();
        $data = [
            'success' => true,
            'data' => [
                'count' => $abilities->count(),
                'abilities' => $abilities
            ]
        ];
        return \response()->json($data, 200);
    }
    public function products(){
        $products = Product::withTrashed()->get();
        foreach ($products as $key => $product) {
            $product['category'] = ProductCategory::find($product->product_category_id);
            $product['options'] = $product->options;
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
  
    public function product($id){
        $product = Product::withTrashed()->where('id', $id)->get();
        $product['options'] = $product->options;
        foreach ($product['options'] as $key => $option) {
            $option->name = $option->option->name;
        }
        $data = [
            'success' => true, 
            'data' => [
                'product' => $product
            ]
        ];
        return \response()->json($data, 200);
    }
    public function orders()
    {
        $orders = Order::withTrashed()->get();
        foreach ($orders as $key => $order) {
            $order['details'] = $order->details;
        }
        $data = [
            'success' => true, 
            'data' => [
                'count' => $orders->count(),
                'orders' => $orders
            ]
        ];
        return \response()->json($data, 200);
    }
}
