<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Structure;

class StructureController extends Controller
{
    public function index()
    {
        $structure = Structure::orderBy('jabatan')->get();

        return view('structure', compact('structure'));
    }
}
