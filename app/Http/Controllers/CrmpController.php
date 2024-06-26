<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\Draft;
use App\Models\FeedbackMessage;
use App\Models\Platinum;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (!$platinum->is_crmp) {
            Platinum::where('assigned_crmp_id', $platinum->id)->update(['assigned_crmp_id' => null]);
        }

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

    public function myPlatinums() {
        $isMentor = Auth::user()->user_type === Roles::MENTOR;

        if ($isMentor) {
            $platinums = Platinum::where('is_crmp', true)->get();
        }
        else {
            $platinums = Platinum::where('assigned_crmp_id', Auth::user()->id)->get();
        }

        return view('crmp.my_platinums', [
            'platinums' => $platinums
        ]);
    }

    public function viewDraftProgress(Platinum $platinum)
    {
        $platinumId = $platinum->id;
        $earliestDraft = Draft::where('platinum_id', $platinumId)->orderBy('draft_completion_date', 'asc')->first();

        if ($earliestDraft !== null) {
            $carbonObject = Carbon::parse($earliestDraft->draft_completion_date);
            for ($i = 0; $i < $earliestDraft->draft_days_taken; $i++) {
                $carbonObject = $carbonObject->subDay(1);
                if ($carbonObject->dayOfWeek == 0)
                    $carbonObject = $carbonObject->subDay(1);
            }
            $formattedDate = $carbonObject->format('d F Y');
        } else {
            $formattedDate = 'None!';
        }

        return view('crmp.draft_progress', [
            'platinum' => $platinum,
            'firstStartDate' => $formattedDate,
            'drafts' => Draft::where('platinum_id', $platinumId)->get()
        ]);
    }

    public function feedback(Request $request, String $type, Platinum $platinum )
    {
        $rules = [
            'feedback' => 'required|string|max:255'
        ];

        $validated = $request->validate($rules);

        $platinum->feedbackMessages()->create([
            'message' => $validated['feedback'],
            'type' => $type,
            'user_id' => Auth::id()
        ]);

        // return them to where they come from
        return back();
    }

    public function weeklyFocus(Platinum $platinum)
    {
        return view('crmp.weekly_focus', [
            'platinum' => $platinum
        ]);
    }
}
