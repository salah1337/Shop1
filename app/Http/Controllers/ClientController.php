<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Order;
use App\Models\User;
use App\Http\Requests\StoreOrderRequest;

class ClientController extends Controller
{
    
    public function productsAll(){
        $products = Product::all()->where('live', 1);
        $data = [
            'count' => $products->count(),
            'products' => $products
        ];
        return \response()->json($data, 200);
    }
    
    public function productsOne($id){
        $product = Product::find($id);
        if( !$product->live ){
            return \response()->json(['error' => 'Not found.'],404);
        }
        return \response()->json($product, 200);
    }

    public function productsFilter(Request $request, $category){
        $category = ProductCategory::whereName($category)->firstOrFail();
        $products = $category->products->where('live', 1);
        $data = [
            'count' => $products->count(),
            'products' => $products,
            'user' => $request->user()
        ];
        return \response()->json($data, 200);
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
            'order' => $order
        ];
        return \response()->json($data, 201);
    }

    public function ordersAll(Request $request){
        $orders = $request->user()->orders;
        $data = [
            'success' => true,
            'orders' => $orders
        ];
        return \response()->json($data, 200);
    }

    public function orderShow(Request $request, $id){
        $order = Order::find($id);
        if (!$order){ 
            $data = [
                'success' => false,
                'error' => 'Order not found.'
            ];
            return \response()->json($data,404);
        }
        $this->authorize('view', $order);
        $data = [
            'success' => true,
            'order' => $order
        ];
        return \response()->json($data, 200);
    }

    public function ordercancel(Request $request, $id){
        $order = Order::find($id);
        if (!$order->user === $request->user()) return \response()->json(403);
        $order->delete();
        $data = [
            'success' => true,
            'message' => 'Order canceled successfully'
        ];
        return \response()->json($data, 200);
    }

}
