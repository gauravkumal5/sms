<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use JWTAuth;

// Here user is student
class UserLoginController extends Controller
{
    public function __construct(){
        auth()->setDefaultDriver('user');
    }
    public function demo(){
        return " user demo";
    }
    public function login(Request $request){

        $creds = $request->only(['username','password']);
        if (! $token = auth()->attempt($creds)) {

            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);

}

public function logout()
{
    auth()->logout();

    return response()->json(['message' => 'Successfully logged out']);
}

/**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $user=auth()->user()->id;
        return response()->json([
            'access_token' => $token,
            'user'=>$user,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}