<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\Draft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;
use Carbon\Carbon;

class DraftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platinum = Auth::user()->getPlatinum();

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
        }
        else {
            $formattedDate = 'None!';
        }

        return view('drafts.index', [
            'firstStartDate' => $formattedDate,
            'drafts' => Draft::where('platinum_id', $platinumId)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentUser = Auth::user();
        $platinumProfile = $currentUser->getPlatinum();
        if (!isset($platinumProfile)) {
            return to_route('logout');
        }

        $latestDraft = Draft::where('platinum_id', $platinumProfile->id)
            ->orderBy('draft_completion_date', 'desc')->first();

        if ($latestDraft) {
        return view('drafts.create', [
            'previousCompletionDate' => $latestDraft->draft_completion_date,
            'nextDraftNumber' => $latestDraft->draft_number + 1,
            'lastDraftTitle' => $latestDraft->draft_title
        ]);
        }
        else {
            return view('drafts.create', [
                'previousCompletionDate' => '',
                'nextDraftNumber' => '1',
                'lastDraftTitle' => ''
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'draft_title' => 'required|string|max:255',
            'draft_number' => 'nullable|integer|min:1', // Assuming draft_number might be readonly or auto-assigned
            'draft_ddc' => 'required|integer|min:1|max:100',
            'draft_completion_date' => 'required|date',
            'days_taken' => 'required|integer|min:0',
            'draft_file' => 'required|file|mimes:pdf,txt|max:2048', // Max size 2MB
        ];

        $validated = $request->validate($rules);

        $currentUser = Auth::user();

        if ($currentUser->user_type !== config()->get('constants.user.platinum')) {
            abort(401);
        }

        $draft_file = $request->file('draft_file');
        $draft_filename = $draft_file->getClientOriginalName();
        $draft_filepath = $draft_file->store('drafts');

        $extension = pathinfo($draft_filename, PATHINFO_EXTENSION);

        if ($extension === 'pdf') {
            $parser = new Parser();
            $document = $parser->parseFile(Storage::path($draft_filepath));
            $draft_page_count = count($document->getPages());
        }
        else {
            $draft_page_count = 1;
        }

        $draft = new Draft;
        $draft->platinum_id = $currentUser->getPlatinum()->id;
        $draft->draft_title = $validated['draft_title'];

        $currentMaxDraftNumber = Draft::where('platinum_id', $currentUser->getPlatinum()->id)->max('draft_number');
        if (!isset($currentMaxDraftNumber)) {
            $currentMaxDraftNumber = 0;
        }

        $draft->draft_number = ++$currentMaxDraftNumber;

        $draft->draft_completion_date = $validated['draft_completion_date'];
        $draft->draft_ddc = $validated['draft_ddc'];
        $draft->draft_filename = $draft_filename;
        $draft->draft_filepath = $draft_filepath;
        $draft->draft_days_taken = $validated['days_taken'];
        $draft->draft_page_count = $draft_page_count;
        $draft->save();

        return to_route('draft.show', ['draft' => $draft->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Draft $draft)
    {
        $platinumProfile = Auth::user()->getPlatinum();
        if ($platinumProfile->id !== $draft->platinum_id) {
            return to_route('draft.index');
        }

        if (request('download') === '1')
            return Storage::download($draft->draft_filepath, $draft->draft_filename);

        $latestDraft = Draft::where('platinum_id', $platinumProfile->id)
            ->orderBy('draft_number', 'desc')->first();
        $canDelete = $latestDraft->id === $draft->id;

        return view('drafts.show', [
            'draft' => $draft,
            'canDelete' => $canDelete
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Draft $draft)
    {
        // pass kat user max value of days taken.
        // cara nak kira, max value dia kalau dia yang
        // hujung skali, max value dia ialah tarikh completion date sebelum dia, sampai hari ni.
        // kalau dia tak hujung skali, max value dia ialah tarikh sebelum dia sampai
        // completion date dia. aka, current value days taken.

        $platinum = Auth::user()->platinum;
        $draftNumber = $draft->draft_number;
        $minDate = '';
        $timeZone = request()->input('tz', 'UTC');
        $maxDraftNumber = Draft::where('platinum_id', $platinum->id)->max('draft_number');

        if ($draftNumber === 1) {
            $maxDaysTaken = INF;
            if ($draftNumber === Draft::where('platinum_id', $platinum->id)->max('draft_number'))
                $maxDate = '';
            else {
                $latestDraftCDate = Auth::user()->platinum->drafts
                    ->where('draft_number', $maxDraftNumber)->first()->draft_completion_date;
                $latestDraftCDate = Carbon::parse($latestDraftCDate, $timeZone);

                $today = Carbon::now($timeZone);

                $betweenNowAndLatestDraft = floor($latestDraftCDate->diffInDays($today));
                $copy = $betweenNowAndLatestDraft;

                for ($i = 0; $i < $copy; $i++) {
                    if ($today->subDay($i)->dayOfWeek === 0) {
                        $betweenNowAndLatestDraft--;
                    }
                }

                $currentCompletionDate = $draft->draft_completion_date;
                $currentCompletionDate = Carbon::parse($currentCompletionDate, $timeZone);
                for ($j = 0; $j < $betweenNowAndLatestDraft; $j++) {
                    // add 1 day to the current completion date
                    $currentCompletionDate = $currentCompletionDate->addDay(1);
                    // if the day after adding 1 day is sunday, add another day
                    if ($currentCompletionDate->dayOfWeek === 0) {
                        $currentCompletionDate = $currentCompletionDate->addDay(1);
                    }
                }
                $maxDate = $currentCompletionDate->format('Y-m-d');
            }
        }
        else {
            // use Draft model to get the max value of draft number where that draft platinum_id is
            // equal to current user

            // minDate is the completion date of the draft before this draft
            $minDate = Draft::where('platinum_id', $platinum->id)
                ->where('draft_number', $draftNumber - 1)->first()->draft_completion_date;

            if ($draftNumber === $maxDraftNumber) {
                // get the draft before the maxDraftNumber that is owned by the current platinum
                $previousDraft = Draft::where('platinum_id', $platinum->id)
                    ->where('draft_number', $maxDraftNumber - 1)->first();

                $maxDaysTaken = Carbon::parse($previousDraft->draft_completion_date)->diffInDays(Carbon::now($timeZone));

                // round up the maxDaysTaken
                $maxDaysTaken = floor($maxDaysTaken);

                // but we need to minus sundays
                $copy = $maxDaysTaken;
                for ($i = 0; $i < $copy; $i++) {
                    if (Carbon::now($timeZone)->subDay($i)->dayOfWeek === 0) {
                        $maxDaysTaken--;
                    }
                }
                $maxDate = Carbon::now($timeZone)->format('Y-m-d');
            }
            else {
                $maxDaysTaken = $draft->draft_days_taken;

                $latestDraftCDate = Auth::user()->platinum->drafts->
                    where('draft_number', $maxDraftNumber)->first()->draft_completion_date;
                $latestDraftCDate = Carbon::parse($latestDraftCDate, $timeZone);

                $today = Carbon::now($timeZone);

                $betweenNowAndLatestDraft = floor($latestDraftCDate->diffInDays($today));
                $copy = $betweenNowAndLatestDraft;

                for ($i = 0; $i < $copy; $i++) {
                    if ($today->subDay($i)->dayOfWeek === 0) {
                        $betweenNowAndLatestDraft--;
                    }
                }

                $maxDaysTaken += $betweenNowAndLatestDraft;

                $currentCompletionDate = $draft->draft_completion_date;
                $currentCompletionDate = Carbon::parse($currentCompletionDate, $timeZone);
                for ($j = 0; $j < $betweenNowAndLatestDraft; $j++) {
                    // add 1 day to the current completion date
                    $currentCompletionDate = $currentCompletionDate->addDay(1);
                    // if the day after adding 1 day is sunday, add another day
                    if ($currentCompletionDate->dayOfWeek === 0) {
                        $currentCompletionDate = $currentCompletionDate->addDay(1);
                    }
                }
                $maxDate = $currentCompletionDate->format('Y-m-d');
            }
        }

        return view('drafts.edit', [
            'draft' => $draft,
            'maxDaysTaken' => $maxDaysTaken,
            'maxDate' => $maxDate,
            'minDate' => $minDate
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Draft $draft)
    {
        $rules = [
            'draft_title' => 'required|string|max:255',
            'draft_ddc' => 'required|integer|min:1|max:100',
            'draft_completion_date' => 'required|date',
            'draft_days_taken' => 'required|integer|min:0',
            'draft_file' => 'nullable|file|mimes:pdf,txt|max:2048', // Max size 2MB
        ];

        $validated = $request->validate($rules);

        $currentUser = Auth::user();

        if ($currentUser->user_type !== config()->get('constants.user.platinum')) {
            abort(401);
        }

        $draft_file = $request->file('draft_file');
        if ($draft_file) {
            $draft_filename = $draft_file->getClientOriginalName();
            $draft_filepath = $draft_file->store('drafts');

            $extension = pathinfo($draft_filename, PATHINFO_EXTENSION);

            if ($extension === 'pdf') {
                $parser = new Parser();
                $document = $parser->parseFile(Storage::path($draft_filepath));
                $draft_page_count = count($document->getPages());
            }
            else {
                $draft_page_count = 1;
            }

            $draft->draft_filename = $draft_filename;
            $draft->draft_filepath = $draft_filepath;
            $draft->draft_page_count = $draft_page_count;
        }

        $draft->draft_title = $validated['draft_title'];
        $previous_days_taken = $draft->draft_completion_date;
        $draft->draft_completion_date = $validated['draft_completion_date'];
        $draft->draft_ddc = $validated['draft_ddc'];
        $draft->draft_days_taken = $validated['draft_days_taken'];
        $draft->save();

        if ($previous_days_taken !== $draft->draft_completion_date) {
            $draftsAfterCurrent = $currentUser->platinum->drafts->where('draft_number', '>', $draft->draft_number);

            // put the $draft into the first position of the array above
            $draftsAfterCurrent->prepend($draft);

            // for every element in the array $draftsAfterCurrent, starting from its second element
            for ($i = 1; $i < $draftsAfterCurrent->count(); $i++) {
                $carbonObject = Carbon::parse($draftsAfterCurrent[$i - 1]->draft_completion_date);
                for ($j = 0; $j < $draftsAfterCurrent[$i]->draft_days_taken; $j++) {
                    $carbonObject = $carbonObject->addDay(1);
                    if ($carbonObject->dayOfWeek === 0) {
                        $carbonObject = $carbonObject->addDay(1);
                    }
                }
                $draftsAfterCurrent[$i]->draft_completion_date = $carbonObject->format('Y-m-d');
                $draftsAfterCurrent[$i]->save();
            }
        }



        return to_route('draft.show', ['draft' => $draft->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Draft $draft)
    {
        if (Auth::user()->getPlatinum()->id === $draft->platinum_id) {
            $draft->delete();
        }
        return to_route('draft.index');
    }
}
