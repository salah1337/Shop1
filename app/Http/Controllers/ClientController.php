<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Order;
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




    public function cart(Request $request){
        $cart =  $request->user()->cart;
        $data = [
            'success' => true,
            'data' => [
                'count' => $cart->products->count(),
                'cart' => $cart->products
            ]
        ];
        return \response()->json($data, 200);
    }

    public function cartClear(Request $request){
        $cart =  $request->user()->cart;
        if( !$cart->products || $cart->products->count() < 0 ){
            $data = [
                'success' => true,
                'data' => [
                    'message' => 'cart has no items'
                ]
            ];
        }else{
            $cart->clear();
            $data = [
                'success' => true,
                'data' => [
                    'message' => 'cart has been emptied'
                ]
            ];
        }
        return \response()->json($data, 200);
    }

    public function cartAdd(Request $request, $id){
        $product = Product::find($id);
        if( $product && $product->live ){
            $cart =  $request->user()->cart;
            if( $cart->has($product) ){
                $data = [
                    'success' => false,
                    'data' => [
                        'message' => 'product already in cart',
                    ]
                ];
            }else{
                $cart->add($product);
                $data = [
                    'success' => true,
                    'data' => [
                        'message' => 'product addded to cart',
                        'cart' => $cart->products
                    ]
                ];
            }
            return \response()->json($data, 200);
        }
        $data = [
            'success' => false,
            'data' => [
                'message' => 'product not found'
            ]
        ];
        return \response()->json($data, 404);
    }
  
    public function cartRemove(Request $request, $id){
        $product = Product::find($id);
        if( $product && $product->live ){
            $cart =  $request->user()->cart;
            if( !$cart->has($product) ){
                $data = [
                    'success' => false,
                    'data' => [
                        'message' => 'product is not in cart',
                    ]
                ];
            }else{
                $cart->remove($product);
                $data = [
                    'success' => true,
                    'data' => [
                        'message' => 'product removed from cart',
                        'cart' => $cart->products
                    ]
                ];
            }          
            return \response()->json($data, 200);
        }
        $data = [
            'success' => false,
            'data' => [
                'message' => 'product not found'
            ]
        ];
        return \response()->json($data, 404);
    }






    public function orderPlace(StoreOrderRequest $request){
        $order = Order::create([
            'amount' => $request->get('amount'),
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
            'trackingNumber' => $request->get('trackingNumber'),
            'user_id' => $request->user()->id,
        ]);
        $data = [
            'success' => true,
            'data' => [
                'message' => 'Order has been placed',
                'order' => $order
            ]
        ];
        return \response()->json($data, 201);
    }

    public function ordersAll(Request $request){
        $orders = $request->user()->orders;
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
