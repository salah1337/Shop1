<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
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
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
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
        foreach ($request->get('details') as $key => $detail) {
            $product = Product::find($detail['product_id']);
            // foreach ($request->get('productOptions') as $key => $option) {
                
            // }
            $orderDetail = OrderDetail::create([
                'name' => $product['name'],
                'SKU' => $product['SKU'],
                'price' => $detail['price'],
                'quantity' => $detail['quantity'],
                'product_id' => $detail['product_id'],
                'order_id' => $order['id'],
            ]);
            $orderDetails[$key] = $orderDetail;
        }
        $data = [
            'success' => true, 
            'data' => [
                'message' => 'order created',
                'order' => [
                    'info' => $order,
                    'details' => $orderDetails
                ]
            ]
        ];
        return \response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order =  Order::find($id);
        if (!$order){
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'order not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $data = [
            'success' => true,
            'data' => [
                'order' => $order
            ]
        ];
        return \response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrderRequest $request, $id)
    {
        $order =  Order::find($id);
        if (!$order){
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'order not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $order->update([
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
            'user_id' => $request->get('user_id'),
        ]);
        $data = [
            'success' => true,
            'data' => [
                'message' => 'order updated',
                'order' => $order
            ]
        ];
        return \response()->json($data, 200);
    }
   
    public function ship(Request $request, $id)
    {
        $order =  Order::find($id);
        if (!$order){
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'order not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        if ($order->shipped){
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'order already shipped',
                    'order' => $order
                ]
            ];
        }else{
            $order->update([
                'shipped' => true,
            ]);
            $data = [
                'success' => true,
                'data' => [
                    'message' => 'order marked as shipped',
                    'order' => $order
                ]
            ];
        }
        return \response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $order =  Order::find($id);
        if (!$order){
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'order not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $order->delete();
        $data = [
            'success' => true,
            'data' => [
                'message' => 'order cancelled',
                'order' => $order
            ]
        ];
        return \response()->json($data, 201);
    }
}
