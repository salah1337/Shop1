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

        $users = [];
        
        foreach (User::all() as $key => $user) {
            if ($user->roles->count() > 0){
                \array_push($users, $user);
            }
        }
        foreach ($users as $key => $user) {
            $user['roles'] = $user->roles;
        }
        foreach ($user->roles as $key => $role) {
            $role['abilities'] = $role->abilities;
        }
        $data = [
            'success' => true,
            'data' => [
                'staffMembers' => $users,
            ]            
        ];
        
        // $data['data']['roleCount'] = $roles->count();
        // $data['data']['staffCount'] = 0;
        // foreach ($roles as $key=>$role) {
        //     $data['data']['staff'][$key] = [
        //         'name' => $role->name,
        //         'users' => $role->users->pluck('username', 'id'),
        //         'count' => $role->users->count()
        //     ];
        //     $data['data']['staffCount'] += $role->users->count();
        // }
        // $data['success'] = true;
        return \response()->json($data, 200);
    }


    public function assign(Request $request)
    {
        $user = User::where('username', $request->get('username'))->first();
        if( !$user ){
            $data = [
                'success' => false,
                'data' =>  [
                    'message' => 'user not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        if( $user->isA($request->get('role')) ) {
            $data = [
                'success' => false,
                'data' => [
                    'message' => $user->username.' already has the '.$request->get('role').' role'
                ]
            ];
            return \response()->json($data, 200);
        }
        $user->assignRole($request->get('role'));
        $data = [
            'success' => true,
            'data' => [
                'message' => $user->username.' has been assigned the '.$request->get('role').' role'
            ]
        ];
        return \response()->json($data, 200);
    }

    public function revoke(Request $request)
    {
        $user = User::where('username', $request->get('username'))->first();
        if( !$user ){
            $data = [
                'success' => false,
                'data' =>  [
                    'message' => 'user not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        if( !$user->isA($request->get('role')) ) {
            $data = [
                'success' => false,
                'data' => [
                    'message' => $user->username.' does not have the '.$request->get('role').' role'
                ]
            ];
            return \response()->json($data, 200);
        }
        $user->revokeRole($request->get('role'));
        $data = [
            'success' => true,
            'data' => [
                'message' => $user->username.' no longer has the '.$request->get('role').' role'
            ]
        ];
        return \response()->json($data, 200);
    }

    
    public function show($id)
    {
        $user = User::find($id) ?? User::where('username', $id)->first();
        if( !$user ){
            $data = [
                'success' => false,
                'data' =>  [
                    'message' => 'user not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        if ( $user && $user->roles->count() > 0 ){
            $data = [
                'user' => $user, 
                'roles' => $user->roles
            ];
            return \response()->json($data, 200);
        }
        $data = [
            'success' => false,
                'data' =>  [
                    'message' => 'user found is not a staff member',
                    'user' => $user,
                ]
        ];
        return \response()->json($data, 400);
    }
}
