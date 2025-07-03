@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp

<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-center mb-8">Dokumentasi Kegiatan</h1>

    {{-- Tombol Kategori --}}
    <div class="flex flex-wrap justify-center gap-3 mb-8">
        @foreach ($categories as $cat)
            <a href="{{ route('dokumentasi.kategori', $cat->id_kategori) }}"
               class="px-4 py-2 rounded-full text-sm font-medium transition
               {{ isset($selectedCategory) && $selectedCategory->id_kategori == $cat->id_kategori ? 'bg-red-700 text-white' : 'bg-gray-200 hover:bg-red-600 hover:text-white' }}">
               {{ $cat->nama_kategori }}
            </a>
        @endforeach
    </div>

    {{-- Dokumentasi Terbaru --}}
    @if (!isset($selectedCategory))
        <h2 class="text-xl font-semibold mb-4">Terbaru</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
            @foreach($latestDocs as $dok)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-[1.02] transition duration-300">
                    @if ($dok->file)
                        @if (Str::endsWith($dok->file, ['jpg', 'jpeg', 'png', 'webp']))
                            <img src="{{ asset('storage/' . $dok->file) }}" alt="{{ $dok->judul }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                <div class="text-center text-sm">
                                    📄 {{ basename($dok->file) }} <br>

                                </div>
                            </div>
                        @endif
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">Tidak Ada File</div>
                    @endif

                    <div class="p-4 space-y-2">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $dok->judul }}</h3>
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($dok->tanggal)->translatedFormat('d F Y') }}</p>
                        <p class="text-sm text-gray-600 truncate">Tempat: {{ $dok->deskripsi }}</p>
                        <a href="{{ route('documentation.show', $dok->id_dokumentasi) }}"
                           class="text-red-600 hover:text-red-800 text-sm font-semibold block mt-2 transition duration-200">
                            ➜ Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Dokumentasi Berdasarkan Kategori --}}
    @if (isset($selectedCategory))
        <h2 class="text-xl font-semibold mb-4">{{ $selectedCategory->nama_kategori }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($selectedCategory->documentation as $doc)
                <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-md transition duration-300">
                    @if ($doc->file)
                        @if (Str::endsWith($doc->file, ['jpg', 'jpeg', 'png', 'webp']))
                            <img src="{{ asset('storage/' . $doc->file) }}" class="w-full h-48 object-cover" alt="{{ $doc->judul }}">
                        @else
                            <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                <div class="text-center text-sm">
                                    📄 {{ basename($doc->file) }} <br>
     
                                    </a>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">Tidak Ada File</div>
                    @endif
                    <div class="p-4">
                        <h3 class="font-semibold">{{ $doc->judul }}</h3>
                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($doc->tanggal)->translatedFormat('d F Y') }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center col-span-3 text-gray-500">Belum ada dokumentasi untuk kategori ini.</p>
            @endforelse
        </div>
    @endif
</div>
@endsection
