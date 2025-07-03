@extends('layouts.app')

@section('title', 'Struktur Bagian')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="mb-10 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-red-700 mb-2">{{ strtoupper($bagian) }}</h1>
        <p class="text-gray-600 text-lg">Struktur organisasi DPM bagian {{ $bagian }} untuk periode {{ $periode ?? 'terbaru' }}</p>
    </div>

    @if($anggota->isEmpty())
        <p class="text-center text-gray-500">Belum ada anggota yang terdaftar di bagian ini.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($anggota as $item)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-5 text-center">
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_anggota }}"
                        class="w-32 h-32 object-cover rounded-full mx-auto mb-4 border-2 border-red-600">
                    <h3 class="text-xl font-semibold text-red-700">{{ $item->nama_anggota }}</h3>
                    <p class="text-sm text-gray-700 font-medium">{{ $item->jabatan }}</p>
                    <p class="text-sm text-gray-500">{{ $item->prodi }}</p>
                    <p class="text-sm text-gray-400 italic">Periode {{ $item->periode }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-10 text-center">
        <a href="{{ route('struktur') }}" class="text-blue-600 hover:underline">← Kembali ke halaman struktur utama</a>
    </div>
</div>
@endsection
