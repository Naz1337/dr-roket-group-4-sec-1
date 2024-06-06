<?php

namespace App\Http\Controllers;

use App\Models\Platinum;
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
}
