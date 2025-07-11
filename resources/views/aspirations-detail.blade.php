@extends('layouts.app')

@section('content')
<section class=" bg-gradient-to-b from-white to-red-50">
<div class="max-w-4xl mx-auto px-4 py-12 ">
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
                    @case('pending') <span class="text-gray-500 font-semibold">Belum Ditanggapi</span> @break
                    @case('ditanggapi') <span class="text-yellow-600 font-semibold">Sudah Ditanggapi</span> @break
                    @case('selesai') <span class="text-green-600 font-semibold">Selesai</span> @break
                    @default <span class="text-red-600 font-semibold">Tidak Diketahui</span>
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

        {{-- Tanggapan dari DPM --}}
        <div class="mt-10">
            <h3 class="text-xl font-semibold text-green-700 mb-3">💬 Tanggapan DPM</h3>
            @if ($aspirasi->tanggapan)
                <div class="bg-green-50 border-l-4 border-green-400 p-5 rounded-lg text-gray-800 shadow-sm">
                    {{ $aspirasi->tanggapan }}
                </div>
            @elseif ($aspirasi->invitation)
                <div class="bg-blue-50 border-l-4 border-blue-400 p-5 rounded-lg text-gray-800 shadow-sm">
                    <h4 class="text-lg font-bold text-blue-800 mb-2">📨 Undangan dari DPM</h4>
                    @php $lines = explode("\n", $aspirasi->invitation->isi_undangan); @endphp
                    @foreach ($lines as $line)
                        <p class="mb-1">{{ $line }}</p>
                    @endforeach
                </div>
            @else
                <div class="text-gray-500 italic">Belum ada tanggapan dari DPM.</div>
            @endif
        </div>

        {{-- Status Undangan & Konfirmasi --}}
        @if ($aspirasi->invitation)
            <div class="mt-6">
                <h3 class="text-xl font-semibold text-blue-600 mb-2">📅 Konfirmasi Undangan</h3>
                @if ($aspirasi->invitation->status_konfirmasi === 'pending')
                    <p class="text-yellow-700">Anda belum mengkonfirmasi undangan.</p>
                    <a href="{{ route('invitations.show', $aspirasi->kode_aspirasi) }}"
                       class="inline-block mt-2 text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg shadow font-semibold">
                        Konfirmasi Sekarang
                    </a>
                @else
                    <p class="text-green-700">
                        Anda telah <strong class="capitalize">{{ $aspirasi->invitation->status_konfirmasi }}</strong> undangan ini.
                    </p>
                @endif
            </div>
        @endif

        {{-- Balasan Mahasiswa --}}
        @if (($aspirasi->tanggapan || $aspirasi->invitation) && !$aspirasi->balasan_mahasiswa)
            <div class="mt-10">
                <h3 class="text-xl font-semibold text-purple-700 mb-3">✉️ Balasan Mahasiswa</h3>
                <form action="{{ route('aspirasi.balas', $aspirasi->kode_aspirasi) }}" method="POST">
                    @csrf
                    <textarea name="balasan_mahasiswa" rows="4"
                        class="w-full px-4 py-3 border rounded-lg resize-none focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Tanggapi jawaban dari DPM..." required></textarea>
                    <div class="text-right mt-3">
                        <button type="submit"
                            class="bg-gradient-to-r from-purple-600 to-purple-700 hover:to-purple-800 text-white px-6 py-2 rounded-lg shadow">
                            Kirim Balasan
                        </button>
                    </div>
                </form>
            </div>
        @elseif($aspirasi->balasan_mahasiswa)
            <div class="mt-10">
                <h3 class="text-xl font-semibold text-purple-700 mb-3">📬 Balasan Anda</h3>
                <div class="bg-purple-50 border-l-4 border-purple-400 p-5 rounded-lg text-gray-800 shadow-sm whitespace-pre-line">
                    {{ $aspirasi->balasan_mahasiswa }}
                </div>
            </div>
        @endif

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-400 text-green-800 px-4 py-3 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-400 text-red-800 px-4 py-3 rounded-lg shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tombol Kembali --}}
        <div class="mt-10 text-center">
            <a href="{{ route('aspirasi.index') }}"
               class="inline-block text-red-700 hover:text-white border border-red-600 hover:bg-red-600 transition px-5 py-2 rounded-lg shadow-md font-semibold">
                ← Kembali ke halaman aspirasi
            </a>
        </div>
    </div>
</div>
</section>
{{-- AOS Animation --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script> AOS.init({ once: true }); </script>
@endsection
