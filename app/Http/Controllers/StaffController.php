<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;

class StaffController extends Controller
{

    public function all()
    {
        $roles = Role::all();
        foreach ($roles as $role) {
            $data[$role->name] = $role->users->pluck('username', 'id');
        }
        return \response()->json($data, 200);
    }


    public function assign(Request $request)
    {
        $user = User::where('username', $request->get('username'))->first();
        $user->assignRole($request->get('role'));
        $data = [
            'message' => $user->username.' has been assigned the role of '.$request->get('role'),
        ];
        return \response()->json($data, 200);
    }


    public function show($id)
    {
        $user = User::find($id);
        if ( $user && $user->roles->count() > 0 ){
            $data = [
                'user' => $user, 
                'roles' => $user->roles
            ];
            return \response()->json($data, 200);
        }
        $data = [
            'error' => 'Not found'
        ];
        return \response()->json($data, 404);
    }


    public function revoke(Request $request)
    {
        $user = User::where('username', $request->get('username'))->first();
        if ( $user && $user->isA($request->get('role')) ){
            $user->revokeRole($request->get('role'));
            $data = [
                'message' => $user->username.' is no longer '.$request->get('role')
            ];
            return \response()->json($data, 200);
        }
        $data = [
            'error' => 'Not found'
        ];
        return \response()->json($data, 404);
    }
}
