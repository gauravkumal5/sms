<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use JWTAuth;


class TeacherController extends Controller
{
    public function __construct(){
        auth()->setDefaultDriver('teacher');
    }
    public function demo(){
        return " Teacher demo";
    }
    public function login(Request $request){

        $creds = $request->only(['email','password']);
        if (! $token = JWTAuth::attempt($creds)) {

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
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}