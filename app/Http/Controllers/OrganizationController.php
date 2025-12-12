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

        // withCount untuk mencegah N+1, menghitung jumlah activities per company
        // jika mau hitung "open events" saja, ganti closure di bawah sesuai kriteria
        $query->withCount(['activities as activities_count' => function($q) {
            // contoh: hitung activities yang belum berakhir (end_date >= today) atau tanpa end_date
            $today = now()->toDateString();
            $q->where(function($sub) use ($today) {
                $sub->whereNull('end_date')
                    ->orWhereDate('end_date', '>=', $today);
            });
        }]);

        $companies = $query->orderBy('name')->paginate(12)->withQueryString();

        return view('organizations.index', compact('companies','q'));
    }


    public function show(Company $company)
    {
        $activities = Activity::where('company_code', $company->company_code)
                              ->orderBy('start_date', 'desc')
                              ->paginate(12);

        return view('organizations.show', compact('company', 'activities'));
    }
}
