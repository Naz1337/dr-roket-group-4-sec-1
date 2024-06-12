<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\Platinum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class PlatinumController extends Controller
{
    public function register_platinum(Request $request) {
        // Check if the request method is POST
        if($request->isMethod('POST')) {
            // Define custom error messages
            $messages = [
                'plat_photo.required' => 'The photo is required.',
                'plat_photo.image' => 'The file must be an image.',
                'plat_photo.max' => 'The image must not be greater than 2MB.',
            ];

            // Validate the request data
            $validator = Validator::make($request->all(), [
                "plat_name" => "required",
                "plat_ic" => "required",
                "plat_title" => "required",
                "plat_gender" => "required",
                "plat_religion" => "required",
                "plat_race" => "required",
                "plat_citizenship" => "required",
                "plat_photo" => "required|image|max:2000",
//                "plat_photo" => File::image()->max(2000)->rules('required'),
//                "plat_type" => "required",
                "plat_address" => "required",
                "plat_address2" => "required",
                "plat_city" => "required",
                "plat_state" => "required",
                "plat_postcode" => "required",
                "plat_country" => "required",
                "plat_phone_no" => "required",
                "plat_email" => "required|email",
                "plat_fbname" => "required",
                "plat_cur_edu_level" => "required",
                "plat_edu_field" => "required",
                "plat_edu_institute" => "required",
                "plat_occupation" => "required",
                "plat_study_sponsor" => "required",
                "plat_discover_type" => "required",
                "plat_discover_type_other" => "nullable",
                "plat_prog_interest" => "required",
                "plat_batch" => "required",
                "plat_has_referral" => "required|boolean",
                "plat_referral_name" => "nullable",
                "plat_referral_batch" => "nullable",
                "plat_tshirt" => "required",
                "plat_app_confirm" => "accepted",
                "plat_app_confirm_date" => 'required|date_format:Y-m-d',
                "plat_payment_type" => "required",
                "plat_payment_proof" => "required",
            ], $messages);

            if ($validator->fails())
            {
                // Check if the error is specifically for 'plat_photo'
                if ($validator->errors()->has('plat_photo')) {
                    return to_route('register-platinum')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', 'Image upload failed: ' . $validator->errors()->first('plat_photo'));
                }

                return to_route('register-platinum')->withErrors($validator)->withInput()->with('error','Fill all the fields!');
            }

            // Validate the data
            $valid = $validator->validated();

            // Check if the email already exists
            if(User::where('email', $valid['plat_email'])->exists())
            {
                return to_route('register-platinum')->withErrors($validator)->withInput()->with('error','Email already exists!');
            }

            $imagePath = null;

            // Handle file upload for plat_photo
            if ($request->hasFile('plat_photo')) {
                $image = $request->file('plat_photo');
                $imageName = uniqid().'.'.$image->getClientOriginalExtension(); // Generate unique image name
                $imagePath = $image->storeAs('user_photos', $imageName, 'public'); // Store image to 'public/user_photos' folder
            }

            // Handle the 'Others' option in plat_discover_type
            $type = $valid['plat_discover_type'];
            if ($type == 'Others') {
                $valid['plat_discover_type'] = $valid['plat_discover_type_other'];
            }

            // Handle file upload for plat_payment_proof
            if ($request->hasFile('plat_payment_proof')) {
                $file = $request->file('plat_payment_proof');
                $fileName = uniqid().'.'.$file->getClientOriginalExtension();
                $path = $file->storeAs('user_files', $fileName, 'public');
                $valid['plat_payment_proof'] = $path;
            }
            // Set plat_app_confirm based on input
            $valid['plat_app_confirm'] = $request->input('plat_app_confirm') ? 1 : 0;
            unset($valid['plat_discover_type_other']);

            // Create a new User instance
            $user = new User;
            $user->username = str_replace(' ','_',strtolower(trim($valid['plat_name'])));
            $user->email = $valid['plat_email'];
            $user->password = $valid['plat_ic'];
            $user->user_type = Roles::PLATINUM;

            // Save the user and create a corresponding Platinum record
            if ($user->save()) {
                $platinum = new Platinum;
                $valid['user_id'] = $user->id;
                $valid['plat_photo'] = $imagePath;
                $inserted = $platinum->create($valid);
            }

            // Redirect to the register success page
            return to_route('register-success')->with(['user_id' => $user->id]);
        }
        // Render the registration form view if the request method is not POST
        return view('ManageUserProfile/register-platinum');
    }

    public function register_success(Request $request)
    {
        // Get the user ID from the session
        $id = Session::get('user_id');
        // Find the user by ID
        $user = User::find($id);
        // Render the success view with the user data
        return view('ManageUserProfile/register-success', ['user' => $user]);
    }
}
