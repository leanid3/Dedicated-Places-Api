<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function  getOneFull(int $user_id)
    {
        $user = User::all()->find($user_id);
        return response()->json($user);
    }
    public function getFindQuery()
    {

    }
}
