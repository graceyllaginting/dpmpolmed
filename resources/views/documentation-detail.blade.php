@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-center text-2xl font-bold mb-8">Detail Kegiatan</h1>
<br>
    <div class="grid md:grid-cols-2 gap-8 items-start">
        {{-- Gambar doc --}}
        <div>
            @if($doc->file)
                <img src="{{ asset('storage/' . $doc->file) }}" alt="{{ $doc->judul }}"
                    class="rounded shadow-md w-full max-w-md mx-auto object-cover">
            @else
                <div class="bg-gray-200 w-full h-64 flex items-center justify-center">
                    <p class="text-gray-600">Tidak ada gambar</p>
                </div>
            @endif
        </div>

        {{-- Detail Informasi --}}
        <div class="text-lg">
            <div class="mb-2"><span class="font-semibold">Judul</span> : {{ $doc->judul }}</div>
            <div class="mb-2"><span class="font-semibold">Kategori</span> : {{ $doc->kategori->nama_kategori }}</div>
            <div class="mb-2"><span class="font-semibold">Tanggal</span> : {{ $doc->tanggal }}</div>
            <div class="mb-2"><span class="font-semibold">Deskripsi</span> : {{ $doc->deskripsi }}</div>
        </div>
    </div>
</div>
@endsection
