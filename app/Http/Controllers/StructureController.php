<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Structure;

class StructureController extends Controller
{

    public function index(Request $request)
    {
        // Ambil semua periode unik
        $allPeriode = Structure::select('periode')->distinct()->orderBy('periode', 'desc')->pluck('periode');

        // Ambil periode dari request atau default ke terbaru
        $periode = $request->input('periode', $allPeriode->first());

        // Ambil data struktur sesuai periode
        $structure = Structure::where('periode', $periode)->get();

        return view('structure', compact('structure', 'allPeriode', 'periode'));
    }

    public function showByPeriode($periode)
    {
        $structure = Structure::where('periode', $periode)->get();
        $periodes = Structure::select('periode')->distinct()->orderByDesc('periode')->pluck('periode');

        return view('structure', compact('structure', 'periodes'));
    }


    public function showByBagian($bagian)
    {
        $anggota = Structure::where('bagian', $bagian)->orderBy('jabatan')->get();

        return view('structure-bagian', [
            'bagian' => $bagian,
            'anggota' => $anggota,
        ]);
    }



    
        

}

