    {{-- Navbar --}}   
 <nav class="bg-red-800 border-b shadow-sm sticky top-0 z-50">
 <div class="w-full flex justify-between items-center px-2 md:px-4 py-4">        {{-- Logo dan Nama --}}
        <div class="flex items-center space-x-3">
            <img src="{{ asset('img/logo_dpm.png') }}" alt="Logo DPM" class="h-20 w-20 object-contain">
            
            <div >
                <h1 class="text-lg font-bold text-white ">Dewan Perwakilan Mahasiswa</h1>
                <p class="text-sm text-white leading-tight">Politeknik Negeri Medan</p>
            </div>
        </div>

        {{-- Menu (Desktop) --}}
        <div class="absolute left-1/2 transform -translate-x-1/2 hidden md:flex items-center space-x-8 text-lg text-white font-medium">
            <a href="{{ url('/') }}" class="relative group">
                <span class="hover:text-orange-500">Beranda</span>
                <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-orange-500 transition-all group-hover:w-full"></span>
            </a>
            <a href="{{ route('struktur') }}" class="relative group">
                <span class="hover:text-orange-500">Profil Organisasi</span>
                <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-orange-500 transition-all group-hover:w-full"></span>
            </a>
            <a href="{{ route('documentation.index') }}" class="relative group">
                <span class="hover:text-orange-500">Dokumentasi</span>
                <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-orange-500 transition-all group-hover:w-full"></span>
            </a>
           <a href="{{ route('aspirasi.index') }}" class="relative group">
               <span class="hover:text-orange-500">Aspirasi</span>
               <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-orange-500 transition-all group-hover:w-full"></span>
            </a>

        </div>

        {{-- Tombol Aksi --}}
        <div class="hidden md:block">
            <a href="{{ route('aspirasi.index') }}" class="text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
            ✉️ Kirim Aspirasimu
            </a>
        </div>

        {{-- Hamburger Mobile --}}
        <button id="menu-toggle" class="md:hidden focus:outline-none">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden px-6 pb-4 bg-white">
        <ul class="flex flex-col space-y-2 text-gray-700 font-medium">
            <li><a href="{{ url('/') }}" class="hover:text-yellow-600 transition">🏠 Beranda</a></li>
            <li><a href="{{ route('struktur') }}" class="hover:text-yellow-600 transition">👥 Profil Organisasi</a></li>
            <li><a href="{{ route('documentation.index') }}" class="hover:text-yellow-600 transition">📸 Dokumentasi</a></li>
            <li><a href="{{ route('aspirasi.index') }}" class="hover:text-orange-600 transition">📝 Aspirasi</a></li>
            <li><a href="{{route('aspirasi.index') }}" class="bg-red-800 text-white px-4 py-2 rounded-md w-fit mt-2 hover:bg-orange-650">Kirim Aspirasimu</a></li>
        </ul>
    </div>
</nav>

{{-- Toggle Script --}}
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function () {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
