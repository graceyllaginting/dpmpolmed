@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">
    <h1 class="text-3xl font-bold text-center mb-8">Aspirasi Mahasiswa</h1>

{{-- Kirim Aspirasi --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6 border border-gray-200">
        <h2 class="text-xl font-semibold mb-4 text-red-700">Kirim Aspirasi</h2>
        <form action="{{ route('aspirasi.store') }}" method="POST">
            @csrf
            <div class="grid md:grid-cols-2 gap-6">
                {{-- Nama --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Nama</label>
                    <div class="relative">
                        <input type="text" name="nama_pengirim"
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:outline-none focus:border-red-500 shadow-sm"
                            placeholder="Masukkan Nama" required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5.121 17.804A10.003 10.003 0 0012 22a10.003 10.003 0 006.879-4.196M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- NIM --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">NIM</label>
                    <input type="text" name="nim"
                        class="w-full pl-4 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:outline-none focus:border-red-500 shadow-sm"
                        placeholder="Masukkan NIM" required>
                </div>

                {{-- Prodi --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Prodi</label>
                    <input type="text" name="prodi"
                        class="w-full pl-4 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:outline-none focus:border-red-500 shadow-sm"
                        placeholder="Contoh: D3 Manajemen Informatika" required>
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Email</label>
                    <input type="email" name="email"
                        class="w-full pl-4 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:outline-none focus:border-red-500 shadow-sm"
                        placeholder="Masukkan Email Aktif" required>
                </div>
            </div>

            {{-- Isi Aspirasi --}}
            <div class="mt-6">
                <label class="block text-gray-700 font-medium mb-1">Isi Aspirasi</label>
                <textarea name="isi_aspirasi" rows="5"
                    class="w-full p-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:outline-none focus:border-red-500 shadow-sm"
                    placeholder="Tulis aspirasi atau saran Anda di sini..." required></textarea>
            </div>

            {{-- Tombol --}}
            <div class="mt-6 text-right">
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-2 rounded-lg shadow-md transition duration-200">
                    Kirim Aspirasi
                </button>
            </div>
        </form>
    </div>


        @if(session('kode_aspirasi'))
        <div class="bg-green-50 border border-green-300 text-green-900 px-4 py-4 rounded-lg mt-4 flex items-center gap-3 shadow-sm">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
<br>
         
    {{-- Cek Tanggapan --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6 border">
        <h2 class="text-xl font-semibold mb-4">Cek Tanggapan Aspirasi</h2>
        <form action="{{ route('aspirasi.cek') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
            <input type="text" name="kode" placeholder="Masukkan Kode Aspirasi"
                   class="flex-1 rounded border-gray-300 focus:ring-red-500 focus:border-red-500" required>
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded transition">Cek Tanggapan</button>
        </form>
    </div>

    {{-- Aspirasi yang Sudah Ditanggapi --}}
    <div class="bg-white shadow-md rounded-lg p-6 border">
        <h2 class="text-xl font-semibold mb-4">Aspirasi yang sudah ditanggapi</h2>
        {{-- Contoh data, nanti bisa diganti pakai @foreach --}}
        <div class="space-y-3">
            <div class="bg-gray-100 p-4 rounded">
                <p class="font-semibold">Aspirasi tentang fasilitas kelas</p>
                <p class="text-sm text-gray-600">Ditanggapi oleh DPM: Akan segera diperbaiki minggu depan</p>
            </div>
            {{-- Tambahkan loop untuk menampilkan daftar lainnya --}}
        </div>
    </div>
</div>
@endsection
