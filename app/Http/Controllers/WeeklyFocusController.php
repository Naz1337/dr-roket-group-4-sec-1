<?php

namespace App\Http\Controllers;

use App\Enums\BlockType;
use App\Models\WeeklyFocus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeeklyFocusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('weekly_focus.index', [
            'weeklyFocuses' => Auth::user()->weekly_focuses->sortByDesc('created_at')
        ]);
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
        $rules = [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'focus_item.*' => 'required|string|max:255',
            'admin_item.*' => 'required|string|max:255',
            'social_item.*' => 'required|string|max:255',
            'recovery_item.*' => 'required|string|max:255'
        ];

        $validated = $request->validate($rules);

        $weekly_focus = Auth::user()->weekly_focuses()->create([
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date']
        ]);

        foreach ($validated['focus_item'] as $item) {
            $weekly_focus->focus_items()->create([
                'task' => $item,
                'block_type' => BlockType::FOCUS
            ]);
        }

        foreach ($validated['admin_item'] as $item) {
            $weekly_focus->focus_items()->create([
                'task' => $item,
                'block_type' => BlockType::ADMIN
            ]);
        }

        foreach ($validated['social_item'] as $item) {
            $weekly_focus->focus_items()->create([
                'task' => $item,
                'block_type' => BlockType::SOCIAL
            ]);
        }

        foreach ($validated['recovery_item'] as $item) {
            $weekly_focus->focus_items()->create([
                'task' => $item,
                'block_type' => BlockType::RECOVERY
            ]);
        }

        return to_route('weekly-focus.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(WeeklyFocus $weeklyFocu)
    {
        return view('weekly_focus.show', [
            'weeklyFocus' => $weeklyFocu
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WeeklyFocus $weeklyFocu)
    {
        return view('weekly_focus.edit', [
            'weeklyFocus' => $weeklyFocu
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WeeklyFocus $weeklyFocus)
    {
        $rules = [
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WeeklyFocus $weeklyFocu)
    {
        // Retrieve the model instance you want to delete
        $weeklyFocus = $weeklyFocu;

        // Check if the model instance exists
        if ($weeklyFocus) {
            // Delete the related FocusItem instances
            foreach ($weeklyFocus->focus_items as $focusItem) {
                $focusItem->delete();
            }

            // Delete the WeeklyFocus instance
            $weeklyFocus->delete();
        }

        return to_route('weekly-focus.index');
    }
}
