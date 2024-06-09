<?php

namespace App\Http\Controllers;

use App\Models\FocusItem;
use App\Models\WeeklyFocus;
use Illuminate\Http\Request;

class FocusItemController extends Controller
{
    public function edit(WeeklyFocus $weeklyFocus, FocusItem $focusItem)
    {
        return view('focus_item.edit', ['weeklyFocus' => $weeklyFocus, 'focusItem' => $focusItem]);
    }

    public function update(Request $request, FocusItem $focusItem, WeeklyFocus $weeklyFocus, )
    {
        $validated = $request->validate([
            'task' => 'required|string|max:255'
        ]);

        $focusItem->update($validated);
        return to_route('weekly-focus.edit', ['weekly_focu' => $weeklyFocus]);
    }

    public function create(WeeklyFocus $weeklyFocus)
    {
        return view('focus_item.create', compact('weeklyFocus'));
    }

    public function store(Request $request, WeeklyFocus $weeklyFocus)
    {
        $validated = $request->validate([
            'task' => 'required|string|max:255',
            'block_type' => 'required|string|max:255'
        ]);

        $weeklyFocus->focus_items()->create($validated);
        return to_route('weekly-focus.edit', ['weekly_focu' => $weeklyFocus]);
    }

    public function destroy(FocusItem $focusItem)
    {
        $weeklyFocus = $focusItem->weekly_focus;
        $focusItem->delete();
        return to_route('weekly-focus.edit', ['weekly_focu' => $weeklyFocus]);
    }
}
