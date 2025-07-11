@extends('layouts.app')

@section('content')

<section class="py-10 px-4 md:px-8 lg:px-24 bg-amber-50">
    <div class="container mx-auto px-4 py-10 max-w-5xl text-center" x-data="{ loading: false }">
    {{-- Judul Halaman --}}
    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold text-red-700 inline-block relative" data-aos="fade-down">
            🗣️ Aspirasi Mahasiswa
            <span class="block h-1 bg-gradient-to-r from-orange-400 to-orange-600 mt-2 rounded-full"></span>
        </h1>
    </div>

    {{-- Kirim Aspirasi --}}
    <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-200 mb-10" data-aos="fade-up">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h4l3 10 4-18 3 8h4" />
            </svg>
            Kirim Aspirasi Anda
        </h2>

        {{-- FORM --}}
        <form action="{{ route('aspirasi.store') }}" method="POST" class="space-y-6 relative" @submit="loading = true">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 text-left">Nama</label>
                    <input type="text" name="nama_pengirim" placeholder="Masukkan Nama" class="w-full px-4 py-3 border rounded-lg focus:ring-red-500 focus:border-red-500" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 text-left">NIM</label>
                    <input type="text" name="nim" placeholder="Masukkan NIM" class="w-full px-4 py-3 border rounded-lg focus:ring-red-500 focus:border-red-500" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 text-left">Prodi</label>
                    <input type="text" name="prodi" placeholder="Contoh: D3 Manajemen Informatika" class="w-full px-4 py-3 border rounded-lg focus:ring-red-500 focus:border-red-500" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 text-left">Email</label>
                    <input type="email" name="email" placeholder="Email Aktif" class="w-full px-4 py-3 border rounded-lg focus:ring-red-500 focus:border-red-500" required>
                </div>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 text-left">Isi Aspirasi</label>
                <textarea name="isi_aspirasi" rows="5" placeholder="Tulis aspirasi Anda di sini..." class="w-full px-4 py-3 border rounded-lg resize-none focus:ring-red-500 focus:border-red-500" required></textarea>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 text-white font-semibold px-6 py-3 rounded-lg transition shadow flex items-center justify-center gap-2"
                        :disabled="loading">
                    <template x-if="loading">
                        <svg class="w-5 h-5 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                    </template>
                    <span x-text="loading ? 'Mengirim...' : '🚀 Kirim Aspirasi'"></span>
                </button>
            </div>

            {{-- Overlay loading --}}
            <div x-show="loading" class="absolute inset-0 bg-white/60 flex items-center justify-center rounded-xl z-10">
                <div class="text-center">
                    <svg class="w-10 h-10 animate-spin text-red-600 mx-auto mb-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <p class="text-sm text-red-600 font-medium">Mohon tunggu...</p>
                </div>
            </div>
        </form>
    </div>
</div>

</section>

    {{-- Notifikasi Kode Aspirasi --}}
    @if(session('kode_aspirasi'))
    <div
        x-data="{ open: true }"
        x-show="open"
        x-transition.opacity 
        class="fixed inset-0 flex items-center justify-center z-50 bg-black/30"
    >
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 border border-green-300">
            <div class="flex items-start gap-3">
                <svg class="w-6 h-6 text-green-600 mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <div>
                    <h3 class="text-lg font-semibold text-green-800 mb-1">Aspirasi berhasil dikirim!</h3>
                    <p class="text-sm mb-2">Kode Anda: <strong>{{ session('kode_aspirasi') }}</strong></p>
                    <a href="{{ route('aspirasi.download', session('kode_aspirasi')) }}"
                    class="text-blue-600 underline hover:text-blue-800 text-sm" target="_blank">
                        📄 Unduh Kode Aspirasi (PDF)
                    </a>
                </div>
            </div>

            {{-- Tombol Tutup --}}
            <div class="text-right mt-5">
                <button @click="open = false"
                    class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                    Tutup
            </button>
            </div>           
        </div>
    </div>
    @endif


    {{-- Cek Tanggapan --}}
<section class="w-full px-6 md:px-12 py-20 bg-gradient-to-b from-white to-red-50 text-gray-800">
    <div class="container mx-auto max-w-5xl bg-white shadow-xl rounded-2xl px-8 py-10 border border-gray-100" data-aos="fade-up">
        
        {{-- Judul --}}
        <h2 class="text-3xl font-extrabold text-red-700 text-center mb-8 relative">
            🧐 Cek Tanggapan Aspirasi
            <span class="block w-1/2 mx-auto h-1 bg-orange-400 mt-2 rounded-full"></span>
        </h2>

        {{-- Deskripsi Singkat --}}
        <p class="text-center text-gray-600 mb-8 text-sm md:text-base">
            Masukkan kode aspirasi yang kamu terima setelah mengirimkan aspirasi, lalu klik tombol cek untuk melihat status atau tanggapan dari DPM.
        </p>

        {{-- Form Cek --}}
        <form action="{{ route('aspirasi.cek') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-4">
            <div class="flex-1 w-full relative">
                <input type="text" name="kode" placeholder="🔑 Kode Aspirasi"
                    class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-red-500 focus:outline-none transition duration-200 placeholder:text-sm"
                    required>
                <div class="absolute right-4 top-3.5 text-gray-400 pointer-events-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 17h5l-1.405-1.405M16 11a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <button type="submit"
                class="bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:scale-105 transition-all duration-300">
                🔍 Cek
            </button>
        </form>

        @if(session('not_found'))
            <div class="mt-6 bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded-lg flex items-start gap-3 shadow-sm">
                <svg class="w-5 h-5 mt-1 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <p class="text-sm">
                    {{ session('not_found') }}
                </p>
            </div>
        @endif

        {{-- Tambahan Tips / Notifikasi kecil --}}
        <div class="mt-6 text-center text-sm text-gray-500">
            Belum punya kode? <a href="#aspirasi" class="text-red-600 hover:underline font-semibold">Kirim aspirasi sekarang</a>
        </div>
    </div>
</section>

<section class="py-20 px-4 md:px-8 lg:px-24 bg-amber-50">
    {{-- Statistik Aspirasi --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center my-10" data-aos="fade-up">

        {{-- Total Aspirasi --}}
        <div class="bg-gradient-to-br from-purple-800 to-purple-500 text-white shadow-lg rounded-xl p-6 border border-purple-300 hover:shadow-2xl transition-all duration-300">
            <p class="text-5xl font-extrabold">{{ $totalAspirasi }}</p>
            <p class="mt-2 text-sm font-medium">Total Aspirasi</p>
        </div>

        {{-- Sudah Ditanggapi --}}
        <div class="bg-gradient-to-br from-purple-700 to-purple-400 text-white shadow-lg rounded-xl p-6 border border-purple-300 hover:shadow-2xl transition-all duration-300">
            <p class="text-5xl font-extrabold">{{ $totalDitanggapi }}</p>
            <p class="mt-2 text-sm font-medium">Sudah Ditanggapi</p>
        </div>

        {{-- Belum Ditanggapi --}}
        <div class="bg-gradient-to-br from-purple-600 to-purple-300 text-white shadow-lg rounded-xl p-6 border border-purple-300 hover:shadow-2xl transition-all duration-300">
            <p class="text-5xl font-extrabold">{{ $totalBelumDitanggapi }}</p>
            <p class="mt-2 text-sm font-medium">Belum Ditanggapi</p>
        </div>

    </div>


</section>


{{-- AOS (Animasi saat scroll) --}}

<script>
    AOS.init({ once: true, duration: 1000 });
</script>
<script>
    @if (session('not_found'))
        Swal.fire({
            icon: 'error',
            title: 'Kode Tidak Ditemukan',
            text: '{{ session('not_found') }}',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Tutup'
        });
    @endif
</script>


{{-- Tailwind Component --}}
@push('styles')
<style>
    .input-form {
        @apply w-full pl-4 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:outline-none focus:border-red-500 shadow-sm;
    }
</style>
@endpush

@endsection
