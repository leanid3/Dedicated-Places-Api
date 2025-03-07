<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {

        $user = User::create($request->all());
        $token = $user->createToken(config('app.name'))->plainTextToken;
        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ]);
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
    public function profile()
    {
        \Log::info('Profile method reached');
        $user = Auth::user();
        if (!$user) {
            \Log::warning('User is not authenticated');
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
        \Log::info('User fetched', ['user_id' => $user->id]);
        return new UserResource($user);

    }
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json('Logged out successfully');
    }
}
