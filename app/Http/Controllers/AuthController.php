<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        try {
            // $response = $http->post(config('services.passport.login_endpoint'), [
            $response = $http->post('http://localhost:6969/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    // 'client_id' => config('services.passport.client_id'),
                    // 'client_secret' => config('services.passport.client_secret'),
                    'client_id' => 2,
                    'client_secret' => 'kUyV2ehM86gvSHN5OqkIQcUV6M8gjn3TtyfUFHUS',
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);
            return $response->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }
}
