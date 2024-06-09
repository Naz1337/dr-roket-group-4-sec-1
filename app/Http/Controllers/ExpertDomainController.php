<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExpertDomain;
use App\Http\Requests\StoreExpertDomainRequest;
use App\Http\Requests\UpdateExpertDomainRequest;
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
        if(Auth::check())
        {
            $id = Auth::user()->getPlatinum()->id;
            $myexperts = ExpertDomain::where('platinum_id', $id)->get();
        }
        else
        {
            return Redirect::route('login');
        }
        return view('ManageExpertDomain/generateReportExpert', compact('myexperts'));
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

        $request->validate([
            'ed_name' => 'required',
            'ed_email' => 'required',
            'ed_phonenum' => 'required',
            'ed_affiliation' => 'required',
            'ed_research' => 'required'
        ]);

        $imageData = null;

        if ($request->hasFile('ed_image'))
        {
            $image = $request->file('ed_image');
            $imageName = uniqid().'.'.$image->getClientOriginalExtension();
            $imagePath = $image->storeAs('expert_photos', $imageName, 'public');
        }
        else
        {
            $imagePath = "null";
        }

        $ed = new ExpertDomain;
        $ed->expert_domain_names = $request->ed_name;
        $ed->expert_domain_emails = $request->ed_email;
        $ed->expert_domain_phonenumbers = $request->ed_phonenum;
        $ed->expert_domain_affiliation = $request->ed_affiliation;
        $ed->expert_domain_research_title = $request->ed_research;
        $ed->expert_domain_designation = implode(',', (array) $request->ed_designation);
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
            $publications = Publication::where('expert_domain_id', '=', $id)->get();

            // dd($publications);
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
    public function update(UpdateExpertDomainRequest $request, ExpertDomain $expertDomain, string $id)
    {
        if(Auth::check())
        {
            $request->validate([
                'ed_name' => 'required',
                'ed_email' => 'required',
                'ed_phonenum' => 'required',
                'ed_affiliation' => 'required',
                'ed_research' => 'required'
            ]);

            $ed = $expertDomain->findorFail($id);
            if ($request->hasFile('ed_image')) {
                $image = $request->file('ed_image');
                $imageName = uniqid().'.'.$image->getClientOriginalExtension();
                $imagePath = $image->storeAs('expert_photos', $imageName, 'public');
            }
            else
            {
                $imagePath = $ed->expert_domain_image;
            }
            
            $ed->expert_domain_names = $request->ed_name;
            $ed->expert_domain_emails = $request->ed_email;
            $ed->expert_domain_phonenumbers = $request->ed_phonenum;
            $ed->expert_domain_affiliation = $request->ed_affiliation;
            $ed->expert_domain_research_title = $request->ed_research;
            $ed->expert_domain_designation = implode(',', (array) $request->ed_designation);
            $ed->expert_domain_image = $imagePath;

            $ed->save();
        }
        else
        {
            return Redirect::route('login');
        }
        return Redirect::route('view-expert.id', $id);
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

    // public function addpublication(string $id)
    // {
    //     return view('ManageExpertDomain/uploadExpertPublication', ["id" => $id]);
    // }

    // public function publication(Request $request ,string $id)
    // {
    //      $result = new PublicationController;
    //      $result->store($request);

    //     return Redirect::route('view-expert.id', $id);
    // }
}
