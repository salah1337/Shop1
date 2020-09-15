<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $all = Address::where('user_id', $id);
        $data = [
            'success' => true,
            'data' => [
                'addresses' => $all,
                'count' => $all->count()
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
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Address::create([
            'firstName' => $request->get('firstName'),
            'lastName' => $request->get('lastName'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip' => $request->get('zip'),
            'phone' => $request->get('phone'),
            'fax' => $request->get('fax'),
            'country' => $request->get('country'),
            'address' => $request->get('address'),
            'address2' => $request->get('address2'),
            'user_id' => $request->user()->id,
        ]);
        $data = [
            'success' => true,
            'data' =>  [
                'message' => 'address added',
            ]
        ];
        return \response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $address = Address::find($id);
        if(!$address) {
            $data = [
                'success' => false,
                'data' =>  [
                    'message' => 'address not found',
                ]
            ];
            return \response()->json($data, 404);
        }
        $address->update($request->all());
        $data = [
            'success' => true,
            'data' =>  [
                'message' => 'address updated',
            ]
        ];
        return \response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        if(!$address) {
            $data = [
                'success' => false,
                'data' =>  [
                    'message' => 'address not found',
                ]
            ];
            return \response()->json($data, 404);
        }
        $address->delete();
        $data = [
            'success' => true,
            'data' =>  [
                'message' => 'address removed',
            ]
        ];
        return \response()->json($data, 200);
    }
    public function countries() {
        $path = storage_path('app\public\address\countries+states+cities.json');
        $content = collect(json_decode(file_get_contents($path), true));
        
        $countries = $content->pluck('name');
        $phone = $content->sortBy('phone_code')->pluck('phone_code', 'name');
        $data = [
            'success' => true,
            'countries' => [
                'count' => $countries->count(),
                'names' => $countries,
                'phone' => $phone,
            ]
        ];
        return \response()->json($data, 200);
    }

    public function states($country) {
        $path = storage_path('app\public\address\countries+states+cities.json');
        $content = collect(json_decode(file_get_contents($path), true));
        
        $states = collect($content->where('name', $country)->first()['states'])->pluck('name');
        $data = [
            'success' => true,
            'states' => [
                'count' => $states->count(),
                'names' => $states
            ]
        ];
        return \response()->json($data, 200);
    }

    public function cities($country, $state) {
        $path = storage_path('app\public\address\countries+states+cities.json');
        $content = collect(json_decode(file_get_contents($path), true));
        
        $cities = collect(collect($content->where('name', $country)->first()['states'])->where('name', $state)->first()['cities'])->pluck('name');

        $data = [
            'success' => true,
            'cities' => [
                'count' => $cities->count(),
                'names' => $cities
            ]
        ];
        return \response()->json($data, 200);
    }
}
