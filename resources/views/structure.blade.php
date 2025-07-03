@extends('layouts.app')

@section('content')
<section class="w-full px-6 md:px-12 py-16 space-y-20 text-gray-800">

    {{-- VISI --}}
    <div id="visi" data-aos="fade-up">
        <h2 class="text-4xl font-extrabold text-red-800 mb-4 border-b-4 border-red-300 inline-block pb-1">Visi</h2>
        <p class="text-lg leading-relaxed mt-4 max-w-4xl">
            Menjadi lembaga legislatif mahasiswa yang aspiratif, transparan, dan bertanggung jawab demi terwujudnya kehidupan kampus yang demokratis dan berkualitas.
        </p>
    </div>

    {{-- MISI --}}
    <div id="misi" data-aos="fade-up">
        <h2 class="text-4xl font-extrabold text-red-800 mb-4 border-b-4 border-red-300 inline-block pb-1">Misi</h2>
        <ul class="list-disc list-inside text-lg space-y-3 mt-4 pl-2 max-w-4xl">
            <li>Mengawal dan mengawasi kinerja organisasi mahasiswa di lingkungan Politeknik Negeri Medan.</li>
            <li>Menampung dan menindaklanjuti aspirasi mahasiswa secara aktif dan solutif.</li>
            <li>Menjalin komunikasi yang harmonis antar civitas akademika kampus.</li>
            <li>Menjadi mitra strategis bagi pihak kampus dalam pengambilan keputusan mahasiswa.</li>
        </ul>
    </div>

    {{-- TUGAS & FUNGSI --}}
    <div id="tugas" data-aos="fade-up">
        <h2 class="text-4xl font-extrabold text-red-800 mb-4 border-b-4 border-red-300 inline-block pb-1">Tugas & Fungsi</h2>
        <ul class="list-decimal list-inside text-lg space-y-3 mt-4 pl-2 max-w-4xl">
            <li>Melaksanakan fungsi legislasi di lingkungan organisasi mahasiswa.</li>
            <li>Mengawasi pelaksanaan program kerja organisasi kemahasiswaan secara menyeluruh.</li>
            <li>Menghimpun dan menyampaikan aspirasi mahasiswa kepada pihak terkait.</li>
            <li>Menjalin koordinasi antar organisasi kemahasiswaan demi terciptanya sinergi gerakan mahasiswa.</li>
        </ul>
    </div>

    {{-- STRUKTUR ORGANISASI --}}
    <div id="struktur" data-aos="fade-up">
        <h2 class="text-4xl font-extrabold text-red-800 mb-8 border-b-4 border-red-300 inline-block pb-1">Struktur Organisasi</h2>

        {{-- Filter Periode --}}
        <div class="mb-12 text-center">
            <form action="{{ route('struktur.index') }}" method="GET" class="flex flex-wrap justify-center items-center gap-4">
                <label for="periode" class="text-lg font-semibold text-red-700">Pilih Periode</label>
                <select name="periode" id="periode"
                        class="px-4 py-2 border border-red-300 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-red-500">
                    @foreach ($allPeriode as $item)
                        <option value="{{ $item }}" {{ request('periode') == $item ? 'selected' : '' }}>
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">
                    Tampilkan
                </button>
            </form>
        </div>

        {{-- Navigasi Bagian --}}
        <div class="flex flex-wrap justify-center gap-4 mb-10">
            @foreach (['Pimpinan', 'Komisi 1', 'Komisi 2', 'Komisi 3', 'Komisi 4', 'Komisi 5'] as $bagian)
                <a href="{{ route('struktur.bagian', ['bagian' => $bagian]) }}"
                   class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition text-sm">
                    {{ $bagian }}
                </a>
            @endforeach
        </div>

        {{-- Grid Struktur --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse ($structure as $anggota)
                <div class="bg-white rounded-2xl shadow-md p-6 text-center hover:shadow-xl transition">
                    <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama_anggota }}"
                         class="w-44 h-44 object-cover rounded-full mx-auto border-4 border-red-300 shadow-lg ring-2 ring-red-500/30 mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $anggota->nama_anggota }}</h3>
                    <p class="text-red-600 font-medium">{{ $anggota->jabatan }}</p>
                    <p class="text-sm text-gray-500 italic">{{ $anggota->prodi }}</p>
                    <p class="text-xs text-gray-400">{{ $anggota->periode }}</p>
                </div>
            @empty
                <p class="text-gray-500 italic col-span-4 text-center">Belum ada data struktur untuk periode ini.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- AOS --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true });
</script>
@endsection
