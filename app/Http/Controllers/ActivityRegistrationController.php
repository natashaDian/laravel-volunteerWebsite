<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityRegistration;

class ActivityRegistrationController extends Controller
{
    public function store(Request $request, Activity $activity)
    {
        $user = $request->user();
        if (! $user) {
            return redirect()->route('login');
        }

        $exists = ActivityRegistration::where('activity_id', $activity->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'You are already registered for this activity.');
        }

        ActivityRegistration::create([
            'activity_id' => $activity->id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('activities.show', $activity)->with('success', 'Registration successful.');
    }
}