<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = User::whereEmail($request->email)->first();
            $user->token = $user->createToken('App')->plainTextToken;
            return response()->json($user);
        } else {
            return response()->json(['email' => 'Sai ten dang nhap hoac mat khau'], 401);
        }
    }

    public function register(RegisterRequest $request)
    {
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json($user);
    }

    public function getUserInfo(Request $request)
    {
        return response()->json(auth()->user());
    }
}
