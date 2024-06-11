<?php

namespace App\Http\Controllers;

use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Date;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Platinum;
use App\Models\ExpertDomain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;


class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $id = Auth::user()->getPlatinum()->id;
    
            // Fetch publications and count for the authenticated user's platinum ID
            $publications = Publication::where('platinum_id', $id)->get();
            $totalPublications = $publications->count();
    
            // Fetch unique years from the user's publications
            $years = Publication::where('platinum_id', $id)
                ->selectRaw('YEAR(P_published_date) as year')
                ->distinct()
                ->orderBy('year', 'desc')
                ->pluck('year');
    
            return view('ManagePublication.myPublication', compact('publications', 'totalPublications', 'years'));
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
            $publication->expert_domain_id = NULL;
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

public function search(Request $request)
{
    if (Auth::check()) {
        $platinumId = Auth::user()->getPlatinum()->id;

        // Fetch unique years from the user's publications
        $years = Publication::where('platinum_id', $platinumId)
            ->selectRaw('YEAR(P_published_date) as year')
            ->distinct()
            ->pluck('year');

        // Query to filter publications by the authenticated user's platinum ID
        $query = Publication::where('platinum_id', $platinumId);

        if ($request->filled('search-query')) {
            $searchQuery = $request->input('search-query');
            $query->where(function ($q) use ($searchQuery) {
                $q->where('P_title', 'like', "%{$searchQuery}%")
                  ->orWhere('P_authors', 'like', "%{$searchQuery}%");
            });
        }

        $selectedYear = $request->input('search-year');
        if ($selectedYear && $selectedYear != 'any') {
             $query->whereYear('P_published_date', $selectedYear);
         }

        $publications = $query->get();
        $totalPublications = $publications->count();

        return view('ManagePublication.myPublication', compact('publications', 'totalPublications', 'years'));
    }
    return redirect()->route('login');
}

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

    $selectedYear = $request->input('search-year');
    if ($selectedYear && $selectedYear != 'any') {
        $query->whereYear('P_published_date', $selectedYear);
    }

    $publications = $query->get();
    $totalPublications = $publications->count();
    $years = Publication::selectRaw('YEAR(P_published_date) as year')->distinct()->orderBy('year', 'desc')->pluck('year');

    return view('ManagePublication.ListPublication', compact('publications', 'totalPublications', 'years'));
}


public function generateReport(Request $request)
{
    $years = Publication::selectRaw('YEAR(P_published_date) as year')->distinct()->orderBy('year', 'desc')->pluck('year');
    $universities = Platinum::select('plat_edu_institute')->distinct()->orderBy('plat_edu_institute', 'asc')->pluck('plat_edu_institute');
    $platinumNames = Platinum::select('plat_name')->distinct()->orderBy('plat_name', 'asc')->pluck('plat_name');

    if ($request->isMethod('get') || !$request->filled('filterType')) {
        return view('ManagePublication.PublicationReport', compact('years', 'universities', 'platinumNames'));
    }

    $filterType = $request->input('filterType');
    $filterValue = $request->input('filterValue');
    $selectedYear = $request->input('year');

    $query = Publication::query();

    if ($filterType == 'university' && $filterValue != 'all') {
        $query->whereHas('platinum', function ($query) use ($filterValue) {
            $query->where('plat_edu_institute', $filterValue);
        });
        } elseif ($filterType == 'platinumName' && $filterValue != 'all') {
            $query->whereHas('platinum', function ($query) use ($filterValue) {
                $query->where('plat_name', $filterValue);
            });
    }

    if ($selectedYear != 'any') {
        $query->whereYear('P_published_date', $selectedYear);
    }

    $publications = $query->get();

    if ($request->input('download')) {
        
        // Pass data to the view
        $data = [
            'publications' => $publications,
            'reportDate' => now()->format('Y-m-d'),
            'totalPublications' => $publications->count(),
            'filterType' => $filterType,
            'filterValue' => $filterValue,
            'selectedYear' => $selectedYear,
            'years' => $years,
            'universities' => $universities,
            'platinumNames' => $platinumNames,
        ];

        // Specify the path to your view file
        $viewPath = 'ManagePublication.PdfPublicationReport';

        // Render the view
        $html = View::make($viewPath, $data)->render();

        // Initialize Dompdf
        $dompdf = new Dompdf();

        // Load HTML content
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render PDF (stream or save)
        $dompdf->render();

        // Stream PDF to the user for download
        return $dompdf->stream('publication_report.pdf');
    }

    return view('ManagePublication.PublicationReport', [
        'publications' => $publications,
        'reportDate' => now()->format('Y-m-d'),
        'totalPublications' => $publications->count(),
        'filterType' => $filterType,
        'filterValue' => $filterValue,
        'selectedYear' => $selectedYear,
        'years' => $years,
        'universities' => $universities,
        'platinumNames' => $platinumNames,
    ]);
}



    
}