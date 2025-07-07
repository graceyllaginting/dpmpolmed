<footer class="bg-red-900 text-white pt-10 pb-6">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10">

        {{-- Kiri: Judul, tagline, logo --}}
        <div class="text-center md:text-left space-y-4">
            <div>
                <h2 class="text-2xl font-bold tracking-wider">DPM POLMED</h2>
                <p class="text-sm text-gray-300">Bersama Kita Bisa, Viva Legislativa</p>
            </div>

            {{-- Logo berjajar --}}
            <div class="flex justify-center md:justify-start items-center gap-5 mt-4">
                <img src="{{ asset('img/logo_dpm.png') }}" alt="Logo DPM" class="h-14 w-auto transition-transform hover:scale-105 duration-300">
                <img src="{{ asset('img/logo_polmed.png') }}" alt="Logo Polmed" class="h-14 w-auto transition-transform hover:scale-105 duration-300">
                <img src="{{ asset('img/logofl2mi.png') }}" alt="Logo FL2MI" class="h-14 w-auto transition-transform hover:scale-105 duration-300">
            </div>
        </div>

        {{-- Kanan: Kontak & Sosmed --}}
        <div class="text-center md:text-right flex flex-col justify-between">
            <div class="space-y-2 text-sm text-gray-300">
                <p>Email: <a href="mailto:dpm@polmed.ac.id" class="underline hover:text-orange-500 transition">dpm@polmed.ac.id</a></p>
                <p>Alamat: Sekretariat Gedung U, Jln. Almamater No.1 Kampus USU Medan</p>
            </div>

            {{-- Sosial Media --}}
            <div class="flex justify-center md:justify-end items-center gap-4 mt-5">
                @foreach ([
                    ['url' => 'https://instagram.com/dpm.polmed', 'icon' => 'fab fa-instagram', 'label' => 'Instagram'],
                    ['url' => 'https://youtube.com/@dpmpolmed', 'icon' => 'fab fa-youtube', 'label' => 'YouTube'],
                    ['url' => 'https://tiktok.com/@dpm.polmed', 'icon' => 'fab fa-tiktok', 'label' => 'TikTok'],
                    ['url' => 'https://facebook.com/dpm.polmed', 'icon' => 'fab fa-facebook-f', 'label' => 'Facebook'],
                    ['url' => 'https://x.com/dpm.polmed', 'icon' => 'fab fa-x-twitter', 'label' => 'X']
                ] as $soc)
                    <a href="{{ $soc['url'] }}" target="_blank" title="{{ $soc['label'] }}"
                       class="group bg-white text-red-900 hover:bg-orange-500 hover:text-white p-3 rounded-full transition duration-300">
                        <i class="{{ $soc['icon'] }} text-lg group-hover:scale-110 transition-transform"></i>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Garis bawah & hak cipta --}}
    <div class="border-t border-red-700 mt-10 pt-4 text-center text-xs text-gray-300 px-4">
        &copy; {{ date('Y') }} Dewan Perwakilan Mahasiswa Politeknik Negeri Medan. Hak Cipta Dilindungi.
    </div>
</footer>
