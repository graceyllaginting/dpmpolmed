@extends('layouts.app')

@section('content')
{{-- Tabs Navigasi Interaktif Responsif --}}
<div 
    x-data="{ tab: window.location.hash || '#visi-misi' }"
    x-init="$watch('tab', value => { document.querySelector(value)?.scrollIntoView({ behavior: 'smooth' }) })"
    class="w-full bg-white shadow-md border-b border-red-100 sticky top-0 z-40 overflow-x-auto"
>
    <div class="flex flex-nowrap sm:flex-wrap justify-start sm:justify-center gap-4 sm:gap-6 px-4 md:px-8 py-3 text-xs sm:text-sm md:text-base whitespace-nowrap">
        <template x-for="(label, target) in {
            '#visi-misi': 'Visi & Misi',
            '#komisi': 'Komisi',
            '#struktur': 'Struktur',
            '#sejarah': 'Sejarah'
        }" :key="target">
            <a
                :href="target"
                @click.prevent="tab = target"
                class="px-3 sm:px-4 py-1 font-semibold transition-all duration-200 relative"
                :class="tab === target ? 'text-red-800' : 'text-red-600 hover:text-red-800'"
            >
                <span x-text="label"></span>
                <span 
                    class="absolute bottom-0 left-1/2 -translate-x-1/2 h-0.5 bg-red-800 rounded-full transition-all duration-300"
                    :class="tab === target ? 'w-8 opacity-100' : 'w-0 opacity-0'">
                </span>
            </a>
        </template>
    </div>
</div>


<section class="scroll-mt-24 py-20 px-4 md:px-8 lg:px-24 bg-amber-50" id="visi-misi">
    <div class="grid md:grid-cols-2 gap-16 items-start">
        {{-- VISI --}}
        <div id="visi" data-aos="fade-right" class="text-center md:text-left">
            <h2 class="text-4xl font-extrabold text-red-800 inline-block relative mb-4">
                Visi
                <span class="block w-16 h-1 bg-orange-500 mt-2 mx-auto md:mx-0 rounded-full"></span>
            </h2>
            <p class="text-lg leading-relaxed mt-4 text-gray-800 max-w-xl mx-auto md:mx-0">
                <span class="font-semibold text-red-700">Membangun hubungan</span> yang baik dan produktif dengan semua elemen yang ada
                di lingkungan Politeknik Negeri Medan serta <span class="font-semibold text-red-700">memperjuangkan aspirasi</span> dan kepentingan mahasiswa Politeknik Negeri Medan.
            </p>
        </div>

        {{-- MISI --}}
        <div id="misi" data-aos="fade-left" class="text-center md:text-left">
            <h2 class="text-4xl font-extrabold text-red-800 inline-block relative mb-4">
                Misi
                <span class="block w-16 h-1 bg-orange-500 mt-2 mx-auto md:mx-0 rounded-full"></span>
            </h2>

            <div class="mt-6 space-y-6">
                @php
                    $misi = [
                        "Membangun komunikasi yang intensif dan efektif dengan mahasiswa.",
                        "Menjalankan peran dan fungsi Dewan Perwakilan Mahasiswa Politeknik Negeri Medan secara optimal dan berkesinambungan.",
                        "Menjadikan Dewan Perwakilan Mahasiswa Politeknik Negeri Medan sebagai badan legislatif yang dapat bertanggung jawab dan selalu menjaga nama baik almamater."
                    ];
                @endphp

                @foreach ($misi as $index => $item)
                    <div class="flex items-start gap-4 transition-all duration-300 hover:scale-[1.02] hover:shadow-md p-3 rounded-md bg-white/60 text-gray-800 text-justify">
                        <div class="text-orange-500 text-xl font-bold">{{ $index + 1 }}.</div>
                        <div class="text-base leading-relaxed">
                            {{ $item }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


<section id="komisi" class="scroll-mt-24 w-full px-6 md:px-12 py-20 bg-gradient-to-b from-white to-red-50 text-gray-800">
    <div  data-aos="fade-up" class="text-gray-800 text-center mb-12">
        <h2 class="text-4xl font-extrabold text-red-800 inline-block relative">
            Komisi-Komisi DPM
            <span class="block h-1 bg-gradient-to-r from-orange-400 to-orange-600 mt-2 rounded-full"></span>
        </h2>
    </div>

    <div x-data class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach ($komisi as $item)
            <div x-data="{ flipped: false }"
                 @click="flipped = !flipped"
                 class="group relative w-full h-72 perspective transition-transform duration-500 transform hover:scale-105">
                <div :class="{ 'rotate-y-180': flipped }"
                     class="transition duration-700 relative w-full h-full transform-style preserve-3d">

                    {{-- Front Side --}}
                    <div class="absolute w-full h-full backface-hidden bg-red-800 text-white rounded-xl shadow-xl p-6 flex flex-col justify-center items-center text-center">
                        <div class="text-5xl mb-4">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="text-xl font-bold">{{ $item['nama'] }}</h3>
                        <p class="text-sm mt-2">{{ $item['ringkas'] ?? 'Klik untuk detail' }}</p>
                        <span class="mt-4 inline-block text-xs text-white bg-red-700 px-2 py-1 rounded-full group-hover:bg-orange-500 transition">Lihat Tugas</span>
                    </div>

                    {{-- Back Side --}}
                    <div class="absolute w-full h-full backface-hidden bg-amber-50 border border-red-200 rounded-xl p-5 text-sm text-justify transform rotate-y-180 overflow-y-auto shadow-inner">
                        <h4 class="font-bold text-red-700 mb-2">Tugas:</h4>
                        <pre class="whitespace-pre-wrap text-gray-700">{{ $item['deskripsi'] }}</pre>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</section>

<section id="struktur" class=" scroll-mt-24 w-full px-6 md:px-12 py-20 bg-amber-50">
    {{-- STRUKTUR ORGANISASI --}}
    <div data-aos="fade-up" class="text-gray-800 text-center mb-12">
    <h2 class="text-4xl font-extrabold text-red-800 inline-block relative">
            Struktur Organisasi
            <span class="block h-1 bg-gradient-to-r from-orange-400 to-orange-600 mt-2 rounded-full"></span>
        </h2>
    </div>
        {{-- Filter Periode --}}
        <div class="mb-12 text-center">
            <form action="{{ route('struktur.index') }}" method="GET"
                  class="flex flex-wrap justify-center items-center gap-4">
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
                        class="bg-gradient-to-r from-red-600 to-red-800 text-white px-5 py-2 rounded-md hover:shadow-lg transition duration-300">
                    Tampilkan
                </button>
            </form>
        </div>

        {{-- Navigasi Bagian --}}
        <div class="flex flex-wrap justify-center gap-3 mb-16">
            @foreach (['Pimpinan', 'Komisi 1', 'Komisi 2', 'Komisi 3', 'Komisi 4', 'Komisi 5'] as $bagian)
                <a href="{{ route('struktur.bagian', ['bagian' => $bagian]) }}"
                   class="px-5 py-2 bg-red-500 text-white rounded-full text-sm shadow hover:bg-red-700 transition duration-300">
                    {{ $bagian }}
                </a>
            @endforeach
        </div>

        {{-- Grid Struktur --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
            @forelse ($structure as $anggota)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 group hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 hover:scale-105 text-center p-6 relative overflow-hidden">
                    {{-- Efek animasi lingkaran luar --}}
                    <div class="absolute -top-10 -left-10 w-32 h-32 bg-red-100 rounded-full opacity-30 blur-2xl group-hover:scale-125 transition-transform duration-700"></div>

                    {{-- Foto --}}
                    <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama_anggota }}"
                        class="w-60 h-60 object-cover rounded-xl mx-auto border-4 border-[#9400D3] shadow-md ring-2 ring-purple-500/20 group-hover:ring-purple-700/40 transition duration-300 mb-4">

                    {{-- Informasi --}}
                    <h3 class="text-lg font-semibold text-red-800 group-hover:text-[#9400D3] transition">{{ $anggota->nama_anggota }}</h3>
                    <p class="text-sm text-red-600 font-medium">{{ $anggota->jabatan }}</p>
                    <p class="text-sm text-gray-500 italic">{{ $anggota->prodi }}</p>
                    <p class="text-xs text-gray-400 mt-1">Periode {{ $anggota->periode }}</p>
                </div>
            @empty
                <p class="text-gray-500 italic col-span-full text-center">Belum ada data struktur untuk periode ini.</p>
            @endforelse
        </div>
    </div>
</section>


<section id = "sejarah" class="scroll-mt-24 w-full px-6 md:px-12 py-20 bg-gradient-to-b from-white to-red-50 text-gray-800" x-data="{ showModal: false }">
    <div id="komisi" data-aos="fade-up" class="text-gray-800 text-center mb-12">
        <h2 class="text-4xl font-extrabold text-red-800 inline-block relative">
            Sejarah DPM POLMED
            <span class="block h-1 bg-gradient-to-r from-orange-400 to-orange-600 mt-2 rounded-full"></span>
        </h2>
    </div>

    <div class="text-gray-700 text-center max-w-3xl mx-auto leading-relaxed">
        <p>
            Dewan Perwakilan Mahasiswa (DPM) Politeknik Negeri Medan adalah organisasi legislatif mahasiswa yang berdiri untuk menjalankan fungsi legislasi, pengawasan, dan aspirasi di lingkungan kampus.
            <br>
            <button @click="showModal = true"
                class="mt-6 px-6 py-2 rounded-full bg-red-700 hover:bg-red-800 text-white font-semibold transition duration-300 shadow">
            📖 Lihat Sejarah lengkap
        
        </button>
        </p>
    </div>

{{-- Modal Sejarah DPM POLMED --}}
<div x-show="showModal"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4"
     x-transition
     x-cloak>
  <div class="bg-white w-full max-w-4xl p-6 rounded-xl shadow-lg overflow-y-auto max-h-[90vh] relative">
    <button @click="showModal = false" 
            class="absolute top-3 right-4 text-gray-400 hover:text-red-700 text-2xl font-bold transition">
        &times;
    </button>

    <h2 class="text-2xl md:text-3xl font-bold text-red-700 mb-6 text-center">
        📜 Sejarah DPM POLMED
    </h2>

    <div class="space-y-6 text-gray-700 leading-relaxed text-sm md:text-base">
      <p>
        Pada Tahun 2003, 9 (Sembilan) Program Studi yaitu Teknik Mesin, Teknik Energi, Teknik Elektro, Teknik Elektronika Industri, Teknik Telekomunikasi, Teknik Sipil, Administrasi Bisnis, Akuntansi dan Perbankan dan Keuangan yang diwakili oleh masing-masing 5 (lima) orang menyelenggarakan Musyawarah yang menghasilkan keputusan untuk dibentuknya suatu Dewan Perwakilan Mahasiswa.
      </p>
      <p>
        Sebagai Ketua pertama DPM POLMED adalah <strong>Kristian Adventus Tampubolon</strong> (Teknik Elektronika Industri, Angkatan 2001). Setelah itu, melalui Tim Formatur bentukan Dewan Perwakilan Mahasiswa, <strong>Sutrisno</strong> (Akuntansi, 2001) sebagai Ketua Senat Mahasiswa 2003–2004.
      </p>

      <ul class="space-y-3 border-l-2 border-red-700 pl-4 mt-4">
        <li>
          <span class="font-semibold text-red-700">2004</span>: Berdasarkan hasil Sidang Umum DPM POLMED Tahun 2004 yang diselenggarakan oleh Tim Formatur Pemilihan DPM, terpilihlah sebagai Ketua DPM – <strong>Rasyid Ridho Lubis</strong> (Teknik Sipil, 2002). Setelah itu, melalui Tim Formatur bentukan DPM terpilihlah Ketua Senat – <strong>Catur Arya Prahasta</strong> (Teknik Sipil, 2002) dengan masa bakti 2004-2005.

        </li>
        <li>
          <span class="font-semibold text-red-700">2005</span>: Berdasarkan hasil Sidang Umum DPM POLMED Tahun 2005 yang diselenggarakan oleh Tim Formatur Pemilihan DPM pada tanggal 16 Jull 2005 terpilihlah Ketua DPM – <strong>Nova Heri Soni</strong> (Teknik Energi, 2003). Setelah itu, melalui Tim Formatur bentukan DPM terpilihlah Ketua Senat – <strong>Agus Pelani</strong> (Teknik Mesin, 2003)  dengan masa bakti 2005-2006.

        </li>
        <li>
          <span class="font-semibold text-red-700">2006</span>: Berdasarkan hasil Sidang Umum DPM POLMED Tahun 2006 yang diselenggarakan oleh Tim Formatur Pemilihan DPM terpilihlah Ketua DPM – <strong>Jimmy Kardo Sitepu</strong> (Teknik Elektro, 2004)
        </li>
        <li>
          <span class="font-semibold text-red-700">2008</span>: Berdasarkan hasil Sidang Umum DPM POLMED Tahun 2008 yang diselenggarakan oleh Tim Formatur Pemilihan DPM terpilihlah Ketua DPM – <strong>M. Khairuddin</strong> (MICE, 2005). Setelah itu, melalui Tim Formatur bentukan DPM terpilihlah Ketua Senat – <strong>Ariansyah Ikhwan Nasution</strong> dengan masa bakti 2007 2008.
        </li>
        <li>
          <span class="font-semibold text-red-700">2009</span>: Berdasarkan hasil Sidang Umum DPM Tahun 2009 yang diselenggarakan oleh Tim Formatur Pemilihan DPM terpilihlah Ketua DPM – <strong>Dedy Hakim</strong> (Teknik Mesin, 2006). Setelah itu, melalui Tim Formatur bentukan DPM terpilihlah Ketua Senat – <strong>M. Iqbal Lubis</strong> (Perbankan dan Keuangan, 2006) dengan masa bakti 2009-2010.

        </li>
        <li>
          <span class="font-semibold text-red-700">2011</span>: Berdasarkan hasil Sidang Umum DPM Tahun 2011 yang diselenggarakan oleh Tim Formatur Pemilihan DPM, terpilihlah  Ketua DPM – <strong>Rahmad Nurdiansyah</strong> (Perbankan dan Keuangan, 2009). Setelah itu, melalui Tim Formatur bentukan DPM terpilihlah Ketua Senat – <strong>Firmansyah</strong> (Akuntansi, 2009) dengan masa bakti 2011-2012.

        </li>
        <li>
          <span class="font-semibold text-red-700">2012</span>: Berdasarkan hasil Sidang Umum DPM Tahun 2012 yang diselenggarakan oleh Tim Formatur Open Recruitment DPM, terpilihlah Ketua DPM – <strong>Yanuardi Sanjaya</strong> (Perbankan dan Keuangan, 2011). Setelah itu melalui Sidang istimewa KEMA POLMED, terpilihlah Ketua BEM – <strong>Ahmad Habibi Indraja Lubis</strong> Periode 2013-2014.

        </li>
        <li>
          <span class="font-semibold text-red-700">2014</span>: Berdasarkan hasil Sidang Paripurna I DPM Tahun 2014 yang diselenggarakan oleh Tim Formatur Open Recruitment DPM, terpilihlah Ketua DPM – <strong>Wahyu Nugroho</strong> (Teknik Mesin, 2012). Setelah itu melalui Sidang Istimewa KEMA POLMED, terpilihlah Ketua BEM – <strong>M. Zuhri Maulana Nasution</strong> Periode 2014-2015.
        </li>
      </ul>

      <p class="mt-4">
        DPM POLMED terus berkembang menjadi lembaga legislatif mahasiswa yang mengawal demokrasi kampus, menyuarakan kepentingan mahasiswa, dan menjalin kerja sama antar-lembaga di tingkat regional maupun nasional.
      </p>
    </div>
  </div>
</div>
</section>



{{-- AOS --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true });
</script>

<style>
  html {
    scroll-behavior: smooth;
  }
</style>

@endsection
