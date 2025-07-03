@extends('layouts.app')

@section('title', 'Aspirasi Mahasiswa')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-5xl">
    {{-- Judul Halaman --}}
    <h1 class="text-4xl font-bold text-center text-red-700 mb-10" data-aos="fade-down">🗣️ Aspirasi Mahasiswa</h1>

{{-- Kirim Aspirasi --}}
    <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-200 mb-10" data-aos="fade-up">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h4l3 10 4-18 3 8h4" />
        </svg>
        Kirim Aspirasi Anda
    </h2>

    <form action="{{ route('aspirasi.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama_pengirim" placeholder="Masukkan Nama" class="w-full px-4 py-3 border rounded-lg focus:ring-red-500 focus:border-red-500" required>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">NIM</label>
                <input type="text" name="nim" placeholder="Masukkan NIM" class="w-full px-4 py-3 border rounded-lg focus:ring-red-500 focus:border-red-500" required>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Prodi</label>
                <input type="text" name="prodi" placeholder="Contoh: D3 Manajemen Informatika" class="w-full px-4 py-3 border rounded-lg focus:ring-red-500 focus:border-red-500" required>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" placeholder="Email Aktif" class="w-full px-4 py-3 border rounded-lg focus:ring-red-500 focus:border-red-500" required>
            </div>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Isi Aspirasi</label>
            <textarea name="isi_aspirasi" rows="5" placeholder="Tulis aspirasi Anda di sini..."class="w-full px-4 py-3 border rounded-lg resize-none focus:ring-red-500 focus:border-red-500" required></textarea>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition shadow">
                🚀 Kirim Aspirasi
            </button>
        </div>
    </form>
</div>

    {{-- Notifikasi Kode Aspirasi --}}
    @if(session('kode_aspirasi'))
    <div class="bg-green-50 border border-green-300 text-green-900 px-4 py-4 rounded-lg mt-6 flex items-start gap-3 shadow-sm">
        <svg class="w-6 h-6 text-green-600 mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        <div>
            <p class="font-semibold">Aspirasi berhasil dikirim!</p>
            <p class="text-sm">Kode: <strong>{{ session('kode_aspirasi') }}</strong></p>
            <a href="{{ route('aspirasi.download', session('kode_aspirasi')) }}"
                class="text-blue-600 underline hover:text-blue-800 text-sm" target="_blank">
                📄 Unduh Kode Aspirasi (PDF)
            </a>
        </div>
    </div>
    @endif

    {{-- Cek Tanggapan --}}
    <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-200 mt-12" data-aos="fade-up">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405M16 11a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Cek Tanggapan Aspirasi
        </h2>

        <form action="{{ route('aspirasi.cek') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
            <input type="text" name="kode" placeholder="Masukkan Kode Aspirasi"
                   class="input-form flex-1" required>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition shadow-md">🔍 Cek</button>
        </form>
    </div>
</div>

{{-- AOS (Animasi saat scroll) --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 1000 });
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
