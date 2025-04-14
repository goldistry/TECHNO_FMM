<nav id="navbar" class="fixed top-0 left-0 w-full z-50 bg-[var(--blue-dark)] transition-colors duration-300">
  <div class="px-6 md:px-10 mx-auto py-2 sm:py-3 md:py-4 flex justify-between items-center"> 
    <a href="{{ route('homepage') }}" class="flex-shrink-0"> 
      <img src="{{ asset('logo.png') }}" alt="Lotus Tales Logo" 
           class="block h-10 sm:h-10 md:h-10 lg:h-10 w-auto transition-all duration-300 ease-in-out">
    </a>


    <div class="flex items-center text-white justify-center">
        <a href="{{ route('homepage') }}"
           class="flex items-center justify-center space-x-1 text-lg lg:text-xl bg-orange-500 rounded-xl px-3 py-1 hover:bg-white hover:text-orange-500 font-semibold transition-colors duration-200">
           <i class="fa-solid fa-house"></i>
           <h1 class="text-md">Home</h1>
        </a>
    </div>

  </div>
</nav>

{{-- <script>
 window.addEventListener('scroll', function() {
     const navbar = document.getElementById('navbar');
     // Consider adding a check if navbar exists
     if (navbar) {
        if (window.scrollY > 10) { // Use a small threshold like 10px
            // Ensure the target class exists in your CSS or Tailwind config
            if (!navbar.classList.contains('bg-[#7f9c53]')) {
                navbar.classList.remove('bg-transparent'); // Only remove if present
                navbar.classList.add('bg-[#7f9c53]');
            }
        } else {
            if (navbar.classList.contains('bg-[#7f9c53]')) {
                navbar.classList.remove('bg-[#7f9c53]');
                // Optional: Add back bg-transparent if needed, but often not necessary if the default is transparent
                // navbar.classList.add('bg-transparent');
            }
        }
     }
 });
</script> --}}