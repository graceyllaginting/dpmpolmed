@extends('layouts.app')

@section('title', 'Detail Kegiatan')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp

<section class="container mx-auto py-12 px-4 bg-gradient-to-b from-white to-red-50 text-gray-800">

{{-- <div class="container mx-auto py-12 px-4"> --}}
    {{-- Judul --}}
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-red-800 mb-2 inline-block relative" data-aos="fade-down">{{ $doc->judul }}
        <span class="block h-1 bg-gradient-to-r from-orange-400 to-orange-600 mt-2 rounded-full"></span>
        </h2>
        <p class="text-gray-500 text-sm">
            Kategori: <span class="font-medium">{{ $doc->kategori->nama_kategori }}</span> |
            Tanggal: {{ \Carbon\Carbon::parse($doc->tanggal)->translatedFormat('d F Y') }}
        </p>
    </div>

    {{-- Konten --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start" data-aos="fade-up">
        {{-- File Preview --}}
        <div class="relative group">
            @if ($doc->file)
                @if (Str::endsWith($doc->file, ['jpg', 'jpeg', 'png', 'webp']))
                    <img src="{{ asset('storage/' . $doc->file) }}" alt="{{ $doc->judul }}"
                        class="rounded shadow-md w-full max-w-md mx-auto object-cover transition duration-300 transform group-hover:scale-105">
                @elseif (Str::endsWith($doc->file, ['pdf']))
                    <iframe src="{{ asset('storage/' . $doc->file) }}" class="w-full h-[600px] rounded-xl shadow" frameborder="0"></iframe>
                @else
                    <div class="bg-gray-100 p-6 rounded-xl shadow text-center max-w-md mx-auto">
                        <p class="text-sm text-gray-600">📄 File: {{ basename($doc->file) }}</p>
                        <a href="{{ asset('storage/' . $doc->file) }}" download
                            class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">
                            ⬇ Download File
                        </a>
                    </div>
                @endif
            @else
                <div class="bg-gray-200 w-full h-64 flex items-center justify-center rounded-xl">
                    <p class="text-gray-600 italic">Tidak ada file tersedia</p>
                </div>
            @endif
        </div>

        {{-- Detail --}}
        <div class="bg-white rounded-2xl shadow-md p-6 space-y-5 border border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-1">📌 Judul Kegiatan</h3>
                <p class="text-gray-700">{{ $doc->judul }}</p>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-1">📂 Kategori</h3>
                <p class="text-gray-700">{{ $doc->kategori->nama_kategori }}</p>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-1">📅 Tanggal Pelaksanaan</h3>
                <p class="text-gray-700">{{ \Carbon\Carbon::parse($doc->tanggal)->translatedFormat('d F Y') }}</p>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-1">📝 Deskripsi </h3>
                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $doc->deskripsi }}</p>
            </div>

            <div class="pt-4">
                <a href="{{ route('documentation.index') }}"
                    class="inline-block bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 text-white px-6 py-2 rounded-full shadow transition-all">
                    ← Kembali ke Dokumentasi
                </a>
            </div>
        </div>
    </div>
{{-- </div> --}}
</section>


{{-- AOS animation --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 1000 });
</script>
@endsection
