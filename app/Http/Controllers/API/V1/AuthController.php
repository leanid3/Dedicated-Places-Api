<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {

        return User::create($request->all());
    }


    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken(config('app.name'))->plainTextToken;
        return response()->json(compact('user', 'token'));
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json('Logged out successfully');
    }
}
