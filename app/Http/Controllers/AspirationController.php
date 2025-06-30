<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspiration;
use Illuminate\Support\Str;
use Carbon\Carbon;


class AspirationController extends Controller
{
    // 📨 Tampilkan halaman form + list + hasil pencarian
    public function index()
    {
        $aspirasiPublik = Aspiration::whereNotNull('tanggapan')
            ->where('status', '!=', 'pending')
            ->latest('tanggal_kirim')
            ->take(5)
            ->get();

        return view('aspirations', compact('aspirasiPublik'));
    }

    // 🧾 Simpan aspirasi dari form
    public function store(Request $request)
    {
            // dd($request->all());

        $validated = $request->validate([
            'nama_pengirim' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'prodi' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'isi_aspirasi' => 'required|string',
        ]);

        $kode = 'DPM-' . strtoupper(Str::random(6));

        Aspiration::create([
            'kode_aspirasi' => $kode,
            'nama_pengirim' => $validated['nama_pengirim'],
            'nim' => $validated['nim'],
            'prodi' => $validated['prodi'],
            'email' => $validated['email'],
            'isi_aspirasi' => $validated['isi_aspirasi'],
            'status' => 'pending',
            'tanggal_kirim' => Carbon::now()->toDateString(),
        ]);

        return redirect()->back()->with('kode_aspirasi', $kode);
    }

    // 🔍 Cek tanggapan berdasarkan kode
    public function cek(Request $request)
    {
        $request->validate([
            'kode' => 'required|string'
        ]);

        $aspirasi = Aspiration::where('kode_aspirasi', $request->kode)->first();

        if (!$aspirasi) {
            return redirect()->back()->withErrors(['kode' => 'Kode tidak ditemukan']);
        }

        // ✅ Redirect ke route aspiras.show pakai kode, bukan ID
        return redirect()->route('aspirasi.show', ['kode' => $aspirasi->kode_aspirasi]);
    }

   public function show($kode)
    {
        $aspirasi = Aspiration::with('invitation')->where('kode_aspirasi', $kode)->firstOrFail();
        return view('aspirations-detail', compact('aspirasi'));
    }





}
