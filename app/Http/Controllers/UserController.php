<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
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
    public function store(StoreUserRequest $request)
    {
        return User::create([
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'firstName' => $request->get('firstName'),
            'lastName' => $request->get('lastName'),
            'password' => Hash::make($request->get('password')),
            'title' => $request->get('title'),
            'gender' => $request->get('gender'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip' => $request->get('zip'),
            'phone' => $request->get('phone'),
            'fax' => $request->get('fax'),
            'country' => $request->get('country'),
            'adress' => $request->get('adress'),
            'adress2' => $request->get('adress2'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, $id)
    {
        $user = User::find($id);
        if ( !$user ) return 'Not Found';
        return $user->update([
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'firstName' => $request->get('firstName'),
            'lastName' => $request->get('lastName'),
            'password' => Hash::make($request->get('password')),
            'title' => $request->get('title'),
            'gender' => $request->get('gender'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip' => $request->get('zip'),
            'phone' => $request->get('phone'),
            'fax' => $request->get('fax'),
            'country' => $request->get('country'),
            'adress' => $request->get('adress'),
            'adress2' => $request->get('adress2'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->destroy();
        return 200;
    }
}
