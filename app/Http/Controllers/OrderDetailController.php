<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderDetailsRequest;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderDetail::all();
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
    public function store(StoreOrderDetailsRequest $request)
    {
        return OrderDetail::create([
            'name' => $request->get('name'),
            'SKU' => $request->get('SKU'),
            'price' => $request->get('price'),
            'quantity' => $request->get('quantity'),
            'product_id' => $request->get('product_id'),
            'order_id' => $request->get('order_id'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDetail $orderDetail)
    {
        return OrderDetail::find($id) ?? 'Not Found';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrderDetailsRequest $request, $id)
    {
        $order = OrderDetail::find($id);
        if ( !$order ) return 'Not Found';

        return $oder->update([
            'name' => $request->get('name'),
            'SKU' => $request->get('SKU'),
            'price' => $request->get('price'),
            'quantity' => $request->get('quantity'),
            'product_id' => $request->get('product_id'),
            'order_id' => $request->get('order_id'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetail $orderDetail)
    {
        $order = OrderDetail::find($id);
        if ( !$order ) return 'Not Found';

        return $order->delete();
    }
}
