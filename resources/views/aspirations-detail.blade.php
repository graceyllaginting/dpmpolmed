@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="bg-white shadow-lg rounded-lg p-6 border">
        <h2 class="text-2xl font-bold text-center text-red-700 mb-6">Detail Aspirasi Mahasiswa</h2>

        <div class="space-y-4 text-gray-700">
            <p><span class="font-semibold">Nama:</span> {{ $aspirasi->nama_pengirim }}</p>
            <p><span class="font-semibold">NIM:</span> {{ $aspirasi->nim }}</p>
            <p><span class="font-semibold">Prodi:</span> {{ $aspirasi->prodi }}</p>
            <p><span class="font-semibold">Email:</span> {{ $aspirasi->email }}</p>
            <p><span class="font-semibold">Tanggal Kirim:</span> {{ \Carbon\Carbon::parse($aspirasi->tanggal_kirim)->translatedFormat('d F Y') }}</p>
            <p>
                <span class="font-semibold">Status:</span>
                @switch($aspirasi->status)
                    @case('pending')
                        <span class="text-gray-500 font-semibold">Belum Ditanggapi</span>
                        @break
                    @case('ditanggapi')
                        <span class="text-yellow-600 font-semibold">Sudah Ditanggapi</span>
                        @break
                    @case('selesai')
                        <span class="text-green-600 font-semibold">Selesai</span>
                        @break
                    @default
                        <span class="text-red-600 font-semibold">Tidak Diketahui</span>
                @endswitch
            </p>
        </div>

        {{-- Isi aspirasi --}}
        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-2">Isi Aspirasi</h3>
            <div class="bg-gray-100 p-4 rounded text-gray-800">
                {{ $aspirasi->isi_aspirasi }}
            </div>
        </div>

        {{-- Tanggapan DPM --}}
        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-2 text-green-700">Tanggapan DPM</h3>
            @if ($aspirasi->tanggapan)
                <div class="bg-green-50 border border-green-300 p-4 rounded text-gray-800">
                    {{ $aspirasi->tanggapan }}
                </div>
            @elseif ($aspirasi->invitation)
                <div class="bg-green-50 border border-green-300 p-4 rounded text-gray-800 italic">
                    {{ $aspirasi->invitation->isi_undangan }}
                </div>
            @else
                <div class="text-gray-500 italic">Belum ada tanggapan dari DPM.</div>
            @endif
        </div>

        {{-- Undangan jika ada --}}
        @if ($aspirasi->invitation)
            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-2 text-blue-700">Undangan dari DPM</h3>
                <div class="bg-blue-50 border border-blue-300 p-4 rounded text-gray-800 space-y-2">
                    <p><strong>Isi Undangan:</strong> {{ $aspirasi->invitation->isi_undangan }}</p>
                    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($aspirasi->invitation->tanggal)->translatedFormat('d F Y') }}</p>
                    <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($aspirasi->invitation->waktu)->format('H:i') }}</p>
                    <p><strong>Tempat:</strong> {{ $aspirasi->invitation->tempat }}</p>
                    <p><strong>Status Konfirmasi:</strong> 
                        @switch($aspirasi->invitation->status_konfirmasi)
                            @case('pending')
                                <span class="text-yellow-600 font-medium">Belum Dikonfirmasi</span>
                                @break
                            @case('diterima')
                                <span class="text-green-600 font-medium">Diterima</span>
                                @break
                            @case('ditolak')
                                <span class="text-red-600 font-medium">Ditolak</span>
                                @break
                            @default
                                <span class="text-gray-500 italic">Status tidak tersedia</span>
                        @endswitch
                    </p>
                </div>
            </div>
        @endif

        <div class="mt-8 text-center">
            <a href="{{ route('aspirasi.index') }}" class="text-red-600 hover:underline">← Kembali ke halaman aspirasi</a>
        </div>
    </div>
</div>
@endsection
