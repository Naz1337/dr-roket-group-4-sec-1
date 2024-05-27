<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExpertDomain;
use App\Http\Requests\StoreExpertDomainRequest;
use App\Http\Requests\UpdateExpertDomainRequest;
use App\Models\Platinum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ExpertDomainController extends Controller
{


    public function showMyExpert()
    {
        //Function
        $id = Auth::id();
        $myexperts = optional(Platinum::with('myexperts')->get());

        return view('ManageExpertDomain.myExpertDomain', compact('myexperts'));
    }

    public function showListExpert()
    {
        //Function
        $listexperts = optional(ExpertDomain::all());

        return view('ManageExpertDomain/listExpertDomain', compact('listexperts'));
    }


    public function generateReport()
    {
        $allreports = optional(ExpertDomain::all());

        return view('ManageExpertDomain/generateReportExpert', compact('allreports'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ManageExpertDomain/addExpertProfile');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpertDomainRequest $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'name' => 'required',
        //     'emails' => 'required',
        //     'affiliation' => 'required|max:255',
        //     'research' => 'required'
        // ]);
        
        // dd($request->name);
        $imageData = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = file_get_contents($image->getRealPath());
        }

        $ed = new ExpertDomain;
        $ed->expert_domain_names = $request->name;
        $ed->expert_domain_emails = $request->email;
        $ed->expert_domain_phonenumbers = $request->phonenum;
        $ed->expert_domain_affiliation = $request->affiliation;
        $ed->expert_domain_research_title = $request->research;
        $ed->expert_domain_designation = implode(',', (array) $request->designation);
        $ed->expert_domain_image = $imageData;
        $ed->platinum_id = null;
        $ed->save();

        return Redirect::route('myexpert');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpertDomain $expertDomain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpertDomain $expertDomain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpertDomainRequest $request, ExpertDomain $expertDomain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpertDomain $expertDomain)
    {
        //
    }
}
