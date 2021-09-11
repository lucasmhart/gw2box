<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function updateApiKey(Request $request)
    {
        $request->validate([
            'api_key' => 'required'
        ]);

        $user = Auth::user();
        $user->api_key = $request->input('api_key');
        $user->save();

        // TODO clean all user data tables (account, chars) and get everything again

        return response()->json(['status' => 200]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);

        if (!Hash::check($request->input('current_password'), Auth::user()->password)) {
            return response()->json(['status' => 401, 'message' => 'Current password does not match']);
        }

        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json(['status' => 200]);
    }
}
