<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;

class CompanyActivityController extends Controller
{
    public function index()
    {
        $company = Auth::guard('company')->user();
        $activities = Activity::where('company_code', $company->company_code)
            ->latest()
            ->get();

        return view('company.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('company.activities.create');
    }

    public function store(Request $request)
    {
        $company = Auth::guard('company')->user();
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'quota' => 'nullable|integer',
        ]);

        $data['company_code'] = $company->company_code;
        Activity::create($data);

        return redirect()->route('company.activities.index')->with('success', 'Activity created.');
    }

    public function show(Activity $activity)
    {
        $company = Auth::guard('company')->user();
        abort_unless($activity->company_code === $company->company_code, 403);

        return view('company.activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        $company = Auth::guard('company')->user();
        abort_unless($activity->company_code === $company->company_code, 403);

        return view('company.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $company = Auth::guard('company')->user();
        abort_unless($activity->company_code === $company->company_code, 403);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'quota' => 'nullable|integer',
        ]);

        $activity->update($data);

        return redirect()->route('company.activities.index')->with('success', 'Activity updated.');
    }

    public function destroy(Activity $activity)
    {
        $company = Auth::guard('company')->user();
        abort_unless($activity->company_code === $company->company_code, 403);

        $activity->delete();

        return redirect()->route('company.activities.index')->with('success', 'Activity deleted.');
    }
}