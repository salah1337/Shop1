<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RolesController extends Controller
{
    public function store(Request $request){
        $role = Role::create([
            'name' => $request->get('name'),
            'label' => $request->get('label') ?? \ucfirst($request->get('name'))
        ]);
        $data = [
            'success' => true,
            'role' => $role,
        ];
        return \response()->json($data, 201);
    }
  
    public function update(Request $request, $id){
        $role = Role::find($id);
        if (!$role) return \response()->json(['error' => 'Not found', 404]);
        $role->update([
            'name' => $request->get('name'),
            'label' => $request->get('label') ?? \ucfirst($request->get('name'))
        ]);
        $data = [
            'success' => true,
            'role' => $role,
        ];
        return \response()->json($data, 201);
    }

    public function destroy($id){
        $role = Role::find($id);
        if (!$role) return \response()->json(['error' => 'Not found', 404]);
        $role->delete();
        $data = [
            'success' => true, 
            'message' => 'Role deleted successfully'
        ];
        return \response()->json($data, 201);
    }
}
