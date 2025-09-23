@extends('layouts.app')

@section('content')
{{-- Hero Section --}}
<section class="relative h-screen bg-cover bg-center flex items-center justify-center text-center" style="background-image: url('{{ asset('img/bgdpm2.png') }}');">
  <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
  <div class="relative z-10 px-4">
    <h1 class="text-white text-4xl md:text-6xl font-bold font-poppins mb-4 drop-shadow-lg animate__animated animate__fadeInDown">
      Selamat Datang di Website Resmi
    </h1>
    <h2 class="text-white text-2xl md:text-4xl font-semibold mb-6 animate__animated animate__fadeInUp">
      Dewan Perwakilan Mahasiswa Politeknik Negeri Medan
    </h2>
    <p class="text-white text-lg max-w-2xl mx-auto animate__animated animate__fadeInUp animate__delay-1s">
      Suarakan aspirasi, ikuti kegiatan kampus, dan kenali lebih dekat kinerja perwakilan mahasiswa yang transparan dan inspiratif.
    </p>
    <a href="{{ route('struktur') }}" class="inline-block mt-6 px-6 py-3 bg-red-700 hover:bg-red-800 text-white rounded-full text-sm transition duration-300 animate__animated animate__fadeInUp animate__delay-2s">
      ⬇ Kenali Kami Lebih Dekat
    </a>
  </div>
</section>

{{-- Profil DPM --}}
<section id="profil" class="py-20 px-4 md:px-8 lg:px-24  bg-gradient-to-b from-white to-red-50">
  <div class="max-w-5xl mx-auto px-4" data-aos="fade-up">
    <h3 class="text-3xl font-bold text-center mb-8 text-red-700">Tentang Kami</h3>
    <p class="text-center text-gray-700 text-lg leading-relaxed">
      Dewan Perwakilan Mahasiswa (DPM) adalah lembaga tinggi dalam Keluarga Mahasiswa Politeknik Negeri Medan yang memiliki kekuasaan legislatif. Dewan Perwakilan Mahasiswa memiliki fungsi legislasi, fungsi pengawasan, fungsi advokasi, fungsi anggaran dan fungsi perwakilan. DPM menampung, mempertimbangkan serta menindaklanjuti segala aspirasi Mahasiswa yang disampaikan kepada Dewan Perwakilan Mahasiswa
    </p>
    </div>
</section>

{{-- Kegiatan Terbaru --}}
<section id="kegiatan" class="w-full px-6 md:px-12 py-20  bg-amber-50 text-gray-800">
  <div class="container mx-auto px-4">
    <h3 class="text-3xl font-bold text-center mb-12 text-red-700" data-aos="fade-up">📅 Kegiatan Terbaru</h3>

    @php
      $imageDocs = $latestDocs->filter(function($doc) {
        return $doc->file && \Illuminate\Support\Str::endsWith($doc->file, ['jpg', 'jpeg', 'png', 'webp']);
      });
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @forelse ($imageDocs as $doc)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-aos="zoom-in" data-aos-delay="100">
          <img src="{{ asset('storage/' . $doc->file) }}" alt="{{ $doc->judul }}" class="w-full h-52 object-cover">
          <div class="p-5">
            <h4 class="font-bold text-lg mb-2 text-gray-800">{{ $doc->judul }}</h4>
            <p class="text-sm text-gray-600 mb-3">{{ \Illuminate\Support\Str::limit($doc->deskripsi, 100) }}</p>
            <a href="{{ route('documentation.show', $doc->id_dokumentasi) }}" class="text-sm text-red-600 hover:underline">➜ Lihat Selengkapnya</a>
          </div>
        </div>
      @empty
        <p class="text-center text-gray-500 col-span-3">Belum ada dokumentasi bergambar.</p>
      @endforelse
    </div>
  </div>
</section>

    {{-- Agenda Kegiatan --}}
    <section class="py-20  bg-gradient-to-b from-white to-red-50 px-6 md:px-12">
      <div id="kalender" class="max-w-6xl mx-auto">
        <h3 class="text-3xl font-bold text-center mb-8 text-red-700">📆 Agenda Kegiatan</h3>
        <div id="calendar" class="bg-white rounded-lg shadow p-4"></div>
      </div>
    </section>

    <!-- Modal Preview Agenda -->
    {{-- <div id="agendaModal" class="fixed inset-0 bg-black/40 hidden z-50 items-center justify-center">
      <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative mx-auto my-auto">
        <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-600 hover:text-red-600 text-xl">&times;</button>
        <h4 id="modalTitle" class="text-xl font-bold text-red-700 mb-2"></h4>
        <p id="modalDate" class="text-sm text-gray-500 mb-3"></p>
        <p id="modalDescription" class="text-gray-700 text-sm leading-relaxed"></p>
      </div>
    </div> --}}

{{-- CTA Section --}}
<section class="px-4 md:px-8 lg:px-24 bg-amber-50 text-black py-16 text-center" data-aos="fade-up">
  <div class="max-w-4xl mx-auto px-4">
    <h3 class="text-3xl font-bold mb-4">Punya Aspirasi atau Masukan?</h3>
    <p class="text-lg mb-6">Jangan ragu untuk menyampaikan aspirasi kamu melalui halaman Aspirasi. Kami siap mendengar dan bertindak.</p>
    <a href="{{ route('aspirasi.index') }}" class="inline-block bg-white text-red-700 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
      ✍️ Sampaikan Aspirasi
    </a>
  </div>
</section>
@endsection

@push('styles')
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
@endpush

@push('styles')
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: '{{ route('agenda.events') }}',
      height: 'auto',
      eventColor: '#b91c1c',
      eventClick: function(info) {
        Swal.fire({
          title: info.event.title,
          html: `
            <div class="text-left">
              <p class="mb-2 text-sm text-gray-500">📅 ${new Date(info.event.start).toLocaleDateString('id-ID', {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
              })}</p>
              <p class="text-sm text-gray-700">🕒 ${info.event.extendedProps.waktu ?? 'Waktu belum ditentukan'}</p>
              <p class="text-sm text-gray-700">📍 ${info.event.extendedProps.tempat ?? 'Tempat belum ditentukan'}</p>
              <p class="text-sm text-gray-700">${info.event.extendedProps.deskripsi ?? 'Tidak ada deskripsi.'}</p>
            </div>
          `,
          icon: 'info',
          confirmButtonColor: '#b91c1c',
          confirmButtonText: 'Tutup'
        });
      }
    });

    calendar.render();
  });
</script>
@endpush



