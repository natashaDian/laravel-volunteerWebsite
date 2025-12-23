<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Activity;

class OrganizationController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $query = \App\Models\Company::query();

        if ($q) {
            $query->where('name', 'like', "%{$q}%")
                ->orWhere('company_code', 'like', "%{$q}%");
        }

        $today = now()->toDateString();

        $query->withCount([
            // ONGOING: sedang berlangsung
            'activities as ongoing_count' => function ($q) use ($today) {
                $q->whereDate('start_date', '<=', $today)
                ->whereDate('end_date', '>=', $today);
            },

            // UPCOMING: belum mulai
            'activities as upcoming_count' => function ($q) use ($today) {
                $q->whereDate('start_date', '>', $today);
            },

            // PAST: sudah lewat
            'activities as past_count' => function ($q) use ($today) {
                $q->whereDate('end_date', '<', $today);
            },
        ]);


        $companies = $query->orderBy('name')->paginate(12)->withQueryString();

        return view('organizations.index', compact('companies','q'));
    }


    public function show($id)
    {
        $company = Company::findOrFail($id);
        $today = now()->startOfDay();

        // ONGOING: sudah mulai
        $ongoingActivities = Activity::where('company_code', $company->company_code)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->orderBy('start_date')
            ->get();

        // UPCOMING: belum mulai
        $upcomingActivities = Activity::where('company_code', $company->company_code)
            ->whereDate('start_date', '>', $today)
            ->orderBy('start_date')
            ->get();

        // PAST: sudah lewat
        $pastActivities = Activity::where('company_code', $company->company_code)
            ->whereDate('end_date', '<', $today)
            ->orderByDesc('end_date')
            ->get();

        return view('organizations.show', compact(
            'company',
            'ongoingActivities',
            'upcomingActivities',
            'pastActivities'
        ));
    }

}
