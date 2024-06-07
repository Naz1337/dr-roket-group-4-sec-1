<?php

namespace App\Http\Controllers;

use App\Models\Platinum;
use App\Models\User;
use Illuminate\Http\Request;

class CrmpController extends Controller
{
    public function index()
    {
        $query = request()->input('query');
        if ($query !== null && $query !== '') {
            $query = substr($query, 0, 50);
            $platinums = Platinum::where('plat_name', 'like', "%$query%")
                ->whereOr('plat_email', 'like', "%$query%")
                ->whereOr('plat_phone_no', 'like', "%$query%")->get();
        }
        else {
            $platinums = Platinum::all();
            $query = '';
        }

        return view('crmp.index', [
            'platinums' => $platinums,
            'query' => $query
        ]);
    }

    public function toggleCrmp(Platinum $platinum) {
        $platinum->is_crmp = ! $platinum->is_crmp;
        $platinum->save();
        return to_route('crmp.index');
    }

    public function unassignCrmp(Platinum $platinum) {
        $platinum->assigned_crmp_id = null;
        $platinum->save();
        return to_route('view-profile-id', ['id' => $platinum->user_id]);
    }

    public function assignCrmp(Request $request, Platinum $platinum, User $crmp = null) {
        if ($request->isMethod('GET')) {
            $query = request()->input('query', '');
            if ($query !== '') {
                $query = substr($query, 0, 50);
                $crmps = Platinum::where(function ($q) use ($query) {
                    $q->where('plat_name', 'like', "%$query%")
                        ->orWhere('plat_email', 'like', "%$query%");
                })->where('is_crmp', true)->get();
            }
            else {
                $crmps = Platinum::where('is_crmp', true)->get();
            }

            return view('crmp.assign', [
                'platinum1' => $platinum,
                'crmps' => $crmps,
                'query' => $query
            ]);
        }

        $platinum->assigned_crmp_id = $crmp->id;
        $platinum->save();
        return to_route('view-profile-id', ['id' => $platinum->user_id]);
    }
}
