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

        $aspirasis = Aspiration::latest('tanggal_kirim')->paginate(10);


        // Statistik
        $totalAspirasi = Aspiration::count();
        $totalDitanggapi = Aspiration::whereNotNull('tanggapan')->count();
        $totalBelumDitanggapi = Aspiration::whereNull('tanggapan')->count();

        return view('aspirations', compact(
            'aspirasiPublik',
            'aspirasis',
            'totalAspirasi',
            'totalDitanggapi',
            'totalBelumDitanggapi'
        ));
    }

    // 🧾 Simpan aspirasi dari form
    public function store(Request $request)
    {
    $validated = $request->validate([
        'nama_pengirim' => 'required|string|max:255',
        'nim' => 'required|string|max:20',
        'prodi' => 'required|string|max:100',
        'email' => [
            'required',
            'email',
            'regex:/^[a-zA-Z0-9._%+-]+@students\.polmed\.ac\.id$/'
        ],
        'isi_aspirasi' => 'required|string',
    ], [
        'email.regex' => 'Email harus menggunakan @students.polmed.ac.id',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
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
            return redirect()->back()->with('not_found', 'Kode aspirasi tidak ditemukan. Periksa kembali kode yang kamu masukkan.');
        }

        return redirect()->route('aspirasi.show', ['kode' => $aspirasi->kode_aspirasi]);
    }

    public function show($kode)
    {
        $aspirasi = Aspiration::with('invitation')->where('kode_aspirasi', $kode)->firstOrFail();

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


    public function balas(Request $request, $kode)
    {
        $request->validate([
            'balasan_mahasiswa' => 'required|string|max:1000',
        ]);

        $aspirasi = Aspiration::where('kode_aspirasi', $kode)->firstOrFail();

        // Hanya boleh membalas jika sudah ada tanggapan dari DPM
        if (!$aspirasi->tanggapan) {
            return redirect()->back()->with('error', 'Tidak bisa membalas karena belum ada tanggapan dari DPM.');
        }

        $aspirasi->balasan_mahasiswa = $request->balasan_mahasiswa;
        $aspirasi->save();

        return redirect()->route('aspirasi.show', ['kode' => $kode])
            ->with('success', 'Balasan Anda berhasil dikirim!');
    }



}