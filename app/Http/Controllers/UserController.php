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
        // Get any message passed through the query string, default to an empty string if not present.
        $message = $request->query('message', '');
        // Check if the request method is POST.
        if(request()->isMethod('POST')) {
            // Validate the incoming request data.
            $credentials = request()->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            // Attempt to authenticate the user with the provided credentials
            $loginResult = Auth::attempt($credentials);
            if (!$loginResult) {
                // If authentication fails, redirect back to the login page with an error message.
                return to_route('login')->with('error', 'Wrong username or password!')->with('error-type', 'danger');
            }
            // If authentication succeeds, redirect to the dashboard.
            return to_route('dashboard');
        }

        if(Auth::check()) {
            // If the user is already authenticated, redirect to the dashboard.
            return to_route('dashboard');
        }
        // Display the login view with any message passed in the query string.
        return view('modern-login', ['message' => $message]);
    }

    public function register(Request $request) {
        // Check if the request method is POST
        if ($request->isMethod('POST')) {
            // Validate the incoming request data.
            $validated = $request->validate([
                'username' => 'required|unique:users,username',
                'email' => 'required|email:rfc|unique:users,email',
                'password' => 'required|min:2',
                'image' => File::image()->max(2000),
                'birth_date' => 'required|date_format:Y-m-d',
                'phone_no' => 'required',
                'user_type' => 'required',
//                'phone_no' => 'required|regex:/^[0-9]{10,15}$/',
                'profile_name' => 'required',
                'address' => 'required|string|max:255',
                'address2' => 'required|string|max:255',
            ]);
            $imagePath = null;

            // Check if an image file was uploaded.
            if ($request->hasFile('image')) {
                // Get the uploaded image file.
                $image = $request->file('image'); // Generate a unique name for the image file.
                $imageName = uniqid().'.'.$image->getClientOriginalExtension(); // Generate unique image name
                $imagePath = $image->storeAs('user_photos', $imageName, 'public'); // Store image to 'public/user_photos' folder
            }

            // Create a new User instance and set its attributes.
            $newUser = new User;
            $newUser->username = $validated['username'];
            $newUser->email = $validated['email'];
            $newUser->password = Hash::make($validated['password']);
            $newUser->user_type = $validated['user_type'];

            // Save the new user to the database.
            if ($newUser->save()) {
                // Create a new UserProfile instance and set its attributes.
                $userProfile = new UserProfile;
                $userProfile->user_id = $newUser->id;
                $userProfile->profile_name = $validated['profile_name'];
                $userProfile->birth_date = $validated['birth_date'];
                $userProfile->profile_email = $newUser->email;
                $userProfile->user_photo = $imagePath;
                $userProfile->phone_no = $validated['phone_no'];
                $userProfile->address = $validated['address'];
                $userProfile->address2 = $validated['address2'];
                $userProfile->save(); // Save the new user profile to the database.
                // Redirect to the login page with a success message.
                return redirect()->route('login')->with('error', 'Registration successful.')->with('error-type', 'success');
            }
            // If user saving fails, display the registration view.
            return view('register');
        }
        // Display the registration view.
        return view('register');
    }

    public function logout(Request $request) {
        // Log the user out of the application.
        Auth::logout();
        $request->session()->invalidate(); // Invalidate the user's session.
        $request->session()->regenerateToken(); // Regenerate the session token to prevent session fixation.
        return redirect('login')->with('error', 'You have been logged out')->with('error-type', 'info'); // Redirect to the login page with a logout message.
    }
}
