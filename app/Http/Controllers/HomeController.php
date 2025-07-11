<?php

namespace App\Http\Controllers;

use App\Models\Documentation;
use App\Models\Agenda;
use App\Models\Visitor;
use Illuminate\Support\Facades\Request;



class HomeController extends Controller
{
    public function index()
    {
        $latestDocs = Documentation::latest('tanggal')->take(3)->get();

        return view('home', compact('latestDocs'));
    }



 

public function agenda()
{
    $agendas = Agenda::orderBy('tanggal', 'asc')->get();

    return view('home', compact('agendas'));
}

public function pengunjung()
{
    Visitor::create([
        'ip_address' => Request::ip(),
        'user_agent' => Request::userAgent(),
        'visited_at' => now(),
    ]);

    return view('home');
}
}


