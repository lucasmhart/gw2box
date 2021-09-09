<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'api_key' => 'required',
        ]);

        $user = User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'api_key' => $request->input('api_key'),
        ]);

        Auth::loginUsingId($user->id);

        return response()->json(['user_id' => $user->id], 200);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['logged_in' => true], 200);
        }

        return response()->json(['logged_in' => false], 200);
    }
}
