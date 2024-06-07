<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Platinum;
use App\Models\ExpertDomain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) 
        {
            $id = Auth::user()->getPlatinum()->id;
            $publications = Publication::where('platinum_id', $id)->get();
            return view('ManagePublication.mypublication', compact('publications'));
        }
        return Redirect::route('login');
    }
    public function showListPublication()
    {
        if (Auth::check()) {
            $listexperts = ExpertDomain::all();
            return view('ManagePublication.listExpertDomain', compact('listexperts'));
        } else {
            return Redirect::route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('Form Data:', $request->all());
    dd($request->all());
        $data=$request->validate([
            'P_authors' => 'required|string',
            'P_title' => 'required|string',
            'P_published_date' => 'required|date',
            'P_type' => 'required|integer',
            'P_volume' => 'required|integer',
            'P_issues' => 'required|integer',
            'P_pages' => 'required|integer',
            'P_publisher' => 'required|string',
            'P_description' => 'required|string',
            'P_path' => 'required|string',
        ]);
        \Log::info('Validated Data:', $data);
        $currentUser = Auth::user();
        $publication = new Publication();
        $publication->platinum_id = $currentUser->getPlatinum()->id;
        $publication->P_authors = $data['P_authors'];
        $publication->P_title = $data['P_title'];
        $publication->P_published_date = $data ['P_published_date'];
        $publication->P_type = json_encode($data['P_type']); // Save as JSON
        $publication->P_volume = $data ['P_volume'];
        $publication->P_issue = $data ['P_issue'];
        $publication->P_pages = $data['P_pages'];
        $publication->P_publisher = $data['P_publisher'];
        $publication->P_description = $data ['P_description'];
        $publication->P_path = $data['P_path'];
        // $publication->platinum_id = Auth::user()->getPlatinum()->id;
        $publication->save();
        \Log::info('Publication:', $publication);
            // Check if publication is saved
            if ($publication->save()) {
                \Log::info('Publication saved:', $publication->toArray());
                return redirect()->route('publications.index')->with('success', 'Publication created successfully.');
            } else {
                \Log::error('Failed to save spublication');
                return back()->with('error', 'Failed to create publication.');
            }
    }

    

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $publication = Publication::findOrFail($id);
    //     return view('publications.show', compact('publication'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $publication = Publication::findOrFail($id);
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
            'P_authors' => 'required|string',
            'P_title' => 'required|string',
            'P_published_date' => 'required|date',
            'P_type' => 'required|integer',
            'P_volume' => 'required|integer',
            'P_issues' => 'required|integer',
            'P_pages' => 'required|integer',
            'P_publisher' => 'required|string',
            'P_description' => 'required|string',
            'P_path' => 'required|string',
        ]);

        $publication->update($request->all());

        return Redirect::route('mypublication')->with('success', 'Publication updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        $publication->delete();
        return Redirect::route('mypublication')->with('success', 'Publication deleted successfully.');
    }
    
}
