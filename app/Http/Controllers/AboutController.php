<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $info = [
            'title' => 'About Give2Grow',
            'mission' => 'Empowering communities through volunteering and donations.',
            'vision' => 'Build a world where everyone can give and grow together.',
        ];

        return view('about.index', compact('info'));
    }
}
