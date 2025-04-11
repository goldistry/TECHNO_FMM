<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Info Jurusan - Find My Major</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-[#f8f1e5] font-sans">
  <!-- Hero Section -->
  <div class="bg-[#a8c778] py-12 px-4 text-white text-center rounded-bl-4xl rounded-br-4xl">
    <h1 class="text-3xl md:text-4xl font-bold mt-2">Informasi Jurusan Tepat Bersama <br><span class="text-[#fd7205]">Find My Major</span></h1>

    <!-- Search Bar -->
    <div class="mt-8 max-w-3xl mx-auto bg-white rounded-full shadow-md flex items-center overflow-hidden">
      <input type="text" placeholder="cari nama jurusan" class="flex-1 px-6 py-3 rounded-l-full text-gray-700 focus:outline-none" />
      <button class="bg-gradient-to-r from-[#0066ff] to-[#0056c9] px-6 py-3 text-white font-semibold rounded-r-full hover:opacity-90">Cari</button>
    </div>
  </div>

  <!-- Daftar Jurusan -->
  <div class="max-w-6xl mx-auto my-12 px-4 ">
    <h3 class="text-xl font-bold text-[#7f9c53] mb-4">Daftar Jurusan</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      <!-- Card Jurusan -->
      <!-- Infor -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-transform hover:scale-[1.02]">
        <div class="relative">
          <img src="https://universitasmulia.ac.id/wp-content/uploads/2021/05/ilustrasi-informatics-1030x579.jpg" alt="Teknik Informatika" class="w-full h-48 object-cover" />
          <button class="absolute top-2 right-2 bg-white rounded-full p-2 shadow hover:bg-gray-100">❤️</button>
        </div>
        <div class="p-4">
          <h4 class="text-lg font-semibold mb-1">Teknik Informatika</h4>
          <p class="text-sm text-gray-600">Jurusan yang mempelajari tentang software, algoritma, dan pemrograman.</p>
          <button class="mt-4 text-[#0066ff] font-semibold hover:underline">Selengkapnya →</button>
        </div>
      </div>

      <!-- DKV -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-transform hover:scale-[1.02]">
        <div class="relative">
          <img src="https://dkv.fkip.um-surabaya.ac.id/assets/img/news_img/11558e19-a1df-11ed-a993-000c29cc32a6_beritadkv3.png" alt="DKV" class="w-full h-48 object-cover" />
          <button class="absolute top-2 right-2 bg-white rounded-full p-2 shadow hover:bg-gray-100">❤️</button>
        </div>
        <div class="p-4">
          <h4 class="text-lg font-semibold mb-1">Desain Komunikasi Visual</h4>
          <p class="text-sm text-gray-600">Jurusan kreatif yang fokus pada visual branding, ilustrasi, dan multimedia.</p>
          <button class="mt-4 text-[#0066ff] font-semibold hover:underline">Selengkapnya →</button>
        </div>
      </div>

      <!-- Manbis -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-transform hover:scale-[1.02]">
        <div class="relative">
          <img src="https://mvnu.edu/content/uploads/2024/01/mvnu-online-difference-between-admin-and-business-management.jpeg.webp" alt="Manajemen" class="w-full h-48 object-cover" />
          <button class="absolute top-2 right-2 bg-white rounded-full p-2 shadow hover:bg-gray-100">❤️</button>
        </div>
        <div class="p-4">
          <h4 class="text-lg font-semibold mb-1">Manajemen Bisnis</h4>
          <p class="text-sm text-gray-600">Belajar strategi, pemasaran, hingga keuangan untuk mengelola bisnis.</p>
          <button class="mt-4 text-[#0066ff] font-semibold hover:underline">Selengkapnya →</button>
        </div>
      </div>
    
      <!-- Psikolog -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-transform hover:scale-[1.02]">
        <div class="relative">
          <img src="https://d1vbn70lmn1nqe.cloudfront.net/prod/wp-content/uploads/2022/03/09043035/X-Rekomendasi-Psikolog-Klinis-Berpengalaman-di-Yogyakarta.jpg" alt="Psikologi" class="w-full h-48 object-cover" />
          <button class="absolute top-2 right-2 bg-white rounded-full p-2 shadow hover:bg-gray-100">❤️</button>
        </div>
        <div class="p-4">
          <h4 class="text-lg font-semibold mb-1">Psikologi</h4>
          <p class="text-sm text-gray-600">Mempelajari perilaku manusia, emosi, dan kesehatan mental individu maupun kelompok.</p>
          <button class="mt-4 text-[#0066ff] font-semibold hover:underline">Selengkapnya →</button>
        </div>
      </div>

      <!-- Arsitek -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-transform hover:scale-[1.02]">
        <div class="relative">
          <img src="https://www.linovhr.com/wp-content/uploads/2023/03/arsitek-adalah.webp" alt="Arsitektur" class="w-full h-48 object-cover" />
          <button class="absolute top-2 right-2 bg-white rounded-full p-2 shadow hover:bg-gray-100">❤️</button>
        </div>
        <div class="p-4">
          <h4 class="text-lg font-semibold mb-1">Arsitektur</h4>
          <p class="text-sm text-gray-600">Jurusan yang menggabungkan seni, sains, dan teknik untuk merancang bangunan dan ruang.</p>
          <button class="mt-4 text-[#0066ff] font-semibold hover:underline">Selengkapnya →</button>
        </div>
      </div>

      <!-- Ilkom -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-transform hover:scale-[1.02]">
        <div class="relative">
          <img src="https://imageio.forbes.com/specials-images/imageserve/6549748a691e87179cfe1c03/Shot-of-a-group-of-diverse-businesspeople-sitting-together-in-a-meeting/960x0.jpg?height=474&width=711&fit=bounds" alt="Ilmu Komunikasi" class="w-full h-48 object-cover" />
          <button class="absolute top-2 right-2 bg-white rounded-full p-2 shadow hover:bg-gray-100">❤️</button>
        </div>
        <div class="p-4">
          <h4 class="text-lg font-semibold mb-1">Ilmu Komunikasi</h4>
          <p class="text-sm text-gray-600">Fokus pada strategi komunikasi, media, periklanan, dan hubungan masyarakat.</p>
          <button class="mt-4 text-[#0066ff] font-semibold hover:underline">Selengkapnya →</button>
        </div>
      </div>
    </div>
</div>

</body>
</html>
