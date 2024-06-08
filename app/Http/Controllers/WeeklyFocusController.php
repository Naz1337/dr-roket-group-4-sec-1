<?php

namespace App\Http\Controllers;

use App\Models\WeeklyFocus;
use Illuminate\Http\Request;

class WeeklyFocusController extends Controller
{
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
        return view('weekly_focus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WeeklyFocus $weeklyFocus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WeeklyFocus $weeklyFocus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WeeklyFocus $weeklyFocus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WeeklyFocus $weeklyFocus)
    {
        //
    }
}
