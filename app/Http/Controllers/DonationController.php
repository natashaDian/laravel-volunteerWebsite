<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Show donation options / info.
     */
    public function index()
    {
        // you can later add payment integration or donation methods here
        $methods = [
            ['name' => 'Bank Transfer', 'detail' => 'Bank ABC - 1234567890 (Give2Grow)'],
            ['name' => 'GoPay / Ovo', 'detail' => 'Scan QR on request'],
            ['name' => 'Direct Donation', 'detail' => 'Contact events organizer for details'],
        ];

        return view('donations.index', compact('methods'));
    }
}
