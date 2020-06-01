<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
                'client_id' => 2, //client id
                'client_secret' => 'kUyV2ehM86gvSHN5OqkIQcUV6M8gjn3TtyfUFHUS', //client secret
            ]);
    
    
            return with(new AccessTokenController($this->server, $this->tokens, $this->jwt))
                ->issueToken($request);
        }

        public function logout(Request $request) {

            $request->user()->tokens->each(function ($token, $key) {
                $token->delete();
            });

            return response()->json('Logged out successfully', 200);
        }
}
