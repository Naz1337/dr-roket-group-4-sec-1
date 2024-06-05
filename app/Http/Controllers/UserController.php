<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rules\File;

class UserController extends Controller
{
    public function login(Request $request) {
        $message = $request->query('message', '');
        if(request()->isMethod('POST')) {
            $credentials = request()->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $loginResult = Auth::attempt($credentials);
            if (!$loginResult) {
                return to_route('login')->with('error', 'Wrong username or password!')->with('error-type', 'danger');
            }
            return to_route('dashboard');
        }
        if(Auth::check()) {
            return to_route('dashboard');
        }
        return view('modern-login', ['message' => $message]);
    }

    public function register(Request $request) {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'username' => 'required|unique:users,username',
                'email' => 'required|email:rfc|unique:users,email',
                'password' => 'required|min:2',
                'image' => File::image()->max(2000),
                'birth_date' => 'required|date_format:Y-m-d',
                'phone_no' => 'required',
//                'phone_no' => 'required|regex:/^[0-9]{10,15}$/',
                'profile_name' => 'required',
                'address' => 'required|string|max:255',
                'address2' => 'required|string|max:255',
            ]);
            $imagePath = null;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = uniqid().'.'.$image->getClientOriginalExtension(); // Generate unique image name
                $imagePath = $image->storeAs('user_photos', $imageName, 'public'); // Store image to 'public/user_photos' folder
            }

            $newUser = new User;
            $newUser->username = $validated['username'];
            $newUser->email = $validated['email'];
            $newUser->password = Hash::make($validated['password']);
            $newUser->user_type = 2;

            if ($newUser->save()) {

                $userProfile = new UserProfile;
                $userProfile->user_id = $newUser->id;
                $userProfile->profile_name = $validated['profile_name']; // Example profile name
                $userProfile->birth_date = $validated['birth_date']; // Example birthdate
                $userProfile->profile_email = $newUser->email;
                $userProfile->user_photo = $imagePath; // Save image data
                $userProfile->phone_no = $validated['phone_no'];
                $userProfile->address = $validated['address'];
                $userProfile->address2 = $validated['address2'];

                $userProfile->save();

                return redirect()->route('login')->with('error', 'Registration successful.')->with('error-type', 'success');
            }

            return view('register');
        }
        return view('register');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->with('error', 'You have been logged out')->with('error-type', 'info');
    }
}
