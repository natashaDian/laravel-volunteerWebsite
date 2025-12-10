<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::paginate(8);

        return view('company.activities', compact('activities'));
    }
}
