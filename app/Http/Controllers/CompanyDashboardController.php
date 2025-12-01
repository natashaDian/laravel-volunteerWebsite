<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class CompanyDashboardController extends Controller
{
    public function index()
    {
        // Ambil event yang dimiliki company yang login
        $events = Event::where('company_id', auth('company')->id())->get();

        return view('company.dashboard', compact('events'));
    }
}
