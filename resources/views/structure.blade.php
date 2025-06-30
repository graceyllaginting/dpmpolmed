@extends('layouts.app') {{-- sesuaikan jika layout kamu berbeda --}}

@section('content')
<section class="max-w-6xl mx-auto px-4 py-12 space-y-16 text-gray-800">

    {{-- VISI --}}
    <div id="visi">
        <h2 class="text-3xl font-bold text-red-800 mb-4">Visi</h2>
        <p class="text-lg leading-relaxed">
            Menjadi lembaga legislatif mahasiswa yang aspiratif, transparan, dan bertanggung jawab demi terwujudnya kehidupan kampus yang demokratis dan berkualitas.
        </p>
    </div>

    {{-- MISI --}}
    <div id="misi">
        <h2 class="text-3xl font-bold text-red-800 mb-4">Misi</h2>
        <ul class="list-disc list-inside text-lg space-y-2">
            <li>Mengawal dan mengawasi kinerja organisasi mahasiswa di lingkungan Politeknik Negeri Medan.</li>
            <li>Menampung dan menindaklanjuti aspirasi mahasiswa secara aktif dan solutif.</li>
            <li>Menjalin komunikasi yang harmonis antar civitas akademika kampus.</li>
            <li>Menjadi mitra strategis bagi pihak kampus dalam pengambilan keputusan mahasiswa.</li>
        </ul>
    </div>

    {{-- STRUKTUR ORGANISASI --}}
    <div id="struktur">
        <h2 class="text-3xl font-bold text-red-800 mb-4">Struktur Organisasi</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($structure as $anggota)
                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama_anggota }}"
                         class="w-32 h-32 object-cover rounded-full mx-auto mb-4">
                    <h3 class="text-lg font-semibold">{{ $anggota->nama_anggota }}</h3>
                    <p class="text-red-700 font-medium">{{ $anggota->jabatan }}</p>
                    <p class="text-sm text-gray-500">{{ $anggota->periode }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- TUGAS & FUNGSI --}}
    <div id="tugas">
        <h2 class="text-3xl font-bold text-red-800 mb-4">Tugas dan Fungsi DPM</h2>
        <ul class="list-decimal list-inside text-lg space-y-2">
            <li>Melaksanakan fungsi legislasi di lingkungan organisasi mahasiswa.</li>
            <li>Mengawasi pelaksanaan program kerja organisasi kemahasiswaan secara menyeluruh.</li>
            <li>Menghimpun dan menyampaikan aspirasi mahasiswa kepada pihak terkait.</li>
            <li>Menjalin koordinasi antar organisasi kemahasiswaan demi terciptanya sinergi gerakan mahasiswa.</li>
        </ul>
    </div>

</section>
@endsection
