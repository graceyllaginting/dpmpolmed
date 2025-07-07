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

        // Komisi statis untuk flipcard
        $komisi = [
            [
                'nama' => 'Pimpinan DPM',
                'deskripsi' => "Pimpinan DPM terdiri dari:\n- 1 (satu) orang Ketua\n- 2 (dua) orang Wakil Ketua\n\nWakil Ketua I menangani Bidang Internal.\nWakil Ketua II menangani Bidang Eksternal.",
                'ringkas' => 'Ketua dan Wakil Ketua'
            ],
            [
                'nama' => 'Komisi I',
                'deskripsi' => "1. Mengawasi Kinerja BEM\n2. Mengawasi Keuangan BEM\n3. Merancang Garis-garis Besar Kebijakan Organisasi (GBKO)\n4. Menjadi Penghubung antara DPM dan BEM",
                'ringkas' => 'Pengawasan BEM'
            ],
            [
                'nama' => 'Komisi II',
                'deskripsi' => "1. Menindaklanjuti usul amandemen Undang-Undang Dasar KEMA POLMED\n 2. Merumuskan draft rancangan peraturan perundang-undangan KEMA POLMED\n3. Mensosialisasikan segala hal yang berhubungan dengan perundang-undangan KEMA POLMED\n4. Membantu UKM dan HMPS dalam membuat AD/ART atau peraturan lainnya\n5.Memeriksa anggaran asar dan anggaran rumah tangga UKM dan HMPS\n6. Membuat program legislasi selama 1 (satu) tahun pengurusan\n7.Menindaklanjuti usul pembuatan peraturan perundang-undangan",
                'ringkas' => 'Perundang-Undangan'
            ],
            [
                'nama' => 'Komisi III',
                'deskripsi' => "1. Mengawasi AD (Anggaran Dasar)/ART (Anggran Rumah Tangga) UKM dan HMPS\n2. Mengawasi semua peraturan UKM dan HMPS\n3. Mengawasi Struktur Kepengurusan UKM dan HMPS\n4. Membantu UKM dan HMPS yang mengalami kesulitan dalam kinerjanya\n5. Membantu Suksesi Lembaga ditingkat UKM dan HMPS\n6. Membuat program legislasi selama 1 (satu) tahun pengurusan\n7. Mengaktifkan Kembali UKM dan HMPS yang vakum/ Pasif",
                'ringkas' => 'UKM & HMPS'
            ],
            [
                'nama' => 'Komisi IV',
                'deskripsi' => "1. Menampung, menanggapi dan menindaklanjuti aspirasi mahasiswa Politeknik Negeri Medan\n2. Mengadakan Audiensi dengan Pimpinan Politeknik Negeri Medan\n3. Membuat Surat Keputusan Kepengurusan DPM\n4. Membantu Pelegalan UKM dan HMPS\n5.Mengawasi pergerakan Organisasi Eksternal di Politeknik Negeri Medan",
            ],
            [
                'nama' => 'Komisi V',
                'deskripsi' => "1. Menjalin Hubungan yang baik dengan Lembaga Kemahasiswaan di Perguruan Tinggi Lain\n2. Mengadakan Silaturahmi berupa Studi Banding, Studi Ekskursi atau Kunjungan Persahabatan kepada Lembaga Kemahasiswaan di Perguruan Tinggi lain\n3. Mencari informasi mengenai kegatan legislatif dan/atau wilayah dalam forum-forum mahasiswa nasional",
                'ringkas' => 'Hubungan Keluar'
            ]
        ];

        return view('structure', compact('structure', 'allPeriode', 'periode', 'komisi'));
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
