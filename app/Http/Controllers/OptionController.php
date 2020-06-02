<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOptionRequest;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Option::all();
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
    public function store(StoreOptionRequest $request)
    {
        return Option::create([
            'name' => $request->get('name'),
            'option_group_id' => $request->get('option_group_id')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Option::find($id) ?? 'Not found';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOptionRequest $request, $id)
    {
        $option = Option::find($id);

        return $option->update([
            'name' => $request->get('name'),
            'option_group_id' => $request->get('option_group_id')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $option = Option::find($id);
        if(!$option){
            return 'Option doesn\'t exist';
        }
        return $option->delete();
    }
}
