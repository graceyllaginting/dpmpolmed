@extends('layouts.app')

@section('title', 'Struktur Bagian')

@section('content')
@php
    $icons = [
        'pimpinan' => '🧑‍💼',
        'komisi 1' => '🕵️‍♂️',
        'komisi 2' => '📜',
        'komisi 3' => '🧩',
        'komisi 4' => '🗣️',
        'komisi 5' => '🌍',
    ];

    $icon = $icons[strtolower($bagian)] ?? '📌';
@endphp

<div class="max-w-7xl mx-auto px-6 py-12">

    {{-- Header --}}
    <div class="text-center mb-10">
        <h1 class="text-4xl md:text-5xl font-extrabold text-red-700 tracking-tight mb-3 relative inline-block">
            <span class="text-5xl md:text-6xl mr-2">{{ $icon }}</span>
            {{ strtoupper($bagian) }}
            <span class="block w-1/2 mx-auto h-1 bg-orange-500 mt-2 rounded-full"></span>
        </h1>
        <p class="text-gray-700 text-lg max-w-2xl mx-auto">
            Struktur organisasi DPM bagian <span class="font-semibold text-red-700">{{ $bagian }}</span>
            untuk periode <span class="text-red-800 font-semibold">{{ $periode ?? 'terbaru' }}</span>
        </p>
    </div>

    {{-- Penjelasan Bagian --}}
    <div class="bg-amber-50 border-l-4 border-orange-400 p-5 rounded-md shadow mb-10 text-gray-800 text-sm md:text-base font-medium text-center">
        @switch(strtolower($bagian))
            @case('pimpinan')
                <p><strong>Pimpinan DPM</strong></p>
                @break
            @case('komisi 1')
                <p><strong>Komisi I – Pengawasan BEM</strong></p>
                @break
            @case('komisi 2')
                <p><strong>Komisi II – Perundang-Undangan</strong></p>
                @break
            @case('komisi 3')
                <p><strong>Komisi III – Pengawasan UKM & HMPS</strong></p>
                @break
            @case('komisi 4')
                <p><strong>Komisi IV – Advokasi</strong></p>
                @break
            @case('komisi 5')
                <p><strong>Komisi V – Hubungan Keluar</strong></p>
                @break
            @default
                <p><strong>Bagian DPM</strong></p>
        @endswitch
    </div>

    {{-- Anggota --}}
    @if($anggota->isEmpty())
        <div class="text-center text-gray-500 text-lg italic">
            Belum ada anggota yang terdaftar di bagian ini.
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
            @foreach ($anggota as $item)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl hover:scale-105 transition-all duration-300 text-center p-6 border border-purple-100 group">
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_anggota }}"
                         class="w-56 h-56 object-cover rounded-xl mx-auto border-4 border-[#9400D3] ring-2 ring-purple-500/20 group-hover:ring-purple-700/40 transition duration-300 mb-4">

                    <h3 class="text-lg font-bold text-red-700 group-hover:text-[#9400D3] transition">{{ $item->nama_anggota }}</h3>
                    <p class="text-sm text-gray-800 font-medium">{{ $item->jabatan }}</p>
                    <p class="text-sm text-gray-500 italic">{{ $item->prodi }}</p>
                    <p class="text-xs text-gray-400 mt-1">Periode {{ $item->periode }}</p>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Back Button --}}
    <div class="mt-14 text-center">
        <a href="{{ route('struktur') }}"
           class="inline-block px-6 py-2 bg-gradient-to-r from-red-500 to-red-700 text-white font-medium rounded-full shadow-md hover:shadow-lg hover:scale-105 transition duration-300">
           ← Kembali ke Struktur Utama
        </a>
    </div>

</div>
@endsection
