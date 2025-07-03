@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- Hero Section --}}
<section class="relative h-screen bg-cover bg-center flex items-center justify-center text-center" style="background-image: url('{{ asset('img/bgdpm.jpg') }}');">
    <div class="absolute inset-0 bg-opacity-50"></div>
    <div class="relative z-10 px-4">
        <h1 class="text-white text-4xl md:text-6xl font-bold mb-4 drop-shadow-lg animate__animated animate__fadeInDown">
            Selamat Datang di Website Resmi
        </h1>
        <h2 class="text-white text-2xl md:text-4xl font-semibold mb-6 animate__animated animate__fadeInUp">
            Dewan Perwakilan Mahasiswa<br>Politeknik Negeri Medan
        </h2>
        <p class="text-white text-lg max-w-2xl mx-auto animate__animated animate__fadeInUp animate__delay-1s">
            Suarakan aspirasi, ikuti kegiatan kampus, dan kenali lebih dekat kinerja perwakilan mahasiswa yang transparan dan inspiratif.
        </p>
    </div>
</section>

{{-- Profil DPM --}}
<section id="profil" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4" data-aos="fade-up">
        <h3 class="text-3xl font-bold text-center mb-8 text-blue-700">Tentang Kami</h3>
        <p class="text-center text-gray-700 text-lg leading-relaxed">
            Dewan Perwakilan Mahasiswa (DPM) adalah lembaga legislatif kampus yang mengemban amanah untuk menjadi suara dan pengawas mahasiswa. Kami hadir untuk memastikan bahwa setiap aspirasi mahasiswa didengar, diperjuangkan, dan dijalankan dengan prinsip transparansi dan tanggung jawab.
        </p>
    </div>
</section>

{{-- Kegiatan Terbaru --}}
<section id="kegiatan" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <h3 class="text-3xl font-bold text-center mb-12 text-blue-700" data-aos="fade-up">Kegiatan Terbaru</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse ($latestDocs as $doc)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden" data-aos="zoom-in" data-aos-delay="100">
                    @if($doc->file)
                        <img src="{{ asset('storage/' . $doc->file) }}" alt="{{ $doc->judul }}" class="w-full h-52 object-cover">
                    @else
                        <div class="w-full h-52 bg-gray-200 flex items-center justify-center text-gray-500">Tidak ada gambar</div>
                    @endif
                    <div class="p-5">
                        <h4 class="font-bold text-lg mb-2 text-gray-800">{{ $doc->judul }}</h4>
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($doc->deskripsi, 100) }}</p>
                        <a href="{{ route('documentation.show', $doc->id_dokumentasi) }}" class="text-sm text-blue-600 hover:underline">Lihat Selengkapnya</a>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-3">Belum ada kegiatan terbaru.</p>
            @endforelse
        </div>
    </div>
</section>








{{-- Aspirasi --}}
<section id="aspirasi" class="py-20 bg-white">
    <div class="container mx-auto px-4 text-center" data-aos="fade-up">
        <h3 class="text-3xl font-bold text-blue-700 mb-6">Sampaikan Aspirasimu</h3>
        <p class="mb-8 text-gray-700 text-lg">Kami siap mendengar dan menyalurkan aspirasi Anda kepada pihak terkait demi kampus yang lebih baik.</p>
        <a href="{{ url('/aspirasi') }}" class="bg-blue-600 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-blue-700 transition-all duration-300 shadow-lg">
            Kirim Aspirasi
        </a>
    </div>
</section>

{{-- AOS Animation Init --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
<script>
  AOS.init({
    once: true,
    duration: 1000,
  });
</script>

@endsection
