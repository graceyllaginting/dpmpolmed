<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DPM POLMED')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_dpm.png') }}">

    {{-- Vite Assets --}}
    @vite([ 'resources/js/app.js', 'resources/css/app.css'])

    {{-- Font --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    {{-- AOS CDN --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-50 text-gray-800 font-sans">
    
    {{-- Header --}}
    @include('layouts.header')

    {{-- Halaman Konten --}}
    <main>
        @yield('content')
        
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    {{-- AOS JS (optional jika tidak diimport lewat npm) --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Tambahkan di layout utama -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<style>
    .perspective {
        perspective: 1000px;
    }
    .preserve-3d {
        transform-style: preserve-3d;
    }
    .rotate-y-180 {
        transform: rotateY(180deg);
    }
    .backface-hidden {
        backface-visibility: hidden;
    }
</style>

</body>
</html>
