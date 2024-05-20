<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function login(Request $request) {
        if($request->isMethod('POST')) {
            $credentials = request()->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            View::share('email',$credentials[0]);
            $loginResult = Auth::attempt($credentials);
            if (!$loginResult) {
                return to_route('login', ['message' => 'Wrong email or password']);
            }
            return to_route('drafts.index', ['message' => 'You are logged in']);
        }
        return view('modern-login');
    }

    public function register() {

    }
    //
}
