<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function login(Request $request) {
        if($request->isMethod('POST')) {
            $credentials = request()->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            View::share('email',$credentials['email']);
            $loginResult = Auth::attempt($credentials);
            if (!$loginResult) {
                return to_route('login', ['message' => 'Wrong email or password']);
            }
            return to_route('modern');
        }
        return view('modern-login');
    }

    public function register(Request $request) {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'username' => 'required|unique:users,name',
                'email' => 'required|email:rfc|unique:users,email',
                'password' => 'required|min:2',
            ]);

            $newUser = new User;
            $newUser->name = $validated['username'];
            $newUser->email = $validated['email'];
            $newUser->password = Hash::make($validated['password']);
            $newUser->user_type = 3;

            if ($newUser->save()) {
                return to_route('login', ['message' => 'ya did it']);
            }

            return to_route('register', ['message' => 'saving to db failed, RARE ENDING']);
        }
        return view('register');
    }
}
