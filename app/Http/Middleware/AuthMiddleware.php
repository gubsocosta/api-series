<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

/**
 * Class AuthMiddleware
 *
 * @package App\Http\Middleware
 */
class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if(!$request->hasHeader('Authorization')) {
                throw new \Exception();
            }
            $authoriaztionHeader = $request->header('Authorization');

            $token = str_replace('Bearer ', '', $authoriaztionHeader);

            $payload = JWT::decode($token, env('JWT_KEY'), ['HS256']);

            $user = User::where(['email' => $payload->email])->first();

            if(is_null($user)) {
                throw new \Exception();
            }

            return $next($request);
        } catch (\Throwable $th) {
            return response()->json(['Unauthorized'], 401);
        }
    }
}
