<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-[#f8f1e5] font-sans">
<!-- Hero Section (who are you & what do you do) -->
  <div class=" text-center md:text-left m-5 px-6 py-16 rounded-[32px] overflow-hidden shadow-md bg-[url('images/HomeHeroBG-sm.png')] md:bg-[url('images/HomeHeroBG-md.png')] lg:bg-[url('images/HomeHeroBG-lg.png')]  bg-cover bg-center">
    <div class="bg-white/30 p-8 md:p-12 rounded-[24px] text-white max-w-3xl">
      <h2 class="text-4xl md:text-5xl font-bold">
        Jurusan Tepat <br>
        <span class="text-[#fd7205]">Bersama AI Mate</span>
      </h2>
      <p class="mt-6 text-lg text-white">
        Platform pintar untuk membantu siswa SMA/SMK menentukan jurusan berdasarkan bakat/minat, kepribadian, financial, hingga masa depan karier.
      </p>
      <div class="mt-8 flex flex-col sm:flex-row gap-4">
        <!-- Ref chatbot -->
        <a href="#" class="w-full sm:w-auto bg-[#0066ff] text-white px-6 py-3 rounded-full text-lg font-semibold text-center hover:bg-[#0056c9] transition">Coba Sekarang</a>
        <!-- Ref QnA -->
        <a href="#" class="group w-full sm:w-auto border border-[#0066ff] text-[#0066ff] px-6 py-3 rounded-full text-lg font-semibold text-center hover:bg-white transition inline-flex items-center justify-center">
          Tanya lebih lanjut
          <span class="ml-2 transform transition-transform duration-300 group-hover:translate-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
          </span>
        </a>
      </div>
    </div>
  </div>

  <!-- Why pilih my find journey  -->
  <div class="my-12 px-6 max-w-7xl mx-auto">
    <h3 class="text-3xl font-bold text-center mb-8 text-[#0066ff]">Kenapa Harus <span class="text-[#fd7205] font-extrabold">Find My Major? </h3>
    <div class="grid md:grid-cols-3 gap-8 text-center">
      <div class="bg-white rounded-2xl shadow-md p-6 transition duration-300 hover:scale-105">
        <h4 class="text-xl font-semibold mb-2 text-[#7f9c53]">Analisis AI Cerdas</h4>
        <p class="text-gray-700">Dapatkan rekomendasi jurusan berdasarkan analisis berbagai kategori mulai dari bakat/minat, kepribadian, financial, hingga masa depan karier.</p>
      </div>
      <div class="bg-white rounded-2xl shadow-md p-6 transition duration-300 hover:scale-105">
        <h4 class="text-lg font-semibold mb-2 text-[#7f9c53]">Informasi Jurusan dan Komunitas Aktif</h4>
        <p class="text-gray-700">Temukan berbagai informasi seputar jurusan baik dari berita aktual maupun testimoni komunitas.</p>
      </div>
      <div class="bg-white rounded-2xl shadow-md p-6 transition duration-300 hover:scale-105">
        <h4 class="text-xl font-semibold mb-2 text-[#7f9c53]">Simulasi Karir</h4>
        <p class="text-gray-700">Dapatkan simulasi karir sesuai dengan rekomendasi jurusan.</p>
      </div>
    </div>
  </div>

  <!-- Info lbh lanjut untuk jurusan -->
  <div class="min-h-[400px] px-10 py-16 flex flex-col md:flex-row md:items-center justify-between gap-8 bg-[#fffdf9]">
    <h2 class="text-2xl font-bold leading-tight text-[#0066ff]">
      Penasaran dengan jurusan?
      <br>
      <span class="text-[#fd7205] text-4xl font-extrabold">Kami siap membantu</span>
    </h2>
  

    <p class="text-gray-700 max-w-xl text-md">
      Dapatkan detail informasi seputar jurusanmu dengan mudah dan cepat melalui Find My Major!
    </p>
    

    <!-- Ref info jurusan -->
    <a href="{{route('infoJurusan')}}" class="text-center inline-block px-6 py-3 rounded-full border border-[#7f9c53] text-[#7f9c53] font-semibold hover:bg-[#f8f1e5] hover:shadow-md transition duration-300">
      Lihat Info Jurusan
    </a>
  </div>

  <!-- Motto -->
  <div class="mt-5 italic min-h-[200px] flex items-center justify-center">
    <p class="text-2xl font-bold">
        Let’s Light Up Your Future With <span class="text-[#fd7205] font-extrabold">Find My Major</span>
    </p>
</div>


   

</body>
</html>
