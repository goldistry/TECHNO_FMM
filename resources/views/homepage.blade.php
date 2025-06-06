@extends('layout')

<<<<<<< HEAD
@section('title', 'Homepage')

@section('head')
<style>
    html {
        scroll-behavior: smooth;
    }

    @keyframes subtleBgJump {
        0% {
            background-position-y: center;
        }

        50% {
            background-position-y: calc(50% - 10px);
        }

        100% {
            background-position-y: center;
        }
    }

    .hero-bg {
        background-image: url('/images/HomeHeroBG-sm.png');
        /* Gambar untuk layar kecil */
        background-size: cover;
        /* Coba nilai persentase yang lebih spesifik atau 'center' */
        background-position-x: 70%;
        /* Contoh: Geser sedikit ke kiri dari ujung kanan, atau coba 'center' */
        background-position-y: center;
        animation: subtleBgJump 5s ease-in-out infinite;
    }

    /* Untuk layar tablet dan desktop, gunakan gambar dan posisi yang sama */
    @media (min-width: 768px) {

        /* Breakpoint md */
        .hero-bg {
            background-image: url('/images/HomeHeroBG-lg.png');
            /* Ganti dengan gambar LG untuk MD dan LG */
            background-position-x: center;
            /* Kembali ke posisi tengah untuk layar lebih lebar */
        }
    }

    /* Media query untuk LG tidak perlu lagi background-image jika sudah sama dengan MD */
    @media (min-width: 1024px) {

        /* Breakpoint lg */
        .hero-bg {
            background-position-x: center;
        }
    }

    .feature-card:hover {
        transform: translateY(-5px) scale(1.03);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .feature-card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    /* Styling for custom scrollbar for testimonials on mobile */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }

    /* Tambahan untuk warna placeholder dan focus input form Daftar Sekarang */
    .subscribe-input::placeholder {
        color: var(--blue-dark);
        opacity: 0.7;
        /* Make placeholder slightly transparent */
    }

    .subscribe-input:focus {
        outline: none;
        border-color: var(--green);
        /* Custom border color on focus */
        box-shadow: 0 0 0 3px rgba(127, 156, 83, 0.5);
        /* Custom ring on focus */
    }

    .swiper-container {
        width: 100%;
        height: auto;
        /* Tambahkan padding horizontal agar panah tidak terpotong, dan vertikal untuk pagination */
        padding: 20px 50px 40px;
        /* Top, Right/Left, Bottom */
        overflow: hidden;
        /* Penting untuk slider */
        position: relative;
        /* Pastikan panah dan pagination diposisikan relatif terhadap container ini */
    }

    .swiper-slide {
        height: auto;
        /* Pastikan tinggi slide menyesuaikan konten */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        text-align: left;
    }

    .swiper-pagination-bullet {
        background-color: #bbb;
        opacity: 1;
    }

    .swiper-pagination-bullet-active {
        background-color: var(--blue);
    }

    /* Penyesuaian untuk Panah Navigasi */
    .swiper-button-prev,
    .swiper-button-next {
        position: absolute;
        top: 50%;
        /* Pusatkan secara vertikal */
        transform: translateY(-50%);
        /* Penyesuaian agar benar-benar di tengah */
        width: 40px;
        /* Ukuran tombol */
        height: 40px;
        /* Ukuran tombol */
        margin-top: 0;
        /* Pastikan margin atas tidak mendorongnya */
        cursor: pointer;
        display: flex;
        /* Untuk memusatkan ikon di dalamnya */
        align-items: center;
        justify-content: center;
        color: var(--blue-dark);
        /* Warna ikon panah */
        z-index: 10;
        /* Pastikan di atas slide */
    }

    .swiper-button-prev {
        left: 0;
        /* Sesuaikan posisi dari kiri */
    }

    .swiper-button-next {
        right: 0;
        /* Sesuaikan posisi dari kanan */
    }

    /* Swiper juga menyuntikkan SVG untuk ikon panahnya, kadang perlu di override */
    .swiper-button-prev::after,
    .swiper-button-next::after {
        font-size: 1.5rem;
        /* Ukuran ikon panah */
        font-weight: bold;
    }

    /* Animasi untuk Border Input */
    @keyframes glowingBorder {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .animated-input-border {
        position: relative;
        padding: 2px;
        /* Tebal border animasi */
        border-radius: 12px;
        /* Sesuaikan dengan border-radius input */
        overflow: hidden;
        background: linear-gradient(270deg, var(--blue), var(--green), var(--primary), var(--blue-dark));
        background-size: 400% 400%;
        animation: glowingBorder 10s ease infinite;
    }

    .animated-input-border input {
        /* Pastikan input berada di dalam animated-input-border */
        border: none !important;
        /* Hapus border bawaan input */

        /* === INI BAGIAN PENTINGNYA: Tambahkan padding kembali ke input === */
        padding: 0.875rem 1.25rem;
        /* px-5 py-3.5 setara dengan 0.875rem (14px) dan 1.25rem (20px) */
        /* Anda bisa menyesuaikan nilai ini sesuai kebutuhan */

        height: 100%;
        /* Pastikan input mengisi tinggi div pembungkus */
        width: 100%;
        /* Pastikan input mengisi lebar div pembungkus */
        position: relative;
        z-index: 1;
        /* Pastikan input di atas background animasi */
        background-color: white;
        /* Berikan background putih agar input terlihat */

        /* Tetap tambahkan kembali kelas Tailwind yang relevan jika dihilangkan */
        /* Misalnya, rounded-lg jika Anda ingin sudut input juga bulat */
        border-radius: calc(12px - 2px);
        /* Sesuaikan dengan border-radius pembungkus - padding */
        /* 12px adalah rounded-lg dari div pembungkus, 2px adalah padding div pembungkus */
    }

    /* Optional: drop shadow untuk ikon di section ini */
    .register-section-animated svg {
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
    }
</style>
@endsection

@section('content')
{{-- Hero Section Utama --}}
<div class="text-center md:text-left mx-5 my-20 px-6 py-16 rounded-[32px] overflow-hidden shadow-xl hero-bg">
    <div class="bg-white/25 backdrop-blur-sm p-8 md:p-12 rounded-[24px] text-white max-w-3xl">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
            JURUSAN TEPAT <span class="text-[var(--primary)]">BERSAMA AI MATE</span>
        </h1>
        <p class="mt-6 text-lg md:text-xl text-white">
            Bukan sekadar platform, AI Mate adalah partner cerdas yang memandumu menemukan
            <strong>jurusan
            </strong>paling sesuai dengan
            <strong>dirimu seutuhnya</strong> – bakat, minat, kepribadian, kondisi finansial, hingga visi karir masa
            depanmu. Ucapkan selamat tinggal pada keraguan!
        </p>
        <div class="mt-10 flex flex-col sm:flex-row gap-4">
            <a href="#daftar"
                class="w-full sm:w-auto bg-[var(--blue)] text-white px-8 py-4 rounded-full text-lg font-semibold text-center hover:bg-[var(--blue-dark)] transition transform hover:scale-105 shadow-lg">
                Daftar sekarang!
            </a>
            {{-- Tombol "Lihat Cara Kerjanya" di komentar, bisa diaktifkan jika perlu --}}
        </div>
    </div>
</div>

{{-- Bagian "Mulai Petualangan Menemukan Jati Dirimu" --}}
<div id="how-it-works" class="my-16 md:my-24 px-6 max-w-7xl mx-auto text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-[var(--blue)] mb-4">Mulai Petualangan Menemukan Jati Dirimu</h2>
    <p class="text-lg text-gray-700 mb-12 max-w-2xl mx-auto">Hanya dalam beberapa langkah mudah, dapatkan rekomendasi
        jurusan yang dipersonalisasi khusus untukmu!</p>
    <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 feature-card">
            <div class="text-[var(--primary)] mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2 text-[var(--green)]">1. Isi Kuis Interaktif</h3>
            <p class="text-gray-700">Jawab serangkaian pertanyaan singkat, menyenangkan, namun mendalam tentang dirimu.
                Tidak ada jawaban benar atau salah, hanya kejujuranmu!</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-6 feature-card">
            <div class="text-[var(--primary)] mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2 text-[var(--green)]">2. Terima Rekomendasi AI Personal</h3>
            <p class="text-gray-700">Sistem AI canggih kami akan menganalisis jawabanmu dan memberikan rekomendasi
                jurusan serta potensi karir yang paling cocok untukmu.</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-6 feature-card">
            <div class="text-[var(--primary)] mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2 text-[var(--green)]">3. Eksplorasi & Rencanakan</h3>
            <p class="text-gray-700">Selami informasi detail jurusan, lihat simulasi karir, dan bergabunglah dengan
                komunitas untuk memantapkan pilihan masa depanmu.</p>
        </div>
    </div>
</div>

{{-- Bagian "Kenapa Find My Major Adalah Keputusan Terbaikmu?" --}}
<div class="bg-[var(--light-beige)] py-16 md:py-24">
    <div class="max-w-screen-xl mx-auto flex flex-col md:flex-row items-center px-6 gap-10">

        {{-- Left Section: Judul --}}
        <div class="md:w-1/2 text-left">
            <h2 class="text-3xl md:text-4xl font-bold text-[var(--blue)] leading-snug">
                Kenapa <span class="text-[var(--primary)]">Find My Major</span><br />
                Adalah Keputusan <span class="text-[var(--primary)]">Terbaikmu?</span>
            </h2>
        </div>

        {{-- Right Section: List Fitur --}}
        <div class="md:w-1/2 flex flex-col gap-6">
            {{-- Feature List Item --}}
            <div class="flex items-start gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mt-1 text-[var(--green)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75l2.25 2.25L15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-lg text-[var(--blue)] font-semibold">Analisis AI Mendalam yang Memahami Potensimu</p>
            </div>

            <div class="flex items-start gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mt-1 text-[var(--green)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75l2.25 2.25L15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-lg text-[var(--blue)] font-semibold">Informasi Terlengkap & Komunitas Suportif</p>
            </div>

            <div class="flex items-start gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mt-1 text-[var(--green)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75l2.25 2.25L15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-lg text-[var(--blue)] font-semibold">Simulasi Karir</p>
            </div>

            <div class="flex items-start gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mt-1 text-[var(--green)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75l2.25 2.25L15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-lg text-[var(--blue)] font-semibold">Panduan Personal & Mudah Digunakan</p>
            </div>

            <div class="flex items-start gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mt-1 text-[var(--green)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75l2.25 2.25L15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-lg text-[var(--blue)] font-semibold">Investasi Cerdas untuk Masa Depan Gemilang</p>
            </div>
        </div>
    </div>
</div>

{{-- Bagian "Info Jurusan & Komunitas" --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-6 py-16">
    {{-- Kiri: Eksplorasi Jurusan --}}
    <div class="bg-[var(--light-orange)] p-8 rounded-xl shadow-md">
        <div class="flex items-center mb-4">
            {{-- Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[var(--blue)] mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.34 6.582L12 21l-6.5-4.46a12.083 12.083 0 01.34-6.582L12 14z" />
            </svg>
            <h2 class="text-4xl font-bold text-[var(--blue-dark)]">Temukan Informasi Jurusan</h2>
        </div>
        <p class="text-lg text-[var(--beige)] mb-6">
            Bingung pilih jurusan? Cari informasi berbagai jurusan yang tersedia.
            <br /><strong>Yuk, mulai perjalanan karirmu sekarang!</strong>
        </p>
        <a href="{{Route('majors.index')}}" class="text-[var(--blue)] font-semibold hover:underline hover:scale-105 inline-block transition-transform duration-300 ease-in-out">Jelajahi Direktori Jurusan Kami →</a>
    </div>

    {{-- Kanan: Komunitas --}}
    <div class="bg-[var(--blue)] p-8 rounded-xl shadow-md">
        <div class="flex items-center mb-4">
            {{-- Icon Users --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[var(--light-orange)] mr-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            <h2 class="text-4xl font-bold text-[var(--light-orange)]">Lihat Apa Kata Komunitas</h2>
        </div>
        <p class="text-lg text-[var(--beige)] mb-6">
            Baca cerita jurusan dan tips dari teman-teman yang telah berkuliah.
            <br /><strong>Temukan inspirasi dan motivasi untuk kamu yang sedang di titik awal.</strong>
        </p>
        <a href="{{Route('testimonials.index')}}" class="text-[var(--light-orange)] font-semibold hover:underline hover:scale-105 inline-block transition-transform duration-300 ease-in-out">Gabung Komunitas Inspiratif Kami →</a>
    </div>
</div>

{{-- Bagian "Form Pendaftaran" (dengan animasi warna) --}}
<div id="daftar" class="py-20 md:py-28 text-white register-section-animated bg-[var(--light-green)]">
    <div class="max-w-5xl mx-auto px-6 text-center">

        {{-- Ikon --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-6 text-[var(--blue-dark)] drop-shadow-lg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
        </svg>

        {{-- Judul --}}
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold mb-6 leading-tight text-white drop-shadow-lg">
            Mulai konsultasi dengan <span class="text-[var(--blue-dark)]">AI Mate sekarang juga</span>
        </h2>

        {{-- Harga --}}
        <p class="text-lg md:text-2xl mb-4 font-semibold drop-shadow">
            Hanya
            <span class="text-3xl md:text-4xl line-through text-white/60 ml-2">Rp 35.000 </span>
            <span class="text-3xl md:text-5xl text-[var(--primary)] font-bold">Rp 29.900</span>
        </p>



        {{-- Form --}}
        <form action="#" method="POST" class="max-w-2xl mx-auto w-full">
            @csrf
            <div class="flex flex-col sm:flex-row gap-4 mb-6 ">
                {{-- Input Nama --}}
                <div class="animated-input-border w-full rounded-lg shadow-md"> {{-- Pembungkus animasi border --}}
                    <input type="text" name="name" placeholder="Nama Lengkap Anda"
                        class="subscribe-input px-5 py-3.5 rounded-lg text-gray-800 placeholder-[var(--blue-dark)] focus:ring-[var(--green)] focus:ring-2 transition"
                        required>
                </div>
                {{-- Input Email --}}
                <div class="animated-input-border w-full rounded-lg shadow-md"> {{-- Pembungkus animasi border --}}
                    <input type="email" name="email" placeholder="Alamat Email Anda"
                        class="subscribe-input px-5 py-3.5 rounded-lg text-gray-800 placeholder-[var(--blue-dark)] focus:ring-[var(--green)] focus:ring-2 transition"
                        required>
                </div>
            </div>
            <button type="submit"
                class="w-full sm:w-auto bg-[var(--blue-dark)] text-white px-8 py-3.5 rounded-full text-lg font-bold uppercase tracking-wide hover:bg-opacity-90 hover:scale-105 transition transform shadow-xl focus:outline-none focus:ring-4 focus:ring-white/50">
                Daftar Sekarang
            </button>

            {{-- Deskripsi - Kata-kata diubah --}}
            <p class="mt-2 text-md italic md:text-lg mb-8 max-w-3xl mx-auto text-white/90 drop-shadow">
                * Penawaran spesial berlaku terbatas, jangan sampai terlewat!
            </p>
        </form>
    </div>
</div>

{{-- Bagian "CTA Penutup" --}}
<div class="my-24 md:my-32 text-center px-6">
    <h2 class="text-3xl md:text-4xl font-bold text-[var(--blue)] leading-tight">
        Masa Depanmu Dimulai Hari Ini.<br class="sm:hidden"> Bukan Besok, Bukan Nanti.
    </h2>
    <p class="text-xl text-gray-700 mt-4 mb-8 max-w-2xl mx-auto">
        Bersama <span class="text-[var(--primary)] font-extrabold">Find My Major</span>, ambil kendali atas pilihanmu
        dan ukir kisah sukses yang kamu impikan!
    </p>
    <a href="{{ Route('chatbot.index') }}"
        class="inline-block bg-[var(--primary)] text-white px-10 py-4 rounded-full text-xl font-semibold hover:bg-opacity-90 hover:scale-105 transition transform shadow-xl">
        Temukan Jurusanmu Sekarang!
    </a>
</div>


{{-- Bagian Testimoni --}}
<div class="my-16 md:my-24 bg-[var(--light-beige)] py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-[var(--blue)] mb-4">
            Apa Kata Mereka yang Telah Menemukan Jalannya?
        </h2>
        <p class="text-lg text-gray-700 mb-12 max-w-2xl mx-auto">
            Ribuan siswa seperti kamu telah mengambil langkah pertama menuju masa depan yang lebih pasti bersama kami.
        </p>

        {{-- Swiper Container --}}
        <div class="swiper-container py-4"> {{-- py-4 adalah padding untuk atas/bawah. Padding horizonal dari CSS .swiper-container --}}
            <div class="swiper-wrapper">
                {{-- Testimoni 1 (dan seterusnya) --}}
                <div class="swiper-slide bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="text-3xl">👨🏽‍🎓</div>
                        <div>
                            <p class="font-semibold text-gray-800">Budi S.</p>
                            <p class="text-sm text-blue-600">@budi_siswa</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed text-justify">
                        Awalnya bingung banget mau masuk jurusan apa. Setelah pakai Find My Major dan konsultasi AI, jadi tercerahkan! Prosesnya cepat dan rekomendasinya sangat personal. Saya sangat merekomendasikan ini untuk semua siswa yang mencari arah!
                    </p>
                </div>

                {{-- Testimoni 2 --}}
                <div class="swiper-slide bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="text-3xl">👩🏻‍💼</div>
                        <div>
                            <p class="font-semibold text-gray-800">Citra A.</p>
                            <p class="text-sm text-blue-600">@citra_smk</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed text-justify">
                        Fitur simulasi karirnya keren banget! Saya bisa punya gambaran pekerjaan apa aja yang relevan sama jurusan impianku, lengkap dengan skill yang dibutuhkan. Ini bener-bener membuka mata saya tentang peluang di masa depan.
                    </p>
                </div>

                {{-- Testimoni 3 --}}
                <div class="swiper-slide bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="text-3xl">🎓</div>
                        <div>
                            <p class="font-semibold text-gray-800">Rian P.</p>
                            <p class="text-sm text-blue-600">@rian_mahasiwa</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed text-justify">
                        Informasi jurusannya lengkap dan up-to-date, dari prospek kerja sampai mata kuliah. Komunitasnya juga aktif banget, bisa tanya-tanya langsung sama kakak tingkat. Nggak salah pilih platform ini!
                    </p>
                </div>

                {{-- Testimoni 4 --}}
                <div class="swiper-slide bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="text-3xl">🧑🏻‍🔬</div>
                        <div>
                            <p class="font-semibold text-gray-800">Siska L.</p>
                            <p class="text-sm text-blue-600">@siska_labs</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed text-justify">
                        Tools simulasi AI-nya beneran beda! Berasa personal banget, beda dari tes minat bakat online lainnya. Bikin aku makin yakin ambil jurusan Bioteknologi karena sesuai dengan minat dan bakat asliku.
                    </p>
                </div>

                {{-- Testimoni 5 --}}
                <div class="swiper-slide bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="text-3xl">👨🏻‍💻</div>
                        <div>
                            <p class="font-semibold text-gray-800">Andre K.</p>
                            <p class="text-sm text-blue-600">@andre_code</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed text-justify">
                        Dulu ragu karena orang tua punya ekspektasi lain, tapi lewat Find My Major aku bisa ajak mereka diskusi dengan data dan akhirnya nemu solusi yang win-win! Sangat membantu dalam komunikasi keluarga.
                    </p>
                </div>

                {{-- Testimoni 6 --}}
                <div class="swiper-slide bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="text-3xl">🧕🏼</div>
                        <div>
                            <p class="font-semibold text-gray-800">Dewi F.</p>
                            <p class="text-sm text-blue-600">@dewi_future</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed text-justify">
                        Nggak nyangka bisa dapet insight sebanyak ini soal jurusan dan prospek kerja. Interface-nya juga ramah pengguna dan mudah dipahami, bahkan untuk pemula. Highly recommended!
                    </p>
                </div>

            </div>
            {{-- Pagination --}}
            <div class="swiper-pagination mt-8"></div>

            {{-- Navigation Arrows (Sudah diperbaiki posisinya di CSS) --}}
            <div class="swiper-button-prev bg-white rounded-full shadow-lg p-3 hidden md:flex items-center justify-center hover:bg-gray-100 transition-colors duration-200"></div>
            <div class="swiper-button-next bg-white rounded-full shadow-lg p-3 hidden md:flex items-center justify-center hover:bg-gray-100 transition-colors duration-200"></div>
        </div>
    </div>
</div>

{{-- Footer --}}
<footer class="bg-[var(--blue-dark)] text-white py-12 mt-20">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
        {{-- Logo & Tagline --}}
        <div>
            {{-- Pastikan path logo sudah benar. Jika 'logo.png' ada di public/, maka cukup 'logo.png' --}}
            <img class="h-20" src="{{ asset('logo.png') }}" alt="logo Find My Major">
            <p class="text-sm text-gray-300">Membantumu menemukan jurusan terbaik dengan dukungan teknologi AI dan komunitas yang suportif.</p>
        </div>

        {{-- Navigasi --}}
        <div>
            <h3 class="text-lg font-semibold mb-3">Navigasi</h3>
            <ul class="space-y-2 text-sm text-gray-300">
                <li><a href="{{ route('homepage') }}" class="hover:underline">Home</a></li>
                <li><a href="#how-it-works" class="hover:underline">Informasi Jurusan</a></li>
                {{-- Pastikan route ini ada atau ganti dengan link statis jika halaman komunitas belum ada --}}
                <li><a href="{{ route('majors.index') }}" class="hover:underline">Grup Komunitas</a></li>
                <li><a href="#daftar" class="hover:underline">AI Mate</a></li>
                <li><a href="#daftar" class="hover:underline">Daftar Sekarang</a></li>
            </ul>
        </div>

        {{-- Sosial Media --}}
        <div>
            <h3 class="text-lg font-semibold mb-3">Terhubung</h3>
            <div class="flex gap-4">
                <a href="#" class="text-gray-300 hover:text-white" aria-label="Instagram">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm0 2h10c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3 3-3zm5 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-.25a.75.75 0 110 1.5.75.75 0 010-1.5z" />
                    </svg>
                </a>
                <a href="#" class="text-gray-300 hover:text-white" aria-label="Twitter">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53A4.48 4.48 0 0022.43.36a9.14 9.14 0 01-2.88 1.1A4.52 4.52 0 0016.11 0c-2.63 0-4.77 2.14-4.77 4.77 0 .37.04.72.11 1.06-3.97-.2-7.49-2.1-9.85-4.99a4.77 4.77 0 00-.65 2.4c0 1.65.84 3.1 2.12 3.95a4.45 4.45 0 01-2.16-.6v.06c0 2.3 1.64 4.22 3.82 4.66-.4.11-.82.17-1.26.17-.31 0-.6-.03-.89-.08.6 1.86 2.34 3.2 4.4 3.23A9.07 9.07 0 010 19.54a12.8 12.8 0 006.94 2.03c8.32 0 12.88-6.9 12.88-12.88 0-.2 0-.41-.01-.61A9.22 9.22 0 0023 3z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="mt-10 border-t border-[var(--light-green)] pt-6 text-center text-sm text-[var(--beige)]">
        &copy; {{ date('Y') }} Find My Major. All rights reserved.
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.swiper-container', {
            slidesPerView: 1, // Default: hanya 1 slide terlihat penuh di mobile
            spaceBetween: 20, // Jarak antar slide
            loop: true, // Untuk looping otomatis
            autoplay: { // Konfigurasi autoplay
                delay: 5000, // Durasi setiap slide (5 detik)
                disableOnInteraction: false, // Lanjut autoplay setelah interaksi user
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: { // AKTIFKAN MODUL NAVIGASI DAN TUNJUK KE ELEMEN PANAH
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                // Ketika lebar layar >= 768px
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                // Ketika lebar layar >= 1024px
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
        });
    });
</script>

@endsection
=======
@section('title', 'Homepage - Temukan Jurusan Impianmu dengan AI Mate') {{-- SEO Friendly Title --}}

@section('head')
    <style>
        html {
            scroll-behavior: smooth;
        }

        @keyframes subtleBgJump {
            0% {
                background-position-y: center;
                /* Atau 50% */
            }

            50% {
                background-position-y: calc(50% - 10px);
                /* Background bergerak sedikit ke atas */
            }

            100% {
                background-position-y: center;
                /* Kembali ke posisi semula */
            }
        }

        .hero-bg {
            background-image: url('/images/HomeHeroBG-sm.png');
            background-size: cover;
            background-position-x: center;
            /* Jaga posisi horizontal tetap di tengah */
            /* Terapkan animasi pada background-position-y */
            animation: subtleBgJump 5s ease-in-out infinite;
            /* Durasi 5 detik, looping tak terbatas */
        }

        @media (min-width: 768px) {
            .hero-bg {
                background-image: url('/images/HomeHeroBG-md.png');
            }
        }

        @media (min-width: 1024px) {
            .hero-bg {
                background-image: url('/images/HomeHeroBG-lg.png');
            }
        }

        .feature-card:hover {
            transform: translateY(-5px) scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .feature-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        /* Styling tambahan untuk bagian subscribe jika diperlukan, tapi Tailwind akan menangani sebagian besar */
        .subscribe-section {
            /* Contoh: background-image: linear-gradient(to right, var(--blue), var(--primary)); */
            /* Jika ingin menggunakan variabel warna CSS Anda untuk gradient */
        }

        .subscribe-input::placeholder {
            color: #9ca3af;
            /* Atur warna placeholder jika default kurang kontras di background gelap/terang */
        }

        .subscribe-input:focus {
            /* box-shadow: 0 0 0 2px var(--green); /* Contoh custom focus ring */
            /* border-color: var(--green); */
        }
    </style>
@endsection

@section('content')
    {{-- ... Bagian Hero dan konten lainnya ... --}}
    <div class="text-center md:text-left mx-5 my-20 px-6 py-16 rounded-[32px] overflow-hidden shadow-xl hero-bg">
        <div class="bg-white/25 backdrop-blur-sm p-8 md:p-12 rounded-[24px] text-white max-w-3xl">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                Wujudkan Karir Impian <span class="text-[var(--primary)]">Bersama AI Mate.</span>
            </h1>
            <p class="mt-6 text-lg md:text-xl text-white">
                Bukan sekadar platform, AI Mate adalah partner cerdas yang memandumu menemukan <strong>jurusan
                </strong>paling sesuai dengan
                <strong>dirimu seutuhnya</strong> – bakat, minat, kepribadian, kondisi finansial, hingga visi karir masa
                depanmu. Ucapkan selamat tinggal pada keraguan!
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="#daftar"
                    class="w-full sm:w-auto bg-[var(--blue)] text-white px-8 py-4 rounded-full text-lg font-semibold text-center hover:bg-[var(--blue-dark)] transition transform hover:scale-105 shadow-lg">
                    Daftar sekarang!
                </a>
                {{-- <a href="#how-it-works"
                    class="group w-full sm:w-auto border-2 border-[var(--blue)] text-[var(--blue)] bg-white/80 hover:bg-white px-8 py-4 rounded-full text-lg font-semibold text-center transition inline-flex items-center justify-center shadow-md">
                    Lihat Cara Kerjanya
                    <span class="ml-2 transform transition-transform duration-300 group-hover:translate-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </span>
                </a> --}}
            </div>
        </div>
    </div>

    <div id="how-it-works" class="my-16 md:my-24 px-6 max-w-7xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-[var(--blue)] mb-4">Mulai Petualangan Menemukan Jati Dirimu</h2>
        <p class="text-lg text-gray-700 mb-12 max-w-2xl mx-auto">Hanya dalam beberapa langkah mudah, dapatkan rekomendasi
            jurusan yang dipersonalisasi khusus untukmu!</p>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 feature-card">
                <div class="text-[var(--primary)] mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-[var(--green)]">1. Isi Kuis Interaktif</h3>
                <p class="text-gray-700">Jawab serangkaian pertanyaan singkat, menyenangkan, namun mendalam tentang dirimu.
                    Tidak ada jawaban benar atau salah, hanya kejujuranmu!</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 feature-card">
                <div class="text-[var(--primary)] mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-[var(--green)]">2. Terima Rekomendasi AI Personal</h3>
                <p class="text-gray-700">Sistem AI canggih kami akan menganalisis jawabanmu dan memberikan rekomendasi
                    jurusan serta potensi karir yang paling cocok untukmu.</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 feature-card">
                <div class="text-[var(--primary)] mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-[var(--green)]">3. Eksplorasi & Rencanakan</h3>
                <p class="text-gray-700">Selami informasi detail jurusan, lihat simulasi karir, dan bergabunglah dengan
                    komunitas untuk memantapkan pilihan masa depanmu.</p>
            </div>
        </div>
    </div>

    <div class="my-16 md:my-24 px-6 max-w-7xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-[var(--blue)]">
            Kenapa <span class="text-[var(--primary)] font-extrabold">Find My Major</span> Adalah Keputusan <span
                class="text-[var(--primary)]">Terbaikmu?</span>
        </h2>
        <div class="grid md:grid-cols-6 gap-8 text-left">
            <div class="col-span-2 bg-white rounded-2xl shadow-xl p-8 feature-card">
                <div class="mb-3"> {{-- Anda bisa membiarkan text-[var(--green)] di sini jika ada teks lain, atau menghapusnya jika hanya untuk SVG --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[var(--green)]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h4 class="text-xl font-semibold mb-3 text-[var(--blue)]">Buka Potensi Tersembunyimu dengan Analisis AI
                    Mendalam</h4>
                <p class="text-gray-700 text-md">AI kami bukan sekadar mencocokkan. Ia menggali jauh ke dalam bakat unikmu,
                    minat terpendam, tipe kepribadian, bahkan mempertimbangkan aspirasi finansial dan tren karir masa depan.
                    Hasilnya? Rekomendasi jurusan yang <strong>benar-benar kamu banget!</strong></p>
            </div>
            <div class="col-span-2 bg-white rounded-2xl shadow-xl p-8 feature-card">
                <div class="text-[var(--green)] mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h4 class="text-xl font-semibold mb-3 text-[var(--blue)]">Selami Dunia Perkuliahan dengan Informasi
                    Terlengkap & Komunitas Suportif</h4>
                <p class="text-gray-700 text-md">Jangan hanya berandai-andai! Dapatkan akses ke database jurusan terlengkap,
                    ulasan mahasiswa, prospek karir terkini, hingga terhubung dengan komunitas mahasiswa dan alumni yang
                    siap berbagi pengalaman nyata.</p>
            </div>
            <div class="col-span-2 bg-white rounded-2xl shadow-xl p-8 feature-card">
                <div class="text-[var(--green)] mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h4 class="text-xl font-semibold mb-3 text-[var(--blue)]">Visualisasikan Kesuksesanmu dengan Simulasi Karir
                    Interaktif</h4>
                <p class="text-gray-700 text-md">Penasaran seperti apa jalur karir dari jurusan pilihanmu? Fitur simulasi
                    kami membantumu memetakan langkah, memahami tantangan, dan melihat peluang di dunia kerja nyata. Ini
                    bukan ramalan, tapi proyeksi cerdas untuk masa depanmu!</p>
            </div>
            <div class=" bg-white rounded-2xl shadow-xl p-8 feature-card md:col-span-3">
                <div class="text-[var(--green)] mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7 2a1 1 0 00-.707 1.707L7.586 5H4a1 1 0 000 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414l-3-3A1 1 0 007 2zm9 4a1 1 0 100-2h-3.586l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3A1 1 0 0013 9h3.586l-1.293-1.293A1 1 0 0016 6zm-7 8a1 1 0 00.707-1.707L7.414 13H11a1 1 0 100-2H7.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3A1 1 0 009 16z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <h4 class="text-xl font-semibold mb-3 text-[var(--blue)]">Panduan Personal & Mudah Digunakan</h4>
                <p class="text-gray-700 text-md">Kami percaya setiap siswa unik. Nikmati antarmuka intuitif, proses yang
                    menyenangkan, dan panduan langkah demi langkah yang dirancang khusus untuk membantumu tanpa ribet.</p>
            </div>
            <div class=" bg-white rounded-2xl shadow-xl p-8 feature-card md:col-span-3">
                <div class="text-[var(--green)] mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                    </svg>
                </div>
                <h4 class="text-xl font-semibold mb-3 text-[var(--blue)]">Investasi Cerdas untuk Masa Depan Gemilang</h4>
                <p class="text-gray-700 text-md">Memilih jurusan yang tepat adalah investasi paling berharga. Dengan Find
                    My Major, kamu tidak hanya menghemat waktu dan potensi biaya kuliah yang salah, tapi juga membangun
                    fondasi kuat untuk karir yang memuaskan dan sukses.</p>
            </div>
        </div>
    </div>

    <div class="my-16 md:my-24 bg-[var(--light-beige)] py-16 md:py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-[var(--blue)] mb-4">Apa Kata Mereka yang Telah Menemukan
                Jalannya?</h2>
            <p class="text-lg text-gray-700 mb-12 max-w-2xl mx-auto">Ribuan siswa seperti kamu telah mengambil langkah
                pertama menuju masa depan yang lebih pasti bersama kami.</p>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <p class="text-gray-700 italic mb-4">"Awalnya bingung banget mau masuk jurusan apa. Setelah pakai Find
                        My Major dan konsultasi AI, jadi tercerahkan! Sekarang aku mantap pilih Teknik Informatika."</p>
                    <p class="font-semibold text-[var(--green)]">- Budi S., Siswa SMA</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <p class="text-gray-700 italic mb-4">"Fitur simulasi karirnya keren banget! Jadi bisa punya gambaran
                        pekerjaan apa aja yang relevan sama jurusan impianku. Recommended!"</p>
                    <p class="font-semibold text-[var(--green)]">- Citra A., Siswi SMK</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <p class="text-gray-700 italic mb-4">"Informasi jurusannya lengkap dan up-to-date. Komunitasnya juga
                        aktif, bisa tanya-tanya langsung sama kakak tingkat. Sangat membantu!"</p>
                    <p class="font-semibold text-[var(--green)]">- Rian P., Calon Mahasiswa</p>
                </div>
            </div>
        </div>
    </div>

    <div class="min-h-[400px] px-10 py-16 flex flex-col md:items-center justify-center gap-10 bg-gray-50">
        {{-- <div class="md:w-1/2"> --}}
            <h2 class="text-center text-3xl md:text-4xl font-bold leading-tight text-[var(--blue)]">
                Setiap Pertanyaanmu tentang Jurusan,
                <br>
                <span class="text-[var(--primary)] text-4xl md:text-5xl font-extrabold">Terjawab di Sini!</span>
            </h2>
            <p class="text-gray-800 max-w-xl text-md mt-2 text-center">
                Jangan biarkan keraguan menghantuimu. Dengan Find My Major, informasi detail, akurat, dan relevan tentang
                ratusan jurusan ada di ujung jarimu. Dari kurikulum, biaya, prospek karir, hingga testimoni alumni, kami
                hadirkan semua untukmu!
            </p>
        {{-- </div> --}}
        {{-- <div class="md:w-1/2 text-center md:text-right mt-8 md:mt-0"> --}}
            {{-- <a href="{{ route('majors.index') }}"
                class="inline-block px-10 py-4 rounded-full border-2 border-[var(--green)] text-[var(--green)] font-semibold hover:bg-[var(--green)] hover:text-white hover:shadow-lg transition duration-300 transform hover:scale-105 text-lg">
                Jelajahi Direktori Jurusan Kami!
            </a> --}}
        {{-- </div> --}}
    </div>

    <div id="daftar"
        class="py-16 md:py-24 bg-gradient-to-br from-[var(--blue)] to-[var(--primary)] text-white subscribe-section">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-6 text-[var(--green)]" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
            </svg>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold mb-6 leading-tight text-[var(--primary)]">
                Mulai konsultasi dengan <span class="text-[var(--green)]">AI Mate sekarang juga</span>
            </h2>
            <p class="text-xl md:text-2xl mb-6 font-semibold text-[var(--primary)]">
                Hanya
                <span class="text-4xl md:text-5xl line-through text-gray-300 ml-2">Rp 35.000 </span><span
                    class="text-4xl md:text-5xl text-[var(--green)] font-bold">Rp 21.000</span>
            </p>
            <p class="text-lg md:text-xl mb-8 max-w-3xl mx-auto text-gray-700">
                Spesial untuk <strong class="text-gray-800">100 pendaftar pertama!</strong> Dapatkan akses insight
                eksklusif pemilihan jurusan, update fitur AI Mate terbaru, webinar gratis, dan semua manfaat Starter Pack
                premium kami. Hemat 40%! Kesempatan terbatas!
            </p>
            <form action="{{-- route('subscribe.store') --}}" method="POST" class="max-w-xl mx-auto">
                @csrf {{-- Laravel CSRF Protection --}}
                <div class="flex flex-col sm:flex-row gap-4 mb-6">
                    <input type="text" name="name" placeholder="Nama Lengkap Anda"
                        class="subscribe-input w-full px-5 py-3.5 rounded-lg border-2 border-[var(--green)] text-gray-800 placeholder-gray-500 focus:border-[var(--green)] focus:ring-2 focus:ring-[var(--green)] focus:ring-opacity-50 transition duration-300 shadow-lg "
                        required>
                    <input type="email" name="email" placeholder="Alamat Email Anda"
                        class="subscribe-input w-full px-5 py-3.5 rounded-lg border-2 border-[var(--green)] text-gray-800 placeholder-gray-500 focus:border-[var(--green)] focus:ring-2 focus:ring-[var(--green)] focus:ring-opacity-50 transition duration-300 shadow-lg "
                        required>
                </div>
                <button type="submit"
                    class="w-full sm:w-auto bg-[var(--green)] text-white px-8 py-3.5 rounded-full text-lg font-bold uppercase tracking-wider hover:bg-opacity-90 transition transform hover:scale-105 shadow-lg focus:outline-none focus:ring-4 focus:ring-[var(--green)] focus:ring-opacity-50">
                    Daftar!
                </button>
            </form>
            <p class="mt-8 text-sm text-gray-600 opacity-90">
                *Penawaran Starter Pack seharga Rp 21.000 (dari harga normal Rp 35.000) hanya berlaku untuk 100 pengguna
                pertama yang mendaftar dan kemudian melakukan pembelian paket.
                {{-- <br class="hidden sm:block">Manfaatkan kesempatan ini untuk masa depan karir yang lebih cerah! --}}
            </p>
        </div>
    </div>
    <div class="my-20 md:my-28 text-center px-6">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight">
            Masa Depanmu Dimulai Hari Ini. <br class="sm:hidden"> Bukan Besok, Bukan Nanti.
        </h2>
        <p class="text-xl text-gray-700 mt-4 mb-8 max-w-2xl mx-auto">
            Bersama <span class="text-[var(--primary)] font-extrabold">Find My Major</span>, ambil kendali atas pilihanmu
            dan ukir kisah sukses yang kamu impikan!
        </p>
        <a href="{{ Route('ai.mate.index') }}"
            class="bg-[var(--primary)] text-white px-10 py-4 rounded-full text-xl font-semibold hover:bg-opacity-80 transition transform hover:scale-105 shadow-xl">
            Temukan Jurusanmu Sekarang!
        </a>
    </div>
@endsection
>>>>>>> 0a7de8735cd3d3a6bef56ec649323bcd3b01ae43
