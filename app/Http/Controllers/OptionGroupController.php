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
        $optionGroups = OptionGroup::all();
        $data = [
            'success' => true, 
            'data' => [
                'count' => $optionGroups->count(),
                'optionGroups' => $optionGroups
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
        $optionGroup = OptionGroup::create([
            'name' => $request->get('name')
        ]);
        $data = [
            'success' => true, 
            'data' => [
                'optionGroup' => $optionGroup
            ]
        ];
        return \response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OptionGroup  $optionGroup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $optionGroup = OptionGroup::find($id);
        if( !$optionGroup ){
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'Option group not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $data = [
            'success' => true,
            'data' => [
                'optionGroup' => $optionGroup,
                'optionsCount' => $optionGroup->options->count(),
                'options' => $optionGroup->options
            ]
        ];
        return \response()->json($data, 200);
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
    public function update(StoreOptionGroupRequest $request, $id)
    {
        $optionGroup = OptionGroup::find($id);
        if( !$optionGroup ){
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'Option group not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $optionGroup->update([
            'name' => $request->get('name')
        ]);
        $data = [
            'success' => true,
            'data' => [
                'optionGroup' => $optionGroup
            ]
        ];
        return \response()->json($data, 200);
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
        if( !$optionGroup ){
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'Option group not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        if ($optionGroup->options->count() > 0) {
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'Can not delete option group that is not empty'
                ]
            ];
            return \response()->json($data, 500);
        }
        $optionGroup->delete();
        $data = [
            'success' => true,
            'data' => [
                'message' => 'Option group has been deleted',
                'optionGroup' => $optionGroup
            ]
        ];
        return \response()->json($data, 200);
    }
}
