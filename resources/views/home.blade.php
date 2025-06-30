@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- Hero Section --}}
<section class="relative h-screen bg-contain bg-no-repeat bg-center flex items-center justify-center text-center" style="background-image: url('{{ asset('img/bgdpm.jpg') }}');">
    <div class="bg-opacity-40 w-full h-full absolute top-0 left-0"></div>
    <div class="relative z-10 px-4">
        <h1 class="text-white text-3xl md:text-5xl font-bold mb-4 drop-shadow-lg">
            Selamat Datang di Website Resmi
        </h1>
        <h2 class="text-white text-2xl md:text-4xl font-semibold mb-6 drop-shadow">
            Dewan Perwakilan Mahasiswa<br>Politeknik Negeri Medan
        </h2>
        <p class="text-white text-base md:text-lg max-w-2xl mx-auto drop-shadow-md">
            Suarakan aspirasi, ikuti kegiatan kampus, dan kenali lebih dekat kinerja perwakilan mahasiswa yang transparan dan inspiratif.
        </p>
    </div>
</section>



{{-- Profil DPM --}}
<section id="profil" class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4">
        <h3 class="text-3xl font-bold text-center mb-8 text-blue-700">Tentang Kami</h3>
        <div class="text-center text-gray-700 text-lg leading-relaxed">
            <p>
                Dewan Perwakilan Mahasiswa (DPM) adalah lembaga legislatif di lingkungan kampus yang bertugas sebagai
                pengawas dan penyalur aspirasi mahasiswa. Kami hadir untuk memastikan setiap suara mahasiswa didengar
                dan ditindaklanjuti secara adil dan bertanggung jawab.
            </p>
        </div>
    </div>
</section>

{{-- Kegiatan Terbaru --}}
<section id="kegiatan" class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
        <h3 class="text-2xl font-bold text-center mb-10 text-blue-700">Kegiatan Terbaru</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @for ($i = 1; $i <= 3; $i++)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <img src="https://source.unsplash.com/random/400x200?sig={{ $i }}" alt="Kegiatan {{ $i }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="font-semibold text-lg mb-2">Judul Kegiatan {{ $i }}</h4>
                    <p class="text-sm text-gray-600">Deskripsi singkat mengenai kegiatan {{ $i }} yang telah diselenggarakan oleh DPM.</p>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

{{-- Aspirasi --}}
<section id="aspirasi" class="py-16 bg-white">
    <div class="container mx-auto px-4 text-center">
        <h3 class="text-2xl font-bold text-blue-700 mb-6">Sampaikan Aspirasimu</h3>
        <p class="mb-6 text-gray-700">Kami siap mendengar dan menyalurkan aspirasi Anda kepada pihak terkait.</p>
        <a href="{{ url('/aspirasi') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">Kirim Aspirasi</a>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

@endsection
