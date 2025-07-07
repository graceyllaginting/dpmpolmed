@extends('layouts.app')

@section('content')
<section class="py-10 px-4 md:px-8 lg:px-24 bg-amber-50 min-h-screen">
    <div class="bg-white max-w-3xl mx-auto rounded-2xl shadow-2xl p-10 border border-gray-200">
        <h2 class="text-3xl font-extrabold text-center text-red-700 mb-10">📨 Undangan Pertemuan DPM</h2>

        @if($aspirasi->invitation)
            <div class="space-y-5 text-gray-700 text-base leading-relaxed">
                <div>
                    <span class="font-bold text-gray-600">👤 Nama Pengirim:</span>
                    <span>{{ $aspirasi->nama_pengirim }}</span>
                </div>
                <div>
                    <span class="font-bold text-gray-600">🆔 Kode Aspirasi:</span>
                    <span>{{ $aspirasi->kode_aspirasi }}</span>
                </div>
                <div>
                    <span class="font-bold text-gray-600">📝 Isi Undangan:</span>
                    <div class="bg-gray-100 mt-1 p-4 rounded-lg border text-sm text-gray-800">
                        {!! nl2br(e($aspirasi->invitation->isi_undangan)) !!}
                    </div>
                </div>
            </div>

            {{-- 🕒 Pesan Batas Waktu --}}
            <div class="mt-8 bg-yellow-100 border-l-4 border-yellow-500 p-4 rounded-lg shadow-sm">
                <p class="text-yellow-800 font-medium">
                    ⏳ <strong>Catatan:</strong> Undangan ini hanya berlaku selama <span class="font-semibold">7 x 24 jam</span> sejak tanggal dikirim. Harap segera memberikan konfirmasi kehadiran Anda.
                </p>
            </div>

            {{-- Konfirmasi --}}
            @if($aspirasi->invitation->status_konfirmasi === 'pending')
                <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                    {{-- Terima --}}
                    <form method="POST" action="{{ route('invitations.konfirmasi', $aspirasi->invitation->id_undangan) }}">
                        @csrf
                        <input type="hidden" name="status_konfirmasi" value="diterima">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md transition">
                            ✅ Terima Undangan
                        </button>
                    </form>

                    {{-- Tolak --}}
                    <form method="POST" action="{{ route('invitations.konfirmasi', $aspirasi->invitation->id_undangan) }}">
                        @csrf
                        <input type="hidden" name="status_konfirmasi" value="ditolak">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md transition">
                            ❌ Tolak Undangan
                        </button>
                    </form>
                </div>
            @else
                <div class="mt-10 text-center">
                    <span class="inline-block bg-green-100 text-green-700 font-semibold px-6 py-3 rounded-lg shadow-sm">
                        Anda telah <strong>{{ ucfirst($aspirasi->invitation->status_konfirmasi) }}</strong> undangan ini.
                    </span>
                </div>
            @endif

        @else
            <div class="text-center text-gray-500 mt-10 text-lg italic">
                ⚠️ Tidak ada undangan yang terkait dengan kode aspirasi ini.
            </div>
        @endif
    </div>
</section>
@endsection
