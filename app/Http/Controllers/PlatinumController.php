<?php

namespace App\Http\Controllers;

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
        if($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                "plat_name" => "required",
                "plat_ic" => "required",
                "plat_title" => "required",
                "plat_gender" => "required",
                "plat_religion" => "required",
                "plat_race" => "required",
                "plat_citizenship" => "required",
                "plat_photo" => File::image()->max(2000)->rules('required'),
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
            ]);
            $valid = $validator->validated();
            if(User::where('email', $valid['plat_email'])->exists())
            {
                return to_route('register-platinum')->withErrors($validator)->withInput()->with('error','Email already exists!');
            }

            if ($validator->fails())
            {
                return to_route('register-platinum')->withErrors($validator)->withInput();
            }

            $type = $valid['plat_discover_type'];
            if ($type == 'Others') {
                $valid['plat_discover_type'] = $valid['plat_discover_type_other'];
            }

            if ($request->hasFile('plat_payment_proof')) {
                $path = $request->file('plat_payment_proof')
                    ->storeAs('uploads', $request->file('plat_payment_proof')->getClientOriginalName()
                );
                $valid['plat_payment_proof'] = $path;
            }
            $valid['plat_app_confirm'] = $request->input('plat_app_confirm') ? 1 : 0;
            unset($valid['plat_discover_type_other']);

            $user = new User;
            $user->username = str_replace(' ','_',strtolower(trim($valid['plat_name'])));
            $user->email = $valid['plat_email'];
            $user->password = $valid['plat_ic'];
            $user->user_type = Config::get('constants.user.platinum');

            if ($user->save()) {
                $platinum = new Platinum;
                $valid['user_id'] = $user->id;
                $inserted = $platinum->create($valid);
            }

            return to_route('register-success')->with(['user_id' => $user->id]);
        }
        return view('ManageUserProfile/register-platinum');
    }

    public function register_success(Request $request)
    {
        $id = Session::get('user_id');
        $user = User::find($id);
        return view('ManageUserProfile/register-success', ['user' => $user]);
    }
}
