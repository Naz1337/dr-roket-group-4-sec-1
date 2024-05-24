<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function login(Request $request) {
        $message = $request->query('message', '');
        if(request()->isMethod('POST')) {
            $credentials = request()->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            // Modify the key 'email' to 'username' in the credentials array
            $credentials['username'] = $credentials['username'];
            unset($credentials['email']);

            $loginResult = Auth::attempt($credentials);
            if (!$loginResult) {
                return to_route('login', ['message' => 'Wrong email or password']);
            }
            return to_route('modern');
        }
        if(Auth::check()) {
            return to_route('modern');
        }
        return view('modern-login', ['message' => $message]);
    }

    public function register(Request $request) {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'username' => 'required|unique:users,username',
                'email' => 'required|email:rfc|unique:users,email',
                'password' => 'required|min:2',
            ]);
            $imageData = null;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageData = file_get_contents($image->getRealPath());
            }

            $newUser = new User;
            $newUser->username = $validated['username'];
            $newUser->email = $validated['email'];
            $newUser->password = Hash::make($validated['password']);
            $newUser->user_type = 2;

            if ($newUser->save()) {
                // Create user profile
                $userProfile = new UserProfile;
                $userProfile->user_id = $newUser->id;
                $userProfile->profile_name = 'default'; // Example profile name
                $userProfile->birth_date = now(); // Example birth date
                $userProfile->profile_email = $newUser->email;
                $userProfile->user_photo = $imageData; // Save image data
                $userProfile->save();

                return redirect()->route('login')->with('message', 'Registration successful.');
            }

            return view('register');
        }
        return view('register');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->with('message', 'You have been logged out');
    }
}
