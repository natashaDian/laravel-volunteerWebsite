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
        // ambil map company_code => name
        $companies = Company::pluck('name', 'company_code')->toArray();

        // base query
        $query = Activity::query();

        // keyword search (title, description, organizer)
        if ($q = $request->query('q')) {
            $query->where(function($sub) use ($q) {
                $sub->where('title', 'like', '%'.$q.'%')
                    ->orWhere('description', 'like', '%'.$q.'%')
                    ->orWhere('organizer', 'like', '%'.$q.'%');
            });
        }

        // category exact match
        if ($cat = $request->query('category')) {
            $query->where('category', $cat);
        }

        // location contains
        if ($loc = $request->query('location')) {
            $query->where('location', 'like', '%'.$loc.'%');
        }

        // company filter: accept company_code or company name
        if ($comp = $request->query('company')) {
            $query->where(function($sub) use ($comp, $companies) {
                // match company_code directly
                $sub->where('company_code', $comp);

                // if the provided value matches a company name (case-insensitive),
                // also allow the corresponding company_code
                foreach ($companies as $code => $name) {
                    if (Str::lower($name) === Str::lower($comp)) {
                        $sub->orWhere('company_code', $code);
                    }
                }
            });
        }

        // date range
        if ($start = $request->query('start_date')) {
            $query->whereDate('start_date', '>=', $start);
        }
        if ($end = $request->query('end_date')) {
            $query->whereDate('end_date', '<=', $end);
        }

        // optional: sorting
        if ($request->query('sort') === 'newest') {
            $query->latest('start_date');
        } else {
            $query->latest('start_date');
        }

        // paginate and keep query string for pagination links
        $activities = $query->paginate(12)->withQueryString();

        // categories list for filter dropdown
        $categories = Activity::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->values()
            ->toArray();

        return view('activities.index', compact('activities', 'companies', 'categories'));
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
