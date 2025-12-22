<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        // ===============================
        // BASE QUERY
        // ===============================
        $query = Activity::query();

        // ===============================
        // KEYWORD FILTER (title + description ONLY)
        // ===============================
        if ($request->filled('q')) {
            $keyword = $request->q;

            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        // ===============================
        // CATEGORY FILTER
        // ===============================
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // ===============================
        // ORGANIZATION FILTER (company_code)
        // ===============================
        if ($request->filled('company')) {
            $query->where('company_code', $request->company);
        }

        // ===============================
        // START AFTER FILTER
        // ===============================
        if ($request->filled('start_date')) {
            $query->whereDate('start_date', '>=', $request->start_date);
        }

        // ===============================
        // ORDERING
        // ===============================
        $query->orderBy('start_date', 'asc');

        // ===============================
        // SPLIT STATUS
        // ===============================
        $today = Carbon::today();

        $ongoing = (clone $query)
            ->whereDate('start_date', '<=', $today)
            ->where(function ($q) use ($today) {
                $q->whereNull('end_date')
                  ->orWhereDate('end_date', '>=', $today);
            })
            ->get();

        $upcoming = (clone $query)
            ->whereDate('start_date', '>', $today)
            ->get();

        $ended = (clone $query)
            ->whereNotNull('end_date')
            ->whereDate('end_date', '<', $today)
            ->get();

        // ===============================
        // COMPANY LIST (company_code => name)
        // ===============================
        $companies = Company::pluck('name', 'company_code')->toArray();

        return view('activities.index', compact(
            'ongoing',
            'upcoming',
            'ended',
            'companies'
        ));
    }

    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }
}
