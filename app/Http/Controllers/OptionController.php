<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOptionRequest;

class OptionController extends Controller
{
    public function index()
    {
        $options = Option::all();
        $data = [
            'success' => true, 
            'data' => [
                'count' => $options->count(),
                'options' => $options
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
    public function store(StoreOptionRequest $request)
    {
        $option = Option::create([
            'name' => $request->get('name'),
            'option_group_id' => $request->get('option_group_id')
        ]);
        $data = [
            'success' => true,
            'data' => [
                'option' => $option
            ]
        ];
        return \response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $option = Option::find($id);
        if ( !$option ){
            $data = [
                'success' => false, 
                'data' => [
                    'message' => 'Option not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $data = [
            'success' => true, 
            'data' => [
                'option' => $option
            ]
        ];
        return \response()->json($data, 200);
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
        if ( !$option ){
            $data = [
                'success' => false, 
                'data' => [
                    'message' => 'Option not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $option->update([
            'name' => $request->get('name'),
            'option_group_id' => $request->get('option_group_id')
        ]);
        $data = [
            'success' => true, 
            'data' => [
                'message' => 'Option has been updated',
                'option' => $option
            ]
        ];
        return \response()->json($data, 200);
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
        if ( !$option ){
            $data = [
                'success' => false, 
                'data' => [
                    'message' => 'Option not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $option->delete();
        $data = [
            'success' => true, 
            'data' => [
                'message' => 'Option has been deleted',
                'option' => $option
            ]
        ];
        return \response()->json($data, 200);
    }
}
