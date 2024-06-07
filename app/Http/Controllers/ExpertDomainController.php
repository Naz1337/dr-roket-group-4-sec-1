<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExpertDomain;
use App\Http\Requests\StoreExpertDomainRequest;
use App\Http\Requests\UpdateExpertDomainRequest;
use App\Models\Platinum;
use App\Models\Publication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ExpertDomainController extends Controller
{


    public function showMyExpert()
    {
        //Function
        if(Auth::check())
        {
            $id = Auth::user()->getPlatinum()->id;
            $myexperts = ExpertDomain::where('platinum_id', $id)->get();
            // dd($myexperts);
        }
        else
        {
            return Redirect::route('login');
        }
        return view('ManageExpertDomain.myExpertDomain', compact('myexperts'));
    }

    public function showListExpert()
    {
        //Function
        if(Auth::check())
        {
        $listexperts = ExpertDomain::all();
        }
        else
        {
            return Redirect::route('login');
        }
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
            $imageName = uniqid().'.'.$image->getClientOriginalExtension();
            $imagePath = $image->storeAs('expert_photos', $imageName, 'public');
        }

        $ed = new ExpertDomain;
        $ed->expert_domain_names = $request->name;
        $ed->expert_domain_emails = $request->email;
        $ed->expert_domain_phonenumbers = $request->phonenum;
        $ed->expert_domain_affiliation = $request->affiliation;
        $ed->expert_domain_research_title = $request->research;
        $ed->expert_domain_designation = implode(',', (array) $request->designation);
        $ed->expert_domain_image = $imagePath;
        $ed->platinum_id = Auth::user()->getPlatinum()->id;
        $ed->save();

        return Redirect::route('my-expert');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpertDomain $expertDomain, string $id)
    {
        if(Auth::check())
        {
            // dd($expertDomain);
            $expert = $expertDomain->findorFail($id);
            // dd($expert);
            $publications = Publication::where('expert_id', $id);
        }
        else
        {
            return Redirect::route('login');
        }
        return view('ManageExpertDomain/viewExpertProfile', compact('expert'), compact('publications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpertDomain $expertDomain, string $id)
    {
        if(Auth::check())
        {
            $expert = $expertDomain->findorFail($id);
        }
        else
        {
            return Redirect::route('login');
        }
        return view('ManageExpertDomain/editExpertProfile', compact('expert'));
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
    public function destroy(ExpertDomain $expertDomain, string $id)
    {
        $ed = $expertDomain->findorFail($id);
        $ed->delete();

        return Redirect::route('my-expert');
    }
}
