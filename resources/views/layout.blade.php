<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('logo2.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Penting untuk AJAX --}}
    <title>@yield('title', 'AI Mate - Find My Major')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- TW Elements --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/css/tw-elements.min.css" /> --}} {{-- Duplikat? Pilih salah satu atau yg terbaru --}}

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    {{-- Animate On Scroll (AOS) --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    {{-- JQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-- Datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />

    {{-- SwiperJS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #fd7205;
            --blue: #0066ff;
            --blue-dark: #0056c9; /* Digunakan untuk navbar awal */
            --green: #7f9c53;     /* Digunakan untuk navbar saat scroll & aksen */
            --beige: #f8f1e5;     /* Background body utama */
            --light-beige: #fffdf9;
            --light-green: #a8c778;
            --light-orange: #ff933c;
        }

        @font-face {
            font-family: 'Runtoe';
            src: url('{{ asset('assets/Runtoe.ttf') }}') format('truetype'),
                 url('{{ asset('assets/Runtoe.otf') }}') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Jost', sans-serif;
            background-color: var(--beige); /* Background utama dari body */
            /* Padding-top akan ditambahkan oleh JavaScript berdasarkan tinggi navbar,
               atau Anda bisa set manual jika tingginya tetap, misal 76px */
        }

        /* Styling untuk navbar saat di-scroll */
        .navbar-scrolled {
            background-color: var(--green) !important; /* Warna hijau saat scroll */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        /* Styling untuk dropdown profil */
        #profileDropdown a:hover, #profileDropdown button:hover {
            background-color: #f3f4f6; /* Tailwind gray-100 */
        }
    </style>
    @yield('head')
    @yield('head_extra') {{-- Untuk tambahan CSS khusus halaman --}}
</head>

<body class="overflow-x-hidden"> 
    @include('loader')

    @include('utils.header') {{-- Navbar akan di-include di sini --}}

    <main id="main-content"> {{-- Wrapper untuk konten utama agar bisa diberi padding-top --}}
        {{-- Hapus div dengan class bg-neutral text-white mt-8 dan mt-4 dari sini --}}
        @yield('content')
    </main>

    {{-- Footer bisa ditambahkan di sini jika ada --}}
    <footer class="bg-[var(--blue-dark)] text-white text-center p-6 mt-auto">
        <p>&copy; {{ date('Y') }} AI Mate - Find My Major. All rights reserved.</p>
    </footer>

    {{-- Scripts utama diletakkan sebelum penutup body --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script> AOS.init(); </script> {{-- Inisialisasi AOS --}}

    {{-- TW Elements --}}
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>

    {{-- GSAP, ScrollTrigger --}}
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

    {{-- SwiperJS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- Datatables --}}
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('navbar'); // Pastikan ID navbar di utils.header adalah 'navbar'
            const mainContent = document.getElementById('main-content');

            function adjustMainContentPadding() {
                if (navbar && mainContent) {
                    const navbarHeight = navbar.offsetHeight;
                    mainContent.style.paddingTop = navbarHeight + 'px';
                }
            }

            // Panggil saat load dan resize
            adjustMainContentPadding();
            window.addEventListener('resize', adjustMainContentPadding);

        });

        // Profile Dropdown Toggle (jika ada di utils.header)
        function toggleProfileDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            }
        }
        // Close dropdown if clicked outside
        window.addEventListener('click', function(event) {
          const dropdown = document.getElementById('profileDropdown');
          const profileButton = document.getElementById('profileButton'); // Pastikan tombol profil punya ID ini

          if (dropdown && !dropdown.classList.contains('hidden')) {
            if (profileButton && !profileButton.contains(event.target) && !dropdown.contains(event.target)) {
              dropdown.classList.add('hidden');
            }
          }
        });
    </script>

    @yield('scripts')
    @stack('scripts')
</body>
</html>
