<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;

class DraftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('drafts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('drafts.create');
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
//            return to_route('drafts.create')->with('error', 'You are not allowed to create drafts.');
            abort(401);
        }

        $draft_file = $request->file('draft_file');
        $draft_filename = $draft_file->getClientOriginalName();
        $draft_filepath = $draft_file->store('drafts');

        $draft = new Draft;
        $draft->platinum_id = $currentUser->getPlatinum()->id;
        $draft->draft_title = $validated['draft_title'];

        $currentMaxDraftNumber = Draft::where('platinum_id', $currentUser->getPlatinum()->id)->max('draft_number');
        if (isnull($currentMaxDraftNumber)) {
            $currentMaxDraftNumber = 0;
        }

        $draft->draft_number = ++$currentMaxDraftNumber;

        $draft->draft_completion_date = $validated['draft_completion_date'];
        $draft->draft_ddc = $validated['draft_ddc'];
        $draft->draft_filename = $draft_filename;
        $draft->draft_filepath = $draft_filepath;
        $draft->draft_days_taken = $validated['days_taken'];
        $draft->save();

        return to_route('drafts.index', ['scs'=>$draft->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Draft $draft)
    {
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
