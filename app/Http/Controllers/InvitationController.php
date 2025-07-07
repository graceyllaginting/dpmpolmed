<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Aspiration;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    /**
     * Menyimpan undangan baru ke database.
     */


    /**
     * Menampilkan undangan berdasarkan kode aspirasi.
     */
    public function showByKode($kode)
    {
        $aspirasi = Aspiration::where('kode_aspirasi', $kode)->with('invitation')->firstOrFail();

        return view('invitation', compact('aspirasi'));
    }

    /**
     * Mahasiswa mengonfirmasi undangan (diterima/ditolak).
     */
    public function konfirmasi(Request $request, $id)
    {
        $request->validate([
            'status_konfirmasi' => 'required|in:diterima,ditolak',
        ]);

        $undangan = Invitation::findOrFail($id);
        $undangan->update([
            'status_konfirmasi' => $request->status_konfirmasi,
        ]);

        return back()->with('success', 'Status konfirmasi berhasil diperbarui.');
    }
}
