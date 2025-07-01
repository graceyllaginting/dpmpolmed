@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-red-700 text-center">Undangan Pertemuan</h2>

    @if($aspirasi->invitation)
        <div class="space-y-3">
            <p><strong>Nama Pengirim:</strong> {{ $aspirasi->nama_pengirim }}</p>
            <p><strong>Kode Aspirasi:</strong> {{ $aspirasi->kode_aspirasi }}</p>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($aspirasi->invitation->tanggal)->format('d M Y') }}</p>
            <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($aspirasi->invitation->waktu)->format('H:i') }} WIB</p>
            <p><strong>Tempat:</strong> {{ $aspirasi->invitation->tempat }}</p>
            <p><strong>Isi Undangan:</strong> {{ $aspirasi->invitation->isi_undangan }}</p>
        </div>

        @if($aspirasi->invitation->status_konfirmasi === 'pending')
            <div class="mt-6 flex flex-col sm:flex-row gap-4">
                {{-- Tombol Terima --}}
                <form method="POST" action="{{ route('invitations.konfirmasi', $aspirasi->invitation->id_undangan) }}">
                    @csrf
                    <input type="hidden" name="status_konfirmasi" value="diterima">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                        Terima Undangan
                    </button>
                </form>

                {{-- Tombol Tolak --}}
                <form method="POST" action="{{ route('invitations.konfirmasi', $aspirasi->invitation->id_undangan) }}">
                    @csrf
                    <input type="hidden" name="status_konfirmasi" value="ditolak">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded">
                        Tolak Undangan
                    </button>
                </form>
            </div>
        @else
            <p class="mt-6 text-green-700 font-medium">
                Anda telah <strong>{{ $aspirasi->invitation->status_konfirmasi }}</strong> undangan ini.
            </p>
        @endif
    @else
        <p class="text-gray-600">Tidak ada undangan yang terkait dengan kode aspirasi ini.</p>
    @endif
</div>
@endsection
