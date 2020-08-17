<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class TokenController
 *
 * @package App\Http\Controllers
 */
class TokenController extends Controller
{
    /**
     * Token generate
     *
     * @param Request $request
     * @return Response
     */
    public function generateToken(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(is_null($user) || !Hash::check($request->password, $user->password)) {
            return response()->json('User or password invalid', 401);
        }

        $token = JWT::encode([ 'email' => $request->email ], env('JWT_KEY'));

        return response()->json([ 'token' => $token ], 200);
    }
}
