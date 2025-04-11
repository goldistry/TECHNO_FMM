<title>Loader Example</title>
<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>
<style>
  /* Typewriter effect for the text */
  .typewriter {
    overflow: hidden;
    border-right: 0.15em solid white;
    white-space: nowrap;
    animation: typing 2s steps(13, end), blink-caret 0.75s step-end infinite;
  }
  @keyframes typing {
    from { width: 0; }
    to { width: 13ch; }
  }
  @keyframes blink-caret {
    from, to { border-color: transparent; }
    50% { border-color: white; }
  }
  /* Slide-up animation for the loader overlay */
  @keyframes slideUp {
    0% { transform: translateY(0); }
    100% { transform: translateY(-100vh); }
  }
  .slide-up {
    animation: slideUp 1s ease-in-out forwards;
    /* Removed animation-delay to let JS handle the timing */
  }
</style>
</head>

<!-- Loader overlay -->
<div id="loader" class="fixed inset-0 bg-black flex items-center justify-center z-50">
  <span id="loader-text" class="inline-block text-white text-4xl font-bold typewriter">
    Welcome to...
  </span>
</div>

<script>
  // Wait 2.5s for the typewriter effect to finish, then trigger the slide-up
  setTimeout(() => {
    const loader = document.getElementById('loader');
    loader.classList.add('slide-up');
    // Remove the loader after the slide-up animation completes (1 second)
    setTimeout(() => {
      loader.remove();
    }, 1000);
  }, 2500);
</script>