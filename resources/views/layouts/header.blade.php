<nav class="bg-red-800 border-b shadow-sm sticky top-0 z-50 w-full">
    <div class="flex justify-between items-center px-4 py-4">
        {{-- Logo & Nama --}}
        <div class="flex items-center space-x-3">
            <img src="{{ asset('img/logo_dpm.png') }}" alt="Logo DPM" class="h-14 w-14 object-contain">
            <div>
                <h1 class="text-sm md:text-base font-bold text-white">Dewan Perwakilan Mahasiswa</h1>
                <p class="text-xs md:text-sm text-white leading-tight">Politeknik Negeri Medan</p>
            </div>
        </div>

        {{-- Desktop Menu --}}
        <div class="hidden md:flex items-center space-x-8 text-white font-medium">
            <a href="{{ url('/') }}" class="hover:text-orange-400 transition">Beranda</a>
            <a href="{{ route('struktur') }}" class="hover:text-orange-400 transition">Profil</a>
            <a href="{{ route('documentation.index') }}" class="hover:text-orange-400 transition">Dokumentasi</a>
            <a href="{{ route('aspirasi.index') }}" class="hover:text-orange-400 transition">Aspirasi</a>
        </div>

        {{-- Kirim Aspirasi Button (Desktop) --}}
        <div class="hidden md:block">
            <a href="{{ route('aspirasi.index') }}" class="text-white bg-red-600 px-4 py-2 rounded-lg hover:bg-red-700 transition">
                ✉️ Kirim Aspirasimu
            </a>
        </div>

        {{-- Mobile Menu Button --}}
        <div class="md:hidden">
            <button id="mobile-menu-button" class="text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 bg-red-800 text-white">
        <ul class="space-y-2 font-medium">
            <li><a href="{{ url('/') }}" class="block py-2 hover:text-orange-400">Beranda</a></li>
            <li><a href="{{ route('struktur') }}" class="block py-2 hover:text-orange-400">Profil</a></li>
            <li><a href="{{ route('documentation.index') }}" class="block py-2 hover:text-orange-400">Dokumentasi</a></li>
            <li><a href="{{ route('aspirasi.index') }}" class="block py-2 hover:text-orange-400">Aspirasi</a></li>
            <li><a href="{{ url('/portal') }}" class="block mt-2 bg-white text-red-800 font-semibold px-4 py-2 rounded hover:bg-gray-200">Portal</a></li>
        </ul>
    </div>
</nav>

{{-- Toggle Mobile Script --}}
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function () {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
