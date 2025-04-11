<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('assets/logo2425-white.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>{{ $title }}</title> --}}

    {{-- Insert CDN links below --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Tailwind --}}
    {{-- <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script> --}}
    {{-- TW Elements --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    {{-- Animate On Scroll (AOS) --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    {{-- JQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-- Datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />

    {{-- SwiperJS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />   

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap');

        * {
            font-family: 'Jost', sans-serif;
            --neutral: #292A67;
            --yellow: #F6CE3E;
            --red: #E62D63;
            --red-lg: #ff6e9a;
            --magenta: #902680;
            --purple: #633F92;
            --purple-dark: #5500a4;
            --tosca: #4CB79C;
            --tosca-lg: rgb(74, 231, 192);
            --yellow-grad: linear-gradient(45deg, var(--yellow) 0%, var(--magenta) 100%);
            --tosca-grad: linear-gradient(45deg, var(--tosca) 0%, var(--purple) 100%);
            --ig-grad: linear-gradient(45deg, #ffde85 0%, #f7792a 30%, #f7504f 40%, #d82b81 60%, #d82b81 75%, #9536c2 100%);
            --line-grad: linear-gradient(45deg, #1a6c2a, #4cc764);
            --yt-grad: linear-gradient(45deg, #f76161, #dc2626);
            --spotify-grad: linear-gradient(45deg, #1DB954, #191414);
            --tiktok-grad: linear-gradient(45deg, #ff0050, #191414 40%, #191414 60%, #00f2ea);
        }


        @font-face {
            font-family: 'Runtoe';
            src: url('{{ asset('assets/Runtoe.ttf') }}') format('truetype'),
                url('{{ asset('assets/Runtoe.otf') }}') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        .swal2-confirm {
            background: rgb(46, 143, 255) !important;
        }

        .swal2-deny,
        .swal2-cancel {
            background: rgb(255, 79, 79) !important;
        }
    </style>
    @yield('head')
</head>

<body class="p-8">
    {{-- @include('loader') --}}
    <div class="min-h-screen overflow-x-hidden bg-neutral text-white">
        @yield('content')
    </div>


    {{-- Insert <script> CDN below --}}

    {{-- TW Elements --}}
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>

    {{-- GSAP, ScrollTrigger --}}
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

    {{-- SwiperJS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- Datatables --}}
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
</body>

</html>
