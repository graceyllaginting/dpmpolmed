<footer class="bg-red-900 text-white py-10">
    <div class="w-full max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- Kiri: Judul, tagline, dan logo --}}
        <div class="text-center md:text-left">
            <h2 class="text-2xl font-bold tracking-wide">DPM POLMED</h2>
            <p class="text-sm text-gray-300 mt-2">
                Bersama Kita Bisa, Viva Legislativa
            </p>

            {{-- Logo berjajar --}}
            <div class="flex justify-center md:justify-start gap-5 mt-4">
                <img src="{{ asset('img/logo_dpm.png') }}" alt="Logo DPM" class="h-14 w-auto">
                <img src="{{ asset('img/logo_polmed.png') }}" alt="Logo Polmed" class="h-14 w-auto">
                <img src="{{ asset('img/logofl2mi.png') }}" alt="Logo FL2MI" class="h-14 w-auto">
            </div>
        </div>

        {{-- Kanan: Kontak dan Sosial Media --}}
        <div class="text-center md:text-right space-y-4">
            <div class="text-sm text-gray-300">
                <p>Email: <a href="mailto:dpm@polmed.ac.id" class="underline">dpm@polmed.ac.id</a></p>
                <p>Alamat: Sekretariat Gedung U Jln. Almamater No.1 Kampus USU Medan</p>
            </div>

            <div class="flex justify-center md:justify-end gap-4 mt-2">
                <a href="https://instagram.com/dpm.polmed" target="_blank"
                   class="bg-white text-red-900 hover:bg-red-200 p-3 rounded-full transition">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://youtube.com/@dpmpolmed" target="_blank"
                   class="bg-white text-red-900 hover:bg-red-200 p-3 rounded-full transition">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="https://tiktok.com/@dpm.polmed" target="_blank"
                   class="bg-white text-red-900 hover:bg-red-200 p-3 rounded-full transition">
                    <i class="fab fa-tiktok"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Copyright & Visitor --}}
    <div class="border-t border-red-700 mt-8 pt-4 text-center text-xs text-gray-300">
        &copy; {{ date('Y') }} Dewan Perwakilan Mahasiswa Politeknik Negeri Medan. Hak Cipta Dilindungi. <br>
    </div>


</footer>
