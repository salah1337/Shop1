<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Cart;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Mail\RecoverPasswordMail;

// Import
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends Controller
{
    
        // login-authen function
        protected $server;
        protected $tokens;
        protected $jwt;
    
    
        public function __construct(AuthorizationServer $server,
                                    TokenRepository $tokens,
                                    JwtParser $jwt)
        {
            $this->jwt = $jwt;
            $this->server = $server;
            $this->tokens = $tokens;
        }
    
    
        public function login(ServerRequestInterface $request)
        {
            $controller = new AccessTokenController($this->server, $this->tokens, $this->jwt);
    
            $request = $request->withParsedBody($request->getParsedBody() +
            [
                'grant_type' => 'password',
                'client_id' => config('services.passport.client_id'), //client id
                'client_secret' => config('services.passport.client_secret'), //client secret
            ]);
    
    
            return with(new AccessTokenController($this->server, $this->tokens, $this->jwt))
                ->issueToken($request);
        }
     
     
        public function register(StoreUserRequest $request)
        {
            $imageName = 'noimage.jpg';
            if($request->image){
                $imageName = time().'_'.$request->image->getClientOriginalName();
                $request->image->storeAs('public', $imageName);
            }

            $user = User::create([
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'firstName' => $request->get('firstName'),
                'lastName' => $request->get('lastName'),
                'password' => Hash::make($request->get('password')),
                'title' => $request->get('title'),
                'gender' => $request->get('gender'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'zip' => $request->get('zip'),
                'phone' => $request->get('phone'),
                'fax' => $request->get('fax'),
                'country' => $request->get('country'),
                'adress' => $request->get('adress'),
                'adress2' => $request->get('adress2'),
                'image' => $imageName,
            ]);
            
            Cart::create([
                'user_id' => $user->id
            ]);

            Mail::to($user->email)->send(new WelcomeMail());
            Mail::to($request->get('email'))->send(new WelcomeMail());

            $data = [
                'success' => true,
                'data' => [
                    'user' => $user
                ]
            ];
            return response()->json($data);
        }

        
        public function update(UpdateUserRequest $request, $id)
        {
            $user = User::find($id);   
            if( !$user ){
                $data = [
                    'success' => false,
                    'data' =>  [
                        'message' => 'user not found'
                    ]
                ];
                return \response()->json($data, 404);
            }
            if ($request->image){
                $imageName = time().'_'.$request->image->getClientOriginalName();
                $request->image->storeAs('public', $imageName);
                $user->update([
                    'image' => $imageName 
                ]);
            }
            $user->update($request->except('image'));
            $data = [
                'success' => true,
                'data' =>  [
                    'message' => 'user updated',
                ]
            ];
            return \response()->json($data, 200);
        }

        
        public function logout(Request $request) {

            $request->user()->tokens->each(function ($token, $key) {
                $token->delete();
            });
            $data = [
                'success' => true,
                'data' => [
                    'message' => 'Logged out successfully'
                ]
            ];
            return response()->json($data, 200);
        }

        public function user(Request $request){
            $cart =  $request->user()->cart;
            $orders =  $request->user()->orders;
            foreach ($orders as $key => $order) {
                $order['details'] = $order->details;
            }
            $data = [
                'success' => true, 
                'data' => [
                    'user' => [
                        'info' => $request->user(),
                        'cart' => [
                            'count' => $cart->items->count(),
                            'total' => $cart->total,
                            'items' => $cart->items,
                        ],
                        'orders' => [
                            'orders' => $orders,
                            'count' => $orders->count()  
                        ],
                        'isStaff' => $request->user()->roles->count() > 0 ? true :false,
                        'isAdmin' => $request->user()->isA('admin'),
                    ],
                ]
            ];
            return \response()->json($data, 200);
        }

        public function admin(Request $request){
            if ($request->user()->isA('admin')){
                $data = [
                    'success' => true, 
                    'data' => [
                        'admin' => true,
                    ]
                ];
                return \response()->json($data, 200);
            } else {
                $data = [
                    'success' => true, 
                    'data' => [
                        'admin' => false,
                    ]
                ];
                return \response()->json($data, 200);
            }
        }

        public function sendResetMail(Request $request){
            $email = $request->get('email');
            if (!User::where('email', $email)->first()){
                $data = [
                    'success' => false, 
                    'data' => [
                        'message' => 'User doesn\'t exist',
                    ]
                ];
                return \response()->json($data, 404);
            }
            $token = \Str::random(10);
            \DB::table('password_resets')->where('email', $email)->delete();
            \DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token
            ]);
            Mail::to($email)->send(new RecoverPasswordMail($token));
            $data = [
                'success' => true, 
                'data' => [
                    'message' => 'Check your email.',
                ]
            ];
            return \response()->json($data, 200);
        }

        public function resetPassword(ResetPasswordRequest $request){
            $token = $request->get('token');
            
            if (!$passwordReset = \DB::table('password_resets')->where('token', $token)->first()) {
                $data = [
                    'success' => false,
                    'data' => [
                        'message' => 'token expired'
                    ]
                ];
                return \response()->json($data, 200);
            }

            if (!$user = User::where('email', $passwordReset->email)->first()){
                $data = [
                    'success' => false,
                    'data' => [
                        'message' => 'user not found'
                    ]
                ];
                return \response()->json($data, 404);
            }
            
            $user->password = Hash::make($request->get('password'));
            $user->save();
            
            \DB::table('password_resets')->where('email', $user->email)->delete();

            $data = [
                'success' => true,
                'data' => [
                    'message' => 'password changed'
                ]
            ];
            return \response()->json($data, 200);
        }
}
