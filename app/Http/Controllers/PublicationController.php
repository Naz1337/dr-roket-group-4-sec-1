<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Platinum;
use App\Models\ExpertDomain;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publications = auth()->user()->platinum()->publications()->latest()->get();
        return view('publications.index', compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        
            $users = User::all(); // Assuming all users are either Expert Domain or Platinum
            return view('publications.create', compact('users'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'date' => 'required|date',
            'content' => 'required',
            'type' => 'required',
            'volume' => 'required',
            'issues' => 'required',
            'pages' => 'required',
            'description' => 'required',

        ]);

        $publication = new Publication($request->all());
        $publication->user_id = auth()->id();
        $publication->save();

        return redirect()->route('home')->with('success', 'Publication created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('publications.show', compact('publication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expertDomains = ExpertDomain::all();
        $platinums = Platinum::all();
        return view('publications.edit', compact('publication', 'expertDomains', 'platinums'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publication $publication)
    {
        $request->validate([
            'authors' => 'required|string',
            'title' => 'required|string',
            'publisheddate' => 'required|date',
            'type' => 'required|string',
            'description' => 'required|string',
            'p_path' => 'required|string',
            'p_filename' => 'required|string',
            'expert_domain_id' => 'required|exists:expert_domains,id',
            'platinum_id' => 'required|exists:platinums,id',
            'doi' => 'nullable|string',
        ]);

        $publication->update($request->all());

        return redirect()->route('home')->with('success', 'Publication updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        $publication->delete();
        return redirect()->route('home')->with('success', 'Publication deleted successfully.');
    }
}
