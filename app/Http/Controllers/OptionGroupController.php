<?php

namespace App\Http\Controllers;

use App\Models\OptionGroup;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOptionGroupRequest;

class OptionGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OptionGroup::all();
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
    public function store(StoreOptionGroupRequest $request)
    {
        return OptionGroup::create([
            'name' => $request->get('name')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OptionGroup  $optionGroup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return  OptionGroup::find($id) ?? 'Not found';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OptionGroup  $optionGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(OptionGroup $optionGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OptionGroup  $optionGroup
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOptionRequest $request, $id)
    {
        $optionGroup = OptionGroup::find($id);
        if ( !$optionGroup ) return 'Not Found';
        return $optionGroup->update([
            'name' => $request->get('name')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OptionGroup  $optionGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $optionGroup = OptionGroup::find($id);
        if(!$optionGroup){
            return 'Not Found';
        }
        return $optionGroup->delete();
    }
}
