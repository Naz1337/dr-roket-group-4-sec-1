<?php

namespace App\Http\Controllers;

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

        if ($platinum === null) {
            return to_route('modern');
        }

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

        $parser = new Parser();
        $document = $parser->parseFile(Storage::path($draft_filepath));


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
        $draft->draft_page_count = count($document->getPages());
        $draft->save();



        return to_route('draft.show', ['draft' => $draft->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Draft $draft)
    {
        if (request('download') === '1')
            return Storage::download($draft->draft_filepath, $draft->draft_filename);

        return view('drafts.show', compact('draft'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Draft $draft)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Draft $draft)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Draft $draft)
    {
        //
    }

    public function upload(Request $request)
    {
        $uploadedFiles = $request->file('draft_file');
        if ($request->hasFile('draft_file') && $uploadedFiles->isValid() && $uploadedFiles->extension() == "pdf") {
            $uploadedFiles->store('draft');
        }
        return Redirect::route('drafts.index', ['lol' => $uploadedFiles->extension()]);
    }
}
