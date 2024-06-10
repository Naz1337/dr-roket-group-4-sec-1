<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExpertDomain;
use App\Http\Requests\StoreExpertDomainRequest;
use App\Http\Requests\UpdateExpertDomainRequest;
use App\Models\Publication;
use Illuminate\Http\Request;
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
        return view('ManageExpertDomain.listExpertDomain', compact('listexperts'));
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
        return view('ManageExpertDomain.generateReportExpert', compact('myexperts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::check())
        {
            return view('ManageExpertDomain.addExpertProfile');
        }
        else
        {
            return Redirect::route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpertDomainRequest $request)
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

            // $imageData = null;

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
        }
        else
        { 
            return Redirect::route('login');
        }

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
        return view('ManageExpertDomain.viewExpertProfile', compact('expert'), compact('publications'));
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
        return view('ManageExpertDomain.editExpertProfile', compact('expert'));
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
        if(Auth::check())
        {
            $ed = $expertDomain->findorFail($id);
            $ed->delete();
        }
        else
        {
            return Redirect::route('login');
        }
        return Redirect::route('my-expert');
    }

    public function addpublication(string $id)
    {
        return view('ManageExpertDomain/uploadExpertPublication', ["id" => $id]);
    }

    public function publication(Request $request ,string $id)
    {
        if(Auth::check())
        {
            $request->validate([
                'P_authors' => 'required|string',
                'P_title' => 'required|string',
                'P_published_date' => 'required|date',
                'P_type' => 'required|string', // Ensure this matches your input type
                'P_volume' => 'required|integer',
                'P_issues' => 'required|integer',
                'P_pages' => 'required|integer',
                'P_publisher' => 'required|string',
                'P_description' => 'required|string',
                'P_path' => 'required|string',
            ]);

            $publication = new Publication;
            $publication->expert_domain_id = $id;
            $publication->platinum_id = NULL;
            $publication->P_authors = $request['P_authors'];
            $publication->P_title = $request['P_title'];
            $publication->P_published_date = $request['P_published_date'];
            $publication->P_type = $request['P_type'];
            $publication->P_volume = $request['P_volume'];
            $publication->P_issues = $request['P_issues'];
            $publication->P_pages = $request['P_pages'];
            $publication->P_publisher = $request['P_publisher'];
            $publication->P_description = $request['P_description'];
            $publication->P_path = $request['P_path'];
            $publication->save();
        }
        else
        {
            return Redirect::route('login');
        }
        return Redirect::route('view-expert.id', $id);
    }
}
