@extends('layout')

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
