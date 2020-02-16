<?php

namespace App\Http\Controllers;
use Validator;
use App\Users;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class Auth extends BaseController
{
    /**
    * The request instance.
    *
    * @var \Illuminate\Http\Request
    */
    private $request;
    /**
    * Create a new controller instance.
    *
    * @param \Illuminate\Http\Request $request
    * @return void
    */
    public function __construct(Request $request) {
        $this->request = $request;
        }
        /**
        * Create a new token.
        *
        * @param \App\Users $user
        * @return string
        */
        protected function jwt(Users $user) {
        $payload = [
            'iss' => "Abidurrahman Al-Faruq", // Issuer of the token
            'sub' => $user->nama, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60*60 // Expiration time
        ];
        
        // As you can see we are passing `JWT_SECRET` as the second parameter that will
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }
    /**
    * Authenticate a user and return the token if the provided credentials are correct.
    *
    * @param \App\User $user
    * @return mixed
    */
    public function authenticate(Users $user) {
        $this->validate($this->request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        // Find the user by username
        $user = Users::where('email', $this->request->input('email'))->first();
        if (!$user) {
            // You wil probably have some sort of helpers or whatever
            // to make sure that you have the same response format for
            // differents kind of responses. But let's return the
            // below respose for now.
            return response()->json([
                'code' => 404,
                'result' => 'Email does not exist.'
            ]);
        }
        // Verify the password and generate the token
        if (Hash::check($this->request->input('password'), $user->password)) {
            return response()->json([
                'code' => 200,
                'token' => $this->jwt($user)
            ]);
        }
        // Bad Request response
        return response()->json([
            'code' => 404,
            'error' => 'Email or password is wrong.'
        ]);
    }
}