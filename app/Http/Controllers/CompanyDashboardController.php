<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Activity;

class CompanyDashboardController extends Controller
{
    public function index()
    {
        $activities = Activity::with('registrations')
            ->latest()
            ->get();

        return view('company.dashboard', compact('activities'));
    }
}
