<style>
  /* Loader Overlay */
  #loader-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(248, 241, 229, 0.8); /* Latar belakang lembut seperti halaman */
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999; /* Pastikan di atas konten lain */
      transition: opacity 0.5s ease-out;
  }

  .loader-spinner {
      border-radius: 50%;
      width: 60px;
      height: 60px;
      border: 6px solid #a8c778; /* Hijau muda sebagai border utama */
      border-top-color: #fd7205; /* Oranye sebagai warna animasi */
      animation: spin 1s linear infinite;
  }

  .loader-text {
      color: #7f9c53; /* Hijau tua untuk teks */
      font-size: 1.2rem;
      margin-top: 16px;
  }

  @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
  }

  .fade-out {
      opacity: 0;
      visibility: hidden;
  }
</style>


<div id="loader-overlay">
  <div class="flex flex-col items-center">
      <div class="loader-spinner"></div>
      <p class="loader-text">Memuat...</p>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      const loaderOverlay = document.getElementById('loader-overlay');
      // Sembunyikan loader setelah halaman selesai dimuat (bisa disesuaikan waktunya)
      setTimeout(() => {
          loaderOverlay.classList.add('fade-out');
          setTimeout(() => {
              loaderOverlay.style.display = 'none';
          }, 500); // Tunggu animasi fade-out selesai
      }, 1500); // Sesuaikan durasi loader di sini (dalam milidetik)
  });
</script>
