<?php

namespace App\Http\Controllers;

use App\Models\Platinum;
use Illuminate\Http\Request;

class PlatinumController extends Controller
{
    public function register_platinum(Request $request) {
        if($request->isMethod('POST')) {
            $valid = $request->validate([
                "plat_name" => "required",
                "plat_ic" => "required",
                "plat_title" => "required",
                "plat_gender" => "required",
                "plat_religion" => "required",
                "plat_race" => "required",
                "plat_citizenship" => "required",
                "plat_photo" => "required",
                "plat_type" => "required",
                "plat_address" => "required",
                "plat_address2" => "required",
                "plat_city" => "required",
                "plat_state" => "required",
                "plat_postcode" => "required",
                "plat_phone_no" => "required",
                "plat_email" => "required",
                "plat_cur_edu_field" => "required",
                "plat_edu_field" => "required",
                "plat_edu_institute" => "required",
                "plat_occupation" => "required",
                "plat_study_sponsor" => "required",
                "plat_discover_type" => "required",
                "plat_prog_interest" => "required",
                "plat_batch" => "required",
            ]);
            $platinum = new Platinum;
            $inserted = $platinum->create($request->all());

            return to_route('manage-platinum');
        }
        return view('ManageUserProfile.register-platinum');
    }

    public function manage_platinum(Request $request)
    {
        return view('ManageUserProfile/index');
    }
}
