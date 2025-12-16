<?php

namespace App\Http\Controllers;

use App\Models\PointsTransaction;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::where('is_active', true)->get();
        $user = Auth::user();

        return view('rewards.index', compact('rewards', 'user'));
    }

    public function redeem(Reward $reward)
    {
        $user = Auth::user();

        if ($user->total_points < $reward->required_points) {
            return back()->with('error', 'You do not have enough points to redeem this reward.');
        }

        PointsTransaction::create([
            'user_id'     => $user->id,
            'points'      => -$reward->required_points,
            'source_type' => 'redeem',
            'source_id'   => $reward->id,
            'description' => 'Redeemed reward: ' . $reward->name,
        ]);

        return back()->with('success', 'Reward redeemed successfully 🎉');
    }
}
