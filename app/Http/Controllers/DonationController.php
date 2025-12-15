<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $methods = [
            ['name' => 'Bank Transfer', 'detail' => 'BCA, BNI, Mandiri'],
            ['name' => 'E-Wallet', 'detail' => 'OVO, GoPay, DANA'],
            ['name' => 'Virtual Account', 'detail' => 'Automatic transfer'],
        ];

        return view('donations.index', compact('methods'));
    }

    public function method(Request $request)
    {
        if (!$request->method) {
            abort(404);
        }

        return view('donations.method', [
            'method' => $request->method
        ]);
    }

    public function checkout(Request $request)
    {
        if (!$request->method || !$request->amount) {
            abort(404);
        }

        return view('donations.checkout', [
            'amount' => $request->amount
        ]);
    }

    public function confirm(Request $request)
    {
        return view('donations.success', [
            'method' => $request->method,
            'amount' => $request->amount
        ]);
    }
}
