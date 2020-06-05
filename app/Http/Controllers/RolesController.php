<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RolesController extends Controller
{
    public function all(){
        $roles = Role::all();
        $data['data']['count'] = $roles->count();
        foreach ($roles as $key => $role) {
            $data['data']['roles'][$key] = [
                'name' => $role->name,
                'label' => $role->label,
                'abilities' => $role->abilities,
                'userCount' => $role->users->count(),
                'id' => $role->id
            ];
        };
        $data['success'] = true;
        return \response()->json($data, 200);
    }

    public function show($id){
        $role = Role::find($id);
        if (!$role) return \response()->json(['error' => 'Not found', 404]);
        $users = $role->users->pluck('username', 'id');
        $data = [
            'success' => true,
            'data' => [
                'role' => $role,
                'users' => $users,
                'userCount' => $users->count()
            ]
        ];
        return \response()->json($data, 200);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);
        $role = Role::create([
            'name' => $request->get('name'),
            'label' => $request->get('label') ?? \ucfirst($request->get('name'))
        ]);
        $data = [
            'success' => true,
            'data' => [
                'message' => 'Role created successfully',
                'role' => $role
            ]
        ];
        return \response()->json($data, 201);
    }
  
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);
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
        $rolename = $role->name;
        $role->delete();
        $data = [
            'success' => true, 
            'message' => $rolename.' Role deleted successfully'
        ];
        return \response()->json($data, 201);
    }

    public function allowTo(Request $request){
        $role = Role::where('name', $request->get('role'))->first();
        if (!$role) return \response()->json(['error' => 'Not found', 404]);
        $ability = $request->get('ability');
        if($role->ableTo($ability)){
            return \response()->json(['message' => $role->name.' already has ability '.$ability, 200]);
        }
        $role->allowTo($ability);
        $data = [
            'success' => true, 
            'message' => 'Ability '.$ability.' added to '.$role->name.' successfully'
        ];
        return \response()->json($data, 201);
    }

    public function unAllow(Request $request){
        $role = Role::where('name', $request->get('role'))->first();
        if (!$role) return \response()->json(['error' => 'Not found', 404]); 
        $ability = $request->get('ability');
        if(!$role->ableTo($ability)){
            return \response()->json(['message' => $role->name.' does not have ability '.$ability, 200]);
        }
        $role->unAllow($ability);
        $data = [
            'success' => true, 
            'message' => 'Ability '.$ability.' removed from '.$role->name.' successfully'
        ];
        return \response()->json($data, 201);
    }

}
