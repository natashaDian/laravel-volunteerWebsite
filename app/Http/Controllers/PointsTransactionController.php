<?php

namespace App\Http\Controllers;

use App\Models\PointsTransaction;
use Illuminate\Support\Facades\Auth;

class PointsTransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $transactions = $user->pointTransactions()
            ->orderByDesc('created_at')
            ->get();

        return view('points.history', compact('transactions'));
    }
}
