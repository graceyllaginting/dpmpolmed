<?php

namespace App\Http\Controllers;

use App\Models\Documentation;

class HomeController extends Controller
{
    public function index()
    {
        $latestDocs = Documentation::latest('tanggal')->take(3)->get();

        return view('home', compact('latestDocs'));
    }
}

