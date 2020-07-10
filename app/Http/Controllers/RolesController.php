<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Ability;
class RolesController extends Controller
{
    public function all(){
        $roles = Role::all();
        $data['data']['count'] = $roles->count();
        foreach ($roles as $key => $role) {
            $users = $role->users->pluck('username', 'id');
            
            $data['data']['roles'][$key] = [
                'name' => $role->name,
                'label' => $role->label,
                'abilities' => $role->abilities,
                'users' => $users,
                'userCount' => $role->users->count(),
                'id' => $role->id
            ];
        };
        $data['success'] = true;
        return \response()->json($data, 200);
    }

    public function show($id){
        $role = Role::find($id);
        if (!$role) {
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'role not found'
                ]
            ];
            return \response()->json($data, 404);
        };
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
                'message' => 'role created',
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
        if (!$role) {
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'role not found'
                ]
            ];
            return \response()->json($data, 404);
        };
        $role->update([
            'name' => $request->get('name'),
            'label' => $request->get('label') ?? \ucfirst($request->get('name'))
        ]);
        $data = [
            'success' => true,
            'data' => [
                'message' => 'role updated',
                'role' => $role,
            ]
        ];
        return \response()->json($data, 200);
    }

    public function destroy($id){
        $role = Role::find($id);
        if (!$role) {
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'role not found'
                ]
            ];
            return \response()->json($data, 404);
        };
        $role->delete();
        $data = [
            'success' => true, 
            'data' => [
                'message' => 'role deleted',
                'role' => $role
            ]
        ];
        return \response()->json($data, 200);
    }

    public function allowTo(Request $request){
        $role = Role::where('name', $request->get('role'))->first();
        if (!$role) {
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'role not found'
                ]
            ];
            return \response()->json($data, 404);
        };
        $ability = $request->get('ability');
        if($role->ableTo($ability)){
            $data = [
                'success' => false,
                'data' => [
                    'message' => $role->name.' already has ability '.$ability
                ]
            ];
            return \response()->json($data, 200);
        }
        $role->allowTo($ability);
        $data = [
            'success' => true, 
            'data' => [
                'message' => 'Ability '.$ability.' added to '.$role->name.' successfully'
            ]
        ];
        return \response()->json($data, 200);
    }

    public function unAllow(Request $request){
        $role = Role::where('name', $request->get('role'))->first();
        if (!$role) {
            $data = [
                'success' => false,
                'data' => [
                    'message' => 'role not found'
                ]
            ];
            return \response()->json($data, 404);
        };
        $ability = $request->get('ability');
        $ability =  Ability::where('name', $ability)->first();

        if(!$role->ableTo($ability->name)){
            $data = [
                'success' => false,
                'data' => [
                    'message' => $role->name.' does not have ability '.$ability->name
                ]
            ];
            return \response()->json($data, 200);
        }
        // $role->unAllow($ability);
        \DB::table('ability_role')->where(['role_id'=> $role->id, 'ability_id' => $ability->id])->delete();
        $data = [
            'success' => true, 
            'data' => [
                'message' => 'Ability '.$ability->name.' removed from '.$role->name.' successfully'
            ]
        ];
        return \response()->json($data, 200);
    }

}
