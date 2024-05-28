<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Spatie\FlareClient\Report;

class UserProfileController extends Controller
{
    public function manage_user_profile(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('users')
                ->leftJoin('platinums as p', 'p.user_id', '=', 'users.id')
                ->leftJoin('user_profiles as up', 'up.user_id', '=', 'users.id')
                ->selectRaw('
            CASE WHEN users.user_type != 0 AND users.user_type != 1 THEN up.profile_name ELSE p.plat_name END as name,
            users.email,
            users.user_type,
            CASE WHEN users.user_type != 0 AND users.user_type != 1 THEN "" ELSE p.plat_cur_edu_level END as cur_level,
            CASE WHEN users.user_type != 0 AND users.user_type != 1 THEN "" ELSE p.plat_edu_institute END as institute,
            CASE WHEN users.user_type != 0 AND users.user_type != 1 THEN "" ELSE p.plat_batch END as batch,
            CASE WHEN users.user_type != 0 AND users.user_type != 1 THEN "" ELSE p.plat_app_confirm_date END as confirm,
            users.id
            ');

            //region Where Clause
            if (in_array(Auth::user()->user_type, Config::get('constants.user.platOrCRMP'))) {
                $query->where('user_type', '=', Config::get('constants.user.platinum'))
                ->where('user_type', '=', Config::get('constants.user.crmp'));
            }

            if ($request->has('name') && $request->name != '') {
                $query->whereRaw('plat_name like \'%' . $request->name . '%\' OR profile_name LIKE \'%' . $request->name . '%\'');
            }

            if ($request->has('user_type') && $request->user_type != '') {
                $query->where('user_type', '=', $request->input('user_type'));
            }

            if ($request->has('edu_level') && $request->edu_level != '') {
                $query->where('plat_cur_edu_level', '=', $request->input('edu_level'));
            }

            if ($request->has('institute') && $request->institute != '') {
                $query->where('plat_edu_institute', '=', $request->input('institute'));
            }

            if ($request->has('batch') && $request->batch != '') {
                $query->where('plat_batch', '=', $request->input('batch'));
            }
            //endregion

            $users = $query->get();

            $totalCount = count($users);

            return response()->json([
                'data' => $users,
                'recordsTotal' => $totalCount, // Total records before filtering
                'recordsFiltered' => $totalCount // Total records after filtering (if filtering is applied)
            ]);
        }

        return view('ManageUserProfile/index');
    }

    public function view_profile(string $id,Request $request) {
        $users = User::where('id', $id)->first();
        return view('ManageUserProfile/view-profile')->with('user', $users);
    }

    public function generateReportExcel(Request $request) {
        //region Eloquent Query
        $query = DB::table('users')
            ->leftJoin('platinums as p', 'p.user_id', '=', 'users.id')
            ->leftJoin('user_profiles as up', 'up.user_id', '=', 'users.id')
            ->selectRaw('
                CASE WHEN users.user_type != 0 AND users.user_type != 1 THEN up.profile_name ELSE p.plat_name END as name,
                users.email,
                users.user_type,
                CASE WHEN users.user_type != 0 AND users.user_type != 1 THEN "" ELSE p.plat_cur_edu_level END as cur_level,
                CASE WHEN users.user_type != 0 AND users.user_type != 1 THEN "" ELSE p.plat_edu_institute END as institute,
                CASE WHEN users.user_type != 0 AND users.user_type != 1 THEN "" ELSE p.plat_batch END as batch,
                CASE WHEN users.user_type != 0 AND users.user_type != 1 THEN "" ELSE p.plat_app_confirm_date END as confirm,
                p.plat_ic,
                p.plat_title,
                p.plat_gender,
                p.plat_religion,
                p.plat_race,
                p.plat_citizenship,
                p.plat_photo,
                p.plat_address,
                p.plat_address2,
                p.plat_city,
                p.plat_state,
                p.plat_postcode,
                p.plat_country,
                p.plat_phone_no,
                p.plat_fbname,
                p.plat_edu_field,
                p.plat_occupation,
                p.plat_study_sponsor,
                p.plat_discover_type,
                p.plat_prog_interest,
                p.plat_has_referral,
                p.plat_referral_name,
                p.plat_referral_batch,
                p.plat_tshirt,
                p.plat_app_confirm,
                p.plat_payment_type,
                p.plat_payment_proof,
                p.created_at,
                p.updated_at,
                users.id
            ');
        //endregion

        //region Where Clause
        if ($request->has('name') && $request->name != '') {
            $query->whereRaw('plat_name like \'%' . $request->name . '%\' OR profile_name LIKE \'%' . $request->name . '%\'');
        }

        if ($request->has('user_type') && $request->user_type != '') {
            $query->where('user_type', '=', $request->input('user_type'));
        }

        if ($request->has('edu_level') && $request->edu_level != '') {
            $query->where('plat_cur_edu_level', '=', $request->input('edu_level'));
        }

        if ($request->has('institute') && $request->institute != '') {
            $query->where('plat_edu_institute', '=', $request->input('institute'));
        }

        if ($request->has('batch') && $request->batch != '') {
            $query->where('plat_batch', '=', $request->input('batch'));
        }
        //endregion

        $queryResults = $query->get();

        //region Excel convert
        // Load Excel file
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $headers = [
            'Name', 'Email', 'User Type', 'Current Level', 'Institute', 'Batch', 'IC', 'Title', 'Gender', 'Religion', 'Race',
            'Citizenship', 'Address', 'Address2', 'City', 'State', 'Postcode', 'Country', 'Phone No', 'FB Name', 'Education Field', 'Occupation',
            'Study Sponsor', 'Discover Type', 'Program Interest', 'Has Referral', 'Referral Name', 'Referral Batch', 'T-Shirt', 'App Confirm', 'App Confirm Date',
            'Payment Type', 'Created At', 'Updated At'
        ];
        $sheet->fromArray([$headers], null, 'A1');

        // Add data
        $row = 2;
        foreach ($queryResults as $result) {
            $rowData = [
                $result->name,
                $result->email,
                $result->user_type,
                $result->cur_level,
                $result->institute,
                $result->batch,
                $result->plat_ic,
                $result->plat_title,
                match($result->plat_gender) {
                    0 => "Male",
                    1 => "Female",
                    default => ""
                },
                $result->plat_religion,
                $result->plat_race,
                $result->plat_citizenship,
                $result->plat_address,
                $result->plat_address2,
                $result->plat_city,
                $result->plat_state,
                $result->plat_postcode,
                $result->plat_country,
                $result->plat_phone_no,
                $result->plat_fbname,
                $result->plat_edu_field,
                $result->plat_occupation,
                $result->plat_study_sponsor,
                $result->plat_discover_type,
                match($result->plat_prog_interest) {
                    Config::get('constants.program.plat_professorship') => "Platinum Professorship",
                    Config::get('constants.program.plat_premier') => "Platinum Premier",
                    Config::get('constants.program.plat_elite') => "Platinum Elite",
                    Config::get('constants.program.plat_drjr') => "Platinum Dr. Jr.",
                    default => ''
                },
                match($result->plat_has_referral) {
                    Config::get('constants.bool.false') => "False",
                    Config::get('constants.bool.true') => "True",
                    default => ''
                },
                $result->plat_referral_name,
                $result->plat_referral_batch,
                $result->plat_tshirt,
                $result->confirm,
                match($result->plat_app_confirm) {
                    Config::get('constants.bool.false') => "False",
                    Config::get('constants.bool.true') => "True",
                    default => ''
                },
                match($result->plat_prog_interest) {
                    Config::get('constants.payment.FPX/Credit Card/Debit Card') => "FPX/Credit Card/Debit Card",
                    Config::get('constants.payment.FPX-Referral') => "FPX-Referral",
                    Config::get('constants.payment.Direct Transfer/Payment') => "Direct Transfer/Payment",
                    default => ''
                },
                $result->created_at,
                $result->updated_at,
            ];
            $sheet->fromArray([$rowData], null, 'A' . $row);
            $row++;
        }
        // Save the spreadsheet to a file
        $excelFilePath = storage_path('app/user_profiles.xlsx');
        $writer = new Xlsx($spreadsheet);
        $writer->save($excelFilePath);
        //endregion

        return response()->download($excelFilePath, 'user_profiles' . now() . '.xlsx');
    }
}
