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
use Barryvdh\DomPDF\Facade\Pdf;

class ExpertDomainController extends Controller
{

    // Show my expert
    public function showMyExpert(Request $request)
    {
        //Function
        if(Auth::check())
        {
            if($request->isMethod('GET'))
            {
                $id = Auth::user()->getPlatinum()->id;
                $myexperts = ExpertDomain::where('platinum_id', $id)->get();
                // dd($myexperts);

                return view('ManageExpertDomain.myExpertDomain', compact('myexperts'));
            }
            else if($request->isMethod('POST'))
            {
                $id =  Auth::user()->getPlatinum()->id;
                $myexperts = ExpertDomain::query()
                                        ->where('platinum_id', $id)
                                        ->where('expert_domain_names', 'LIKE', '%'.$request->search.'%')
                                        ->orWhere('expert_domain_research_title', 'LIKE', '%'.$request->search.'%')
                                        ->get();

                return view('ManageExpertDomain.myExpertDomain', compact('myexperts'));
            }
        }
        else
        {
            return Redirect::route('login');
        }
    }

    // Show list of expert
    public function showListExpert(Request $request)
    {
        //Function
        if(Auth::check())
        {
            if($request->isMethod('GET'))
            {    
                $listexperts = ExpertDomain::all();

                return view('ManageExpertDomain.listExpertDomain', compact('listexperts'));
            }
            else if($request->isMethod('POST'))
            {
                $listexperts = ExpertDomain::query()
                                            ->where('expert_domain_names', 'LIKE', '%'.$request->search.'%')
                                            ->orWhere('expert_domain_research_title', 'LIKE', '%'.$request->search.'%')
                                            ->get();
                
                return view('ManageExpertDomain.listExpertDomain', compact('listexperts'));
            }
        }
        else
        {
            return Redirect::route('login');
        }
    }

    // Show generate report
    public function generateReport(Request $request)
    {
        if(Auth::check())
        {
            if($request->isMethod('GET'))
            {    
                $id = Auth::user()->getPlatinum()->id;
                $myexperts = ExpertDomain::where('platinum_id', $id)->get();

                return view('ManageExpertDomain.generateReportExpert', compact('myexperts'));
            }
            else if($request->isMethod('POST'))
            {
                $id = Auth::user()->getPlatinum()->id;
                $myexperts = ExpertDomain::query()
                                        ->where('platinum_id', $id)
                                        ->where('expert_domain_names', 'LIKE', '%'.$request->search.'%')
                                        ->orWhere('expert_domain_research_title', 'LIKE', '%'.$request->search.'%')
                                        ->get();

                
                return view('ManageExpertDomain.generateReportExpert', compact('myexperts'));
            }
        }
        else
        {
            return Redirect::route('login');
        }
    }

    // Download Pdf Report
    public function downloadReport(Request $request)
    {
        $id = Auth::user()->getPlatinum()->id;
        $myexperts = ExpertDomain::where('platinum_id', $id);

        $pdf = Pdf::loadView('ManageExpertDomain.generateReportExpert', compact('myexperts'));
        
        return $pdf->stream('report.pdf');
    }

    // Show Add form for Expert Profile
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

    
    // Create Expert Profile
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

    
    // Show expert profile details
    public function show(ExpertDomain $expertDomain, string $id)
    {
        if(Auth::check())
        {
            // dd($expertDomain);
            $expert = $expertDomain->findorFail($id);
            // dd($expert);
            $publications = $expert->publication()->get();

            // dd($publications);
        }
        else
        {
            return Redirect::route('login');
        }
        return view('ManageExpertDomain.viewExpertProfile', compact('expert'), compact('publications'));
    }

    
    // show Edit form for Expert Profile
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

    
    // Update Expert Data
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

    
    // Delete Expert Data
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


    // Show add Expert publication form
    public function addpublication(string $id)
    {
        if(Auth::check())
        {
            return view('ManageExpertDomain/uploadExpertPublication', ["id" => $id]);
        }
        else
        {
            return Redirect::route('login');
        }
    }


    // Create expert publication data
    public function storepublication(Request $request ,string $id)
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


    // Show edit Expert Publication Form
    public function editpublication(string $id)
    {
        if(Auth::check())
        {
            $publication = Publication::findOrFail($id);
        }
        else
        {
            Redirect::route('login');
        }
        return view('ManageExpertDomain.editExpertPublication', compact('publication'));
    }

    // Update Expert Publication Form
    public function updatePublication(Request $request, string $id)
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

            $publication = Publication::findOrFail($id);
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
        return Redirect::route('view-expert.id', $publication->expertDomain->id);
    }

    // Delete Expert Publication data
    public function deletepublication(string $id)
    {
        if(Auth::check())
        {
            $publication = Publication::findorFail($id);
            $publication->delete();
        }
        else
        {
            return Redirect::route('login');
        }
        return Redirect::route('view-expert');
    }
}
