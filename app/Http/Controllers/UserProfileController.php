<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    public function manage_user_profile(Request $request)
    {
        if ($request->ajax()) {
            // Your Laravel query to fetch data
            $users = DB::table('users')
                ->leftJoin('platinums as p', 'p.user_id', '=', 'users.id')
                ->leftJoin('user_profiles as up', 'up.user_id', '=', 'users.id')
                ->selectRaw('
            CASE WHEN users.user_type != 0 THEN up.profile_name ELSE p.plat_name END as name,
            users.email,
            users.user_type,
            CASE WHEN users.user_type != 0 THEN "" ELSE p.plat_cur_edu_field END as cur_field,
            CASE WHEN users.user_type != 0 THEN "" ELSE p.plat_edu_institute END as institute,
            CASE WHEN users.user_type != 0 THEN "" ELSE p.plat_batch END as batch,
            CASE WHEN users.user_type != 0 THEN "" ELSE p.plat_app_confirm_date END as confirm,
            users.id
        ')
                ->get();

            // Get the total count of entries
            $totalCount = count($users);

            return response()->json([
                'data' => $users,
                'recordsTotal' => $totalCount, // Total records before filtering
                'recordsFiltered' => $totalCount // Total records after filtering (if filtering is applied)
            ]);
        }

        return view('ManageUserProfile/index');
    }
}
