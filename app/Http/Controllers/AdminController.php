<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Ability;
use App\Models\Product;
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
            $options = $product->options;
            foreach ($options as $key => $option) {
                $option->name = $option->option->name;
            }
            $product['options'] = $options;
        }
        $data = [
            'success' => true, 
            'data' => [
                'count' => $products->count(),
                'products' => $products
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
