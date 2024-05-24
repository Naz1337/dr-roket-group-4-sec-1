<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExpertDomain;
use App\Http\Requests\StoreExpertDomainRequest;
use App\Http\Requests\UpdateExpertDomainRequest;
use App\Models\Platinum;
use Illuminate\Support\Facades\Auth;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpertDomainRequest $request)
    {
        //
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
