<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class CompanyActivityController extends Controller
{
    /**
     * EDIT PAGE
     */
    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        return view('company.activities.edit', compact('activity'));
    }

    /**
     * UPDATE ACTIVITY
     */
    public function update(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->start_date = $request->start_date;
        $activity->end_date = $request->end_date;

        // ===== UPDATE IMAGE (OPTIONAL) =====
        if ($request->hasFile('image')) {
            $filename = time().'.'.$request->image->extension();
            $request->image->move(public_path('img'), $filename);
            $activity->image_url = 'img/'.$filename;
        }

        $activity->save();

        return redirect()
            ->route('company.dashboard')
            ->with('success', 'Activity updated');
    }

    /**
     * DELETE ACTIVITY
     */
    public function destroy($id)
    {
        Activity::findOrFail($id)->delete();

        return back()->with('success', 'Activity deleted');
    }
}
