<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function updateCartTotal($id){
        $cart = Cart::find($id);
        $items = $cart->items;
        $total = 0;
        foreach ($items as $key => $item) {
            $total = $total + ($item->price * $item->count);
        }
        $cart->update([
            'total' => $total
        ]);
        $cart = Cart::find($id);
        return $cart;
    }


    public function cart(Request $request){
        $cart =  $request->user()->cart;
        $data = [
            'success' => true,
            'data' => [
                'cart' => [
                    'count' => $cart->items->count(),
                    'total' => $cart->total,
                    'items' => $cart->items,
                ]
            ]
        ];
        return \response()->json($data, 200);
    }

    public function Clear(Request $request){
        $cart =  $request->user()->cart;
        if( !$cart->items->count() ){
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'cart has no items'
                ]
            ];
        }else{
            CartItem::where('cart_id', $cart->id)->delete();
            $cart = $this->updateCartTotal($cart->id);
            $data = [
                'success' => true,
                'data' => [
                    'message' => 'cart has been emptied',
                ]
            ];
        }
        return \response()->json($data, 200);
    }

    public function Add(Request $request, $id){
        // find prod & check if exists & liv

        $product = Product::find($id);
        if( $product && $product->live ){
            // get cart & check if car has prod
            if (!$request->get('options')){
                $data = [
                    'success' => false,
                    'data' => [
                        'message' => 'please specify options'
                    ]
                ];
                return \response()->json($data, 200);
            }
            $cart =  $request->user()->cart;
            $cartItem = $cart->items->where(['product_id' => $product->id, 'options' => $request->get('options')])->first();
            if ( $cartItem ){
                // if cart has prod increment count
                $cartItem->update([
                    'count' => $cartItem->count + 1,
                    ]);
                }else{
                    // if cart doens't have prod add it
                    CartItem::create([
                        'name' => $product->name,
                        'count' => 1,
                        'price' => $product->price,
                        'tax' => $product->tax,
                        'options' => $request->get('options'),
                        'product_id' => $product->id,
                        'cart_id' => $cart->id,
                        'image' => $product->thumb,
                        'description' => $product->cartDesc,
                ]);
            }
            $cart = $this->updateCartTotal($cart->id);
            $data = [
                'success' => true,
                'data' => [
                    'message' => 'product added to cart',
                    'cart' => [
                        'count' => $cart->items->count(),
                        'total' => $cart->total,
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
  
    public function Remove(Request $request, $id){
        // find prod & check if exists & live
        $product = Product::find($id);
        if( $product && $product->live ){
            // get cart & check if car has prod
            $cart =  $request->user()->cart;
            if ( $cart->has($product) ){
                // if cart has prod decrement count
                $cartItem = $cart->items->where('product_id', $product->id)->first();
                $cartItem->update([
                    'count' => $cartItem->count - 1,
                ]);
                if( $cartItem->count <= 0 ) $cartItem->delete();
                $cart = $this->updateCartTotal($cart->id);
                $data = [
                    'success' => true,
                    'data' => [
                        'message' => 'product removed from cart',
                        'cart' => [
                            'count' => $cart->items->count(),
                            'total' => $cart->total,
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

    public function RemoveItem(Request $request, $id){
        // find prod & check if exists & live
        $product = Product::find($id);
        if( $product && $product->live ){
            // get cart & check if car has prod
            $cart =  $request->user()->cart;
            if ( $cart->has($product) ){
                // if cart has prod decrement count
                $cartItem = $cart->items->where('product_id', $product->id)->first();
                $cartItem->delete();
                $cart = $this->updateCartTotal($cart->id);
                $data = [
                    'success' => true,
                    'data' => [
                        'message' => 'product deleted from cart',
                        'cart' => [
                            'count' => $cart->items->count(),
                            'total' => $cart->total,
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
}
