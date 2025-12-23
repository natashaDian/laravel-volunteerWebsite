<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityRegistration;
use App\Models\PointsTransaction;
use Illuminate\Support\Facades\Auth;

class ActivityRegistrationController extends Controller
{
    public function store(Request $request, Activity $activity)
    {
        $request->validate([
            'motivation' => 'nullable|string|max:500',
        ]);

        $alreadyRegistered = ActivityRegistration::where('user_id', Auth::id())
            ->where('activity_id', $activity->id)
            ->exists();

        if ($alreadyRegistered) {
            return back()->with('error', 'You have already registered for this activity.');
        }

        ActivityRegistration::create([
            'user_id'     => Auth::id(),
            'activity_id' => $activity->id,
            'motivation'  => $request->motivation,
            'status'      => 'pending',
        ]);

        return back()->with('success', 'Registration submitted successfully. Please wait for approval. You may be contacted by the organization.');
    }

    public function confirm(Request $request, Activity $activity)
    {
        $request->validate([
            'confirmation_code' => 'required|string',
        ]);

        $registration = ActivityRegistration::where('user_id', Auth::id())
            ->where('activity_id', $activity->id)
            ->where('status', 'approved')
            ->firstOrFail();

        if ($request->confirmation_code !== $registration->confirmation_code) {
            return back()->with('error', 'Invalid participation code.');
        }

        $registration->update([
            'status' => 'confirmed',
        ]);

        PointsTransaction::create([
            'user_id'     => Auth::id(),
            'points'      => 20,
            'source_type' => 'activity',
            'source_id'   => $activity->id,
            'description' => $activity->title,
        ]);

        return back()->with('success', 'Participation confirmed successfully. Points have been added to your account.');
    }

}
