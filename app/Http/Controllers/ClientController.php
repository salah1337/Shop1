<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Order;
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




    public function cart(Request $request){
        $cart =  $request->user()->cart;
        $data = [
            'success' => true,
            'data' => [
                'cart' => [
                    'count' => $cart->items->count(),
                    'items' => $cart->items,
                ]
            ]
        ];
        return \response()->json($data, 200);
    }

    public function cartClear(Request $request){
        $cart =  $request->user()->cart;
        if( !$cart->items->count() ){
            $data = [
                'success' => true,
                'data' => [
                    'message' => 'cart has no items'
                ]
            ];
        }else{
            CartItem::where('cart_id', $cart->id)->delete();
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
        // find prod & check if exists & live
        $product = Product::find($id);
        if( $product && $product->live ){
            // get cart & check if car has prod
            $cart =  $request->user()->cart;
            if ( $cart->has($product) ){
                // if cart has prod increment count
                $cartItem = CartItem::where('product_id', $product->id)->first();
                $cartItem->update([
                    'count' => $cartItem->count + 1,
                    'price' => $product->price * ($cartItem->count + 1)
                ]);
            }else{
                // if cart doens't have prod add it
                CartItem::create([
                    'name' => $product->name,
                    'count' => 1,
                    'price' => $product->price,
                    'product_id' => $product->id,
                    'cart_id' => $cart->id
                ]);
            }
            $data = [
                'success' => true,
                'data' => [
                    'message' => 'product added to cart',
                    'cart' => [
                        'count' => $cart->items->count(),
                        'items' => $cart->items,
                    ]
                ]
            ];
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
        // find prod & check if exists & live
        $product = Product::find($id);
        if( $product && $product->live ){
            // get cart & check if car has prod
            $cart =  $request->user()->cart;
            if ( $cart->has($product) ){
                // if cart has prod decrement count
                $cartItem = CartItem::where('product_id', $product->id)->first();
                $cartItem->update([
                    'count' => $cartItem->count - 1,
                    'price' => $product->price * ($cartItem->count - 1)
                ]);
                if( $cartItem->count <= 0 ) $cartItem->delete();
                $data = [
                    'success' => true,
                    'data' => [
                        'message' => 'product removed from cart',
                        'cart' => [
                            'count' => $cart->items->count(),
                            'items' => $cart->items,
                        ]
                    ]
                ];
            }else{
                // if cart doens't have prod return
                $data = [
                    'success' => false,
                    'data' => [
                        'message' => 'product not in cart',
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

    public function cartRemoveItem(Request $request, $id){
        // find prod & check if exists & live
        $product = Product::find($id);
        if( $product && $product->live ){
            // get cart & check if car has prod
            $cart =  $request->user()->cart;
            if ( $cart->has($product) ){
                // if cart has prod decrement count
                $cartItem = CartItem::where('product_id', $product->id)->first();
                $cartItem->delete();
                $data = [
                    'success' => true,
                    'data' => [
                        'message' => 'product removed from cart',
                        'cart' => $cart->items
                    ]
                ];
            }else{
                // if cart doens't have prod return
                $data = [
                    'success' => true,
                    'data' => [
                        'message' => 'product not in cart',
                        'cart' => $cart->items
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
