<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Company;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    /**
     * Display a listing of activities with optional filters.
     */
    public function index(Request $request)
    {
        $today = now()->startOfDay();

        // map company_code => name
        $companies = Company::pluck('name', 'company_code')->toArray();

        // ================= BASE FILTER =================
        $baseQuery = Activity::query();

        if ($q = $request->query('q')) {
            $baseQuery->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%")
                    ->orWhere('organizer', 'like', "%$q%");
            });
        }

        if ($cat = $request->query('category')) {
            $baseQuery->where('category', $cat);
        }

        if ($loc = $request->query('location')) {
            $baseQuery->where('location', 'like', "%$loc%");
        }

        if ($comp = $request->query('company')) {
            $baseQuery->where('company_code', $comp);
        }

        if ($start = $request->query('start_date')) {
            $baseQuery->whereDate('start_date', '>=', $start);
        }

        if ($end = $request->query('end_date')) {
            $baseQuery->whereDate('end_date', '<=', $end);
        }

        // ================= STATUS SPLIT =================
        $ongoing = (clone $baseQuery)
            ->whereDate('start_date', '<=', $today)
            ->where(function ($q) use ($today) {
                $q->whereNull('end_date')
                ->orWhereDate('end_date', '>=', $today);
            })
            ->orderBy('start_date')
            ->get();

        $upcoming = (clone $baseQuery)
            ->whereDate('start_date', '>', $today)
            ->orderBy('start_date')
            ->get();

        $ended = (clone $baseQuery)
            ->whereDate('end_date', '<', $today)
            ->orderByDesc('end_date')
            ->get();

        return view('activities.index', compact(
            'ongoing',
            'upcoming',
            'ended',
            'companies'
        ));
    }


    /**
     * Display the specified activity.
     */
    public function show(Activity $activity)
    {
        // ambil nama perusahaan berdasarkan company_code
        $companyName = null;
        if ($activity->company_code) {
            $company = Company::where('company_code', $activity->company_code)->first();
            if ($company) {
                $companyName = $company->name;
            }
        }

        return view('activities.show', compact('activity', 'companyName'));
    }
}
