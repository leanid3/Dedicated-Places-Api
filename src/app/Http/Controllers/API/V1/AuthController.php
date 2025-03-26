<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $user = User::where('email', $request->email)->first();
        if (!$user && Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user->tokens()->delete();
        $token = $user->createToken(config('app.name'))->plainTextToken;
        return response()->json(compact('user', 'token'));
    }
    public function profile()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
        return new UserResource($user);

    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json('Logged out successfully');
    }
}
