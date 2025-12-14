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
            // 🟢 ONGOING: sedang berlangsung
            'activities as ongoing_count' => function ($q) use ($today) {
                $q->whereDate('start_date', '<=', $today)
                ->whereDate('end_date', '>=', $today);
            },

            // 🟡 UPCOMING: belum mulai
            'activities as upcoming_count' => function ($q) use ($today) {
                $q->whereDate('start_date', '>', $today);
            },
        ]);


        $companies = $query->orderBy('name')->paginate(12)->withQueryString();

        return view('organizations.index', compact('companies','q'));
    }


    public function show($id)
    {
        $company = Company::findOrFail($id);

        $activities = Activity::where('company_code', $company->company_code)
            ->orderBy('start_date', 'asc')
            ->get();

        $today = now()->startOfDay();

        // ONGOING: sudah mulai
        $ongoingCount = Activity::where('company_code', $company->company_code)
            ->whereDate('start_date', '<=', $today)
            ->count();

        // UPCOMING: belum mulai
        $upcomingCount = Activity::where('company_code', $company->company_code)
            ->whereDate('start_date', '>', $today)
            ->count();

        return view('organizations.show', compact(
            'company',
            'activities',
            'ongoingCount',
            'upcomingCount'
        ));
    }

}
