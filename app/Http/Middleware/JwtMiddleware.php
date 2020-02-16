<?php

namespace App\Http\Middleware;
use Closure;
use Exception;
use App\Users;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->header('token');
        
        if(!$token) {
            // Unauthorized response if token not there
            return response()->json([
                'code' => 401,
                'error' => 'Token not provided.'
            ]);
        }
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        }catch(ExpiredException $e) {
            return response()->json([
                'code' => 400,
                'error' => 'Provided token is expired.'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => 400,
                'error' => 'An error while decoding token.'
            ]);
        }
        $user = Users::find($credentials->sub);
        // Now let's put the user in the request class so that you can grab it from there
        $request->auth = $user;
        return $next($request);
    }
}