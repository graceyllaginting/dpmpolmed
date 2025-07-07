@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp

<section class="w-full px-6 md:px-12 py-20 bg-amber-50">
    <div id="dokumentasi" data-aos="fade-up" class="text-gray-800 text-center mb-12">
        <h2 class="text-4xl font-extrabold text-red-800 inline-block relative">
            📸 Dokumentasi Kegiatan
            <span class="block h-1 bg-gradient-to-r from-orange-400 to-orange-600 mt-2 rounded-full"></span>
        </h2>
    </div>

    {{-- Tombol Kategori --}}
    <div class="flex flex-wrap justify-center gap-3 mb-8" data-aos="fade-up" data-aos-delay="100">
        @foreach ($categories as $cat)
            <a href="{{ route('dokumentasi.kategori', $cat->id_kategori) }}"
               class="px-4 py-2 rounded-full text-sm font-semibold transition-all duration-200
           {{ isset($selectedCategory) && $selectedCategory->id_kategori == $cat->id_kategori ? 'bg-red-700 text-white' : 'bg-gray-200 hover:bg-red-600 hover:text-white' }}">
               {{ $cat->nama_kategori }}
            </a>
        @endforeach
    </div>

    {{-- Dokumentasi Terbaru (Kecuali Produk Hukum) --}}
    @if (!isset($selectedCategory))
        <h2 class="text-2xl font-semibold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="200">📍 Terbaru</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
            @foreach($latestDocs as $dok)
                @if ($dok->kategori && Str::lower($dok->kategori->nama_kategori) !== 'produk hukum')
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-[1.02] transition duration-300">
                    @if ($dok->file && Str::endsWith($dok->file, ['jpg', 'jpeg', 'png', 'webp']))
                        <img src="{{ asset('storage/' . $dok->file) }}" alt="{{ $dok->judul }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                            <div class="text-center text-sm">
                                📄 {{ basename($dok->file) }} <br>
                            </div>
                        </div>
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
                @endif
            @endforeach
        </div>
    @endif

    {{-- Dokumentasi Produk Hukum --}}
    @if (!isset($selectedCategory) || Str::lower(optional($selectedCategory)->nama_kategori) === 'produk hukum')
        <h2 class="text-2xl font-semibold text-gray-800 mb-6" data-aos="fade-up">📚 Produk Hukum</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-12" data-aos="fade-up" data-aos-delay="100">
            @foreach ($latestDocs as $doc)
                @if ($doc->kategori && Str::lower($doc->kategori->nama_kategori) === 'produk hukum')
                <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col gap-2 hover:shadow-xl transition duration-300">
                    <div class="flex items-start gap-4">
                        <div class="text-4xl">📄</div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">{{ $doc->judul }}</h3>
                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($doc->tanggal)->translatedFormat('d F Y') }}</p>
                            <a href="{{ asset('storage/' . $doc->file) }}" download class="text-blue-600 hover:underline text-sm mt-1 inline-block">
                                ⬇ Unduh Dokumen
                            </a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('documentation.show', $doc->id_dokumentasi) }}"
                           class="text-red-600 hover:text-red-800 text-sm font-semibold inline-block transition duration-200">
                            ➜ Lihat Detail
                        </a>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    @endif

    {{-- Dokumentasi Berdasarkan Kategori (Kecuali Produk Hukum) --}}
    @if (isset($selectedCategory) && Str::lower($selectedCategory->nama_kategori) !== 'produk hukum')
        <h2 class="text-xl font-semibold mb-4">{{ $selectedCategory->nama_kategori }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($selectedCategory->documentation as $doc)
                <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-md transition duration-300">
                    @if ($doc->file && Str::endsWith($doc->file, ['jpg', 'jpeg', 'png', 'webp']))
                        <img src="{{ asset('storage/' . $doc->file) }}" class="w-full h-48 object-cover" alt="{{ $doc->judul }}">
                    @else
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                            <div class="text-center text-sm">
                                📄 {{ basename($doc->file) }} <br>
                            </div>
                        </div>
                    @endif

                    <div class="p-4">
                        <h3 class="font-semibold">{{ $doc->judul }}</h3>
                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($doc->tanggal)->translatedFormat('d F Y') }}</p>
                        <a href="{{ route('documentation.show', $doc->id_dokumentasi) }}"
                           class="text-red-600 hover:text-red-800 text-sm font-semibold block mt-2 transition duration-200">
                            ➜ Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center col-span-3 text-gray-500">Belum ada dokumentasi untuk kategori ini.</p>
            @endforelse
        </div>
    @endif

@endsection
</section>