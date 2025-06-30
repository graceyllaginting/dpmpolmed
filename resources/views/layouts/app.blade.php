<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DPM POLMED')</title>

    {{-- Vite Assets --}}
    @vite([ 'resources/js/app.js', 'resources/css/app.css'])

    {{-- Font --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    {{-- AOS CDN --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
</body>
</html>
