@extends('layout')

@section('title', 'Info Jurusan')

@section('content')
  <div class="py-12 px-4 text-white text-center rounded-bl-[4rem] rounded-br-[4rem]" style="background-color: var(--green);">
    <h1 class="text-3xl md:text-4xl font-bold mt-2">
      Temukan Jurusan yang Paling Cocok Untukmu <br>
      <span style="color: var(--primary);">bersama Find My Major</span>
    </h1>

    <!-- Search Bar -->
    <div class="mt-8 max-w-3xl mx-auto bg-white rounded-full shadow-md flex items-center overflow-hidden">
      <input 
        type="text" 
        placeholder="Cari nama jurusan..." 
        class="flex-1 px-6 py-3 rounded-l-full text-gray-700 focus:outline-none" 
      />
      <button 
        class="px-6 py-3 text-white font-semibold rounded-r-full hover:opacity-90"
        style="background: linear-gradient(to right, var(--blue), var(--blue-dark));"
      >
        Cari
      </button>
    </div>
  </div>

  <!-- Daftar Jurusan -->
  <div class="max-w-6xl mx-auto my-12 px-4">
    <h3 class="text-xl font-bold mb-4" style="color: var(--green);">Daftar Jurusan</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @php
        $majors = [
          [
            'title' => 'Teknik Informatika',
            'img' => 'https://universitasmulia.ac.id/wp-content/uploads/2021/05/ilustrasi-informatics-1030x579.jpg',
            'desc' => 'Jurusan yang mempelajari tentang software, algoritma, dan pemrograman.'
          ],
          [
            'title' => 'Desain Komunikasi Visual',
            'img' => 'https://dkv.fkip.um-surabaya.ac.id/assets/img/news_img/11558e19-a1df-11ed-a993-000c29cc32a6_beritadkv3.png',
            'desc' => 'Jurusan kreatif yang fokus pada visual branding, ilustrasi, dan multimedia.'
          ],
          [
            'title' => 'Manajemen Bisnis',
            'img' => 'https://mvnu.edu/content/uploads/2024/01/mvnu-online-difference-between-admin-and-business-management.jpeg.webp',
            'desc' => 'Belajar strategi, pemasaran, hingga keuangan untuk mengelola bisnis.'
          ],
          [
            'title' => 'Psikologi',
            'img' => 'https://d1vbn70lmn1nqe.cloudfront.net/prod/wp-content/uploads/2022/03/09043035/X-Rekomendasi-Psikolog-Klinis-Berpengalaman-di-Yogyakarta.jpg',
            'desc' => 'Mempelajari perilaku manusia, emosi, dan kesehatan mental individu maupun kelompok.'
          ],
          [
            'title' => 'Arsitektur',
            'img' => 'https://www.linovhr.com/wp-content/uploads/2023/03/arsitek-adalah.webp',
            'desc' => 'Jurusan yang menggabungkan seni, sains, dan teknik untuk merancang bangunan dan ruang.'
          ],
          [
            'title' => 'Ilmu Komunikasi',
            'img' => 'https://imageio.forbes.com/specials-images/imageserve/6549748a691e87179cfe1c03/Shot-of-a-group-of-diverse-businesspeople-sitting-together-in-a-meeting/960x0.jpg?height=474&width=711&fit=bounds',
            'desc' => 'Fokus pada strategi komunikasi, media, periklanan, dan hubungan masyarakat.'
          ]
        ];
      @endphp

      @foreach ($majors as $major)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-transform hover:scale-[1.02]">
          <div class="relative">
            <img src="{{ $major['img'] }}" alt="{{ $major['title'] }}" class="w-full h-48 object-cover" />
            <button class="absolute top-2 right-2 bg-white rounded-full p-2 shadow hover:bg-gray-100">❤️</button>
          </div>
          <div class="p-4">
            <h4 class="text-lg font-semibold mb-1">{{ $major['title'] }}</h4>
            <p class="text-sm text-gray-600">{{ $major['desc'] }}</p>
            <button 
              class="mt-4 font-semibold hover:underline"
              style="color: var(--blue);"
            >
              Selengkapnya →
            </button>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
