@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="bg-white shadow-2xl rounded-2xl p-8 border border-gray-200" data-aos="fade-up">
        {{-- Judul --}}
        <h2 class="text-3xl font-extrabold text-center text-red-700 mb-8">📌 Detail Aspirasi Mahasiswa</h2>

        {{-- Informasi Pengirim --}}
        <div class="grid md:grid-cols-2 gap-4 text-gray-800 text-sm md:text-base mb-6">
            <p><span class="font-semibold text-gray-600">👤 Nama:</span> {{ $aspirasi->nama_pengirim }}</p>
            <p><span class="font-semibold text-gray-600">🆔 NIM:</span> {{ $aspirasi->nim }}</p>
            <p><span class="font-semibold text-gray-600">🏫 Prodi:</span> {{ $aspirasi->prodi }}</p>
            <p><span class="font-semibold text-gray-600">📧 Email:</span> {{ $aspirasi->email }}</p>
            <p><span class="font-semibold text-gray-600">🗓️ Tanggal Kirim:</span> {{ \Carbon\Carbon::parse($aspirasi->tanggal_kirim)->translatedFormat('d F Y') }}</p>
            <p>
                <span class="font-semibold text-gray-600">📍 Status:</span>
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

        {{-- Isi Aspirasi --}}
        <div class="mt-8">
            <h3 class="text-xl font-semibold text-blue-700 mb-2">📝 Isi Aspirasi</h3>
            <div class="bg-gray-100 p-5 rounded-xl text-gray-700 leading-relaxed shadow-sm">
                {{ $aspirasi->isi_aspirasi }}
            </div>
        </div>

        {{-- Tanggapan atau Undangan --}}
        <div class="mt-10">
            <h3 class="text-xl font-semibold text-green-700 mb-3">💬 Tanggapan DPM</h3>

            @if ($aspirasi->tanggapan)
                {{-- Tanggapan langsung --}}
                <div class="bg-green-50 border-l-4 border-green-400 p-5 rounded-lg text-gray-800 shadow-sm">
                    {{ $aspirasi->tanggapan }}
                </div>
            @elseif ($aspirasi->invitation)
                {{-- Undangan Pertemuan --}}
                <div class="bg-blue-50 border-l-4 border-blue-400 p-5 rounded-lg text-gray-800 shadow-sm">
                    <h4 class="text-lg font-bold text-blue-800 mb-2">📨 Undangan dari DPM</h4>
                    @php
                        $isi = $aspirasi->invitation->isi_undangan;
                        $lines = explode("\n", $isi);
                    @endphp

                    @foreach ($lines as $line)
                        <p class="mb-1">{{ $line }}</p>
                    @endforeach
                </div>
            @else
                <div class="text-gray-500 italic">Belum ada tanggapan dari DPM.</div>
            @endif
        </div>

        {{-- Tombol Kembali --}}
        <div class="mt-10 text-center">
            <a href="{{ route('aspirasi.index') }}"
               class="inline-block text-red-700 hover:text-white border border-red-600 hover:bg-red-600 transition px-5 py-2 rounded-lg shadow-md font-semibold">
                ← Kembali ke halaman aspirasi
            </a>
        </div>
    </div>
</div>

{{-- Optional AOS Scroll Animation --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true });
</script>
@endsection
