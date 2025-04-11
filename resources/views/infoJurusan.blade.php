@extends('layout')

@section('title', 'Info Jurusan')

@section('content')
  <div class="py-12 px-4 text-white text-center rounded-bl-[4rem] rounded-br-[4rem]" style="background-color: var(--green);">
    <h1 class="text-3xl md:text-4xl font-bold mt-2">
      Temukan Jurusan yang Paling Cocok Untukmu <br>
      <span style="color: var(--primary);">bersama Find My Major</span>
    </h1>

    <!-- Search Bar -->
    <form action="{{ route('majors.index') }}" method="GET" class="mt-8 max-w-3xl mx-auto bg-white rounded-full shadow-md flex items-center overflow-hidden">
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama jurusan..."  class="flex-1 px-6 py-3 rounded-l-full text-gray-700 focus:outline-none" />
      <button type="submit" class="px-6 py-3 text-white font-semibold rounded-r-full hover:opacity-90" style="background: linear-gradient(to right, var(--blue), var(--blue-dark));">
        Cari
      </button>
    </form>
  </div>

  <!-- Daftar Jurusan -->
  <div class="max-w-6xl mx-auto my-12 px-4">
    <h3 class="text-xl font-bold mb-4" style="color: var(--green);">Daftar Jurusan</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($majors as $major)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-transform hover:scale-[1.02]">
          <div class="relative">
            <img src="{{ $major['img'] }}" alt="{{ $major['title'] }}" class="w-full h-48 object-cover" />
            <button class="absolute top-2 right-2 bg-white rounded-full p-2 shadow hover:bg-gray-100">❤️</button>
          </div>
          <div class="p-4">
            <h4 class="text-lg font-semibold mb-1">{{ $major['title'] }}</h4>
            <p class="text-sm text-gray-600">{{ $major['short_desc'] }}</p>
            <a href="#" class="mt-4 inline-block font-semibold hover:underline" style="color: var(--blue);">
              Selengkapnya →
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
