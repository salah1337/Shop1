<?php

namespace App\Http\Controllers;
use App\Ability;
use Illuminate\Http\Request;
use Gate;
class AbilityController extends Controller
{

    public function all(){
        if ( Gate::denies('ability-view') ){
            return 404;
        }
        return Ability::all();
    }

    public function store(Request $request){
        $ability = Ability::create([
            'name' => $request->get('name'),
            'label' => $request->get('label') ?? \ucfirst($request->get('name'))
        ]);
        $data = [
            'success' => true,
            'ability' => $ability,
        ];
        return \response()->json($data, 201);
    }
  
    public function update(Request $request, $id){
        $ability = Ability::find($id);
        if (!$ability) return \response()->json(['error' => 'Not found', 404]);
        $ability->update([
            'name' => $request->get('name'),
            'label' => $request->get('label') ?? \ucfirst($request->get('name'))
        ]);
        $data = [
            'success' => true,
            'ability' => $ability,
        ];
        return \response()->json($data, 201);
    }

    public function destroy($id){
        $ability = Ability::find($id);
        if (!$ability) return \response()->json(['error' => 'Not found', 404]);
        $ability->delete();
        $data = [
            'success' => true, 
            'message' => 'Deleted successfully'
        ];
        return \response()->json($data, 201);
    }


}
