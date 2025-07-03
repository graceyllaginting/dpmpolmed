<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspiration;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;


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


        // 🖨️ Generate PDF
        $pdf = Pdf::loadView('pdf.kode-aspirasi', compact('kode'));
        $path = 'aspirasi/kode_' . $kode . '.pdf';

        if (!Storage::exists('aspirasi')) {
            Storage::makeDirectory('aspirasi');
        }

        Storage::put($path, $pdf->output());

        // 📨 Redirect dengan session
        return redirect()->route('aspirasi.index')->with('kode_aspirasi', $kode);

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

// ✨ Sudah sesuai
    public function show($kode)
    {
        // ⬅️ Pastikan eager load 'invitation' agar bisa langsung dipakai di blade
        $aspirasi = Aspiration::with('invitation')->where('kode_aspirasi', $kode)->firstOrFail();

        // ⬅️ Sesuaikan nama file blade jika kamu pakai `aspirations-detail.blade.php`
        return view('aspirations-detail', compact('aspirasi'));
    }
    
    public function download($kode)
    {
        $filePath = "aspirasi/kode_$kode.pdf";

        if (Storage::exists($filePath)) {
            return Storage::download($filePath, "Kode_Aspirasi_$kode.pdf");
        }

        return redirect()->route('aspirasi.index')->with('error', 'File tidak ditemukan.');
    }


}
