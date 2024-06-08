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
        if (Auth::check()) {
            $id = Auth::user()->getPlatinum()->id;
            $publications = Publication::where('platinum_id', $id)->get();
            $totalPublications = $publications->count();
            return view('ManagePublication.myPublication', compact('publications','totalPublications'));
        }
        return Redirect::route('login');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ManagePublication/AddPublication');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentUser = Auth::user();
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
            $publication->platinum_id = $currentUser->getPlatinum()->id;
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

            return redirect()->route('mypublication')->with('success', 'Publication created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication, string $id)
    {
        if(Auth::check())
        {
            $publication = Publication::findOrFail($id); 
            $referrer = request()->query('referrer', 'mypublication'); // Default to 'mypublication' if no referrer is provided
        }
        else
        {
            return Redirect::route('login');
        }
        return view('ManagePublication.ViewPublication', compact('publication', 'referrer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $publication = Publication::findOrFail($id);
        $expertDomains = ExpertDomain::all();
        $platinums = Platinum::all();
        return view('ManagePublication.EditPublication', compact('publication'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
    {
        $request->validate([
            'P_authors' => 'required|string',
            'P_title' => 'required|string',
            'P_published_date' => 'required|date',
            'P_type' => 'required|string',
            'P_volume' => 'required|integer',
            'P_issues' => 'required|integer',
            'P_pages' => 'required|integer',
            'P_publisher' => 'required|string',
            'P_description' => 'required|string',
            'P_path' => 'required|string',
        ]);

        $publication = Publication::findOrFail($id);

        $publication->update($request->all());

        return Redirect::route('mypublication')->with('success', 'Publication updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Publication $publication, string $id)
    {
        $publication = Publication::findOrFail($id);

    // Check if the authenticated user owns the publication
    if (Auth::user()->getPlatinum()->id === $publication->platinum_id) {
        $publication->delete();
        return Redirect::route('mypublication')->with('success', 'Publication deleted successfully.');
    }

    return Redirect::route('mypublication')->with('error', 'You are not authorized to delete this publication.');
}

// public function search(Request $request)
// {
//     if (Auth::check()) {
//         $id = Auth::user()->getPlatinum()->id;
//         $query = Publication::where('platinum_id', $id);

//         if ($request->filled('search-query')) {
//             $searchQuery = $request->input('search-query');
//             $query->where(function ($q) use ($searchQuery) {
//                 $q->where('P_title', 'like', "%{$searchQuery}%")
//                   ->orWhere('P_authors', 'like', "%{$searchQuery}%");
//             });
//         }

//         if ($request->filled('search-year')) {
//             $searchYear = $request->input('search-year');
//             $query->whereYear('P_published_date', $searchYear);
//         }

//         $publications = $query->get();
//         $totalPublications = $publications->count();

//         return view('ManagePublication.ListPublication', compact('publications', 'totalPublications'));
//     }
//     return Redirect::route('login');
// }

public function searchOtherPublications(Request $request)
{
    $query = Publication::query();

            if ($request->filled('search-query')) {
            $searchQuery = $request->input('search-query');
            $query->where(function ($q) use ($searchQuery) {
                $q->where('P_title', 'like', "%{$searchQuery}%")
                  ->orWhere('P_authors', 'like', "%{$searchQuery}%");
            });
        }

        if ($request->filled('search-year')) {
            $searchYear = $request->input('search-year');
            $query->whereYear('P_published_date', $searchYear);
        }

        $publications = $query->get();
        $totalPublications = $publications->count();

    return view('ManagePublication.ListPublication', compact('publications', 'totalPublications'));
}


public function generateReport()
{
    // Fetch publications from the database
    $publications = Publication::all();

    // Generate report using a package like Maatwebsite/Excel
    $report = Excel::create('publications_report', function($excel) use ($publications) {
        $excel->sheet('Publications', function($sheet) use ($publications) {
            $sheet->fromArray($publications);
        });
    })->store('xlsx', storage_path('reports'));

    // Return a download link to the generated report
    return Response::download($report);
}
    
}
