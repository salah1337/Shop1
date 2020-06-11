<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\CartItem;
use App\User;
use App\Http\Requests\StoreOrderRequest;

class ClientController extends Controller
{
    
    public function productsAll(){
        $products = Product::all()->where('live', 1);
        $data = [
            'success' => true,
            'data' => [
                'count' => $products->count(),
                'products' => $products
            ]
        ];
        return \response()->json($data, 200);
    }
    
    public function productsOne($id){
        $product = Product::find($id);
        if( !$product || !$product->live ){
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'Product not found.'
                ]
            ];
            return \response()->json($data,404);
        }
        $data = [
            'success' => true,
            'data' => [
                'product' => $product
            ]
        ];
        return \response()->json($data, 200);
    }

    public function productsFilter(Request $request, $category){
        $category = ProductCategory::where('name', $category)->first();
        $products = $category ? $category->products->where('live', 1) : null;
        if ( !$category || !$products ){
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'No Products Found.'
                ]
            ];
            return \response()->json($data, 200);
        }
        $data = [
            'success' => true,
            'data' => [
                'count' => $products->count(),
                'products' => $products,
            ]
        ];
        return \response()->json($data, 200);
    }




   




    public function orderPlace(StoreOrderRequest $request){
        $order = Order::create([
            'amount' => 1,
            'shipName' => $request->get('shipName'),
            'shipAddress' => $request->get('shipAddress'),
            'shipAddress2' => $request->get('shipAddress2'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip' => $request->get('zip'),
            'country' => $request->get('country'),
            'phone' => $request->get('phone'),
            'fax' => $request->get('fax'),
            'shipping' => $request->get('shipping'),
            'tax' => $request->get('tax'),
            'email' => $request->get('email'),
            'shipped' => $request->get('shipped'),
            'trackingNumber' => 123,
            'user_id' => $request->user()->id,
        ]);
        foreach ($request->get('details') as $key => $detail) {
            $product = Product::find($detail['product_id']);
            $orderDetail = OrderDetail::create([
                'name' => $product['name'],
                'SKU' => $product['SKU'],
                'price' => $detail['price'],
                'quantity' => $detail['count'],
                'product_id' => $detail['product_id'],
                'order_id' => $order['id'],
            ]);
            $orderDetails[$key] = $orderDetail;
        }
        $data = [
            'success' => true,
            'data' => [
                'message' => 'Order has been placed',
                'order' => [
                    'info' => $order,
                    'details' => $orderDetails
                ]

            ]
        ];
        return \response()->json($data, 201);
    }

    public function ordersAll(Request $request){
        $orders = $request->user()->orders;
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

    public function orderShow(Request $request, $id){
        $order = Order::find($id);
        if (!$order){ 
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'Order not found'
                ]
            ];
            return \response()->json($data,404);
        }
        $data = [
            'success' => true,
            'data' => [
                'order' => $order
            ]
        ];
        return \response()->json($data, 200);
    }

    public function ordercancel(Request $request, $id){
        $order = Order::find($id);
        if (!$order->user === $request->user()) {
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'Order not found'
                ]
            ];
            return \response()->json($data, 200);
        };
        $order->delete();
        $data = [
            'success' => true,
            'data' => [
                'message' => 'Order has been canceled'
            ]
        ];
        return \response()->json($data, 200);
    }

}
