@extends('layout')

@section('title', 'Info Jurusan')

@section('content')
    <div class="hero-bg py-12 px-4 text-white text-center rounded-bl-[4rem] rounded-br-[4rem] flex flex-col items-center justify-center min-h-[250px]">
        {{-- Ukuran font disesuaikan di sini untuk layar kecil --}}
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight tracking-tight mt-2 drop-shadow-lg">
            Temukan Jurusan yang Paling Cocok Untukmu <br>
            <span style="color: var(--primary);">Bersama Find My Major</span>
        </h1>

        <form action="{{ route('majors.index') }}" method="GET" class="mt-8 max-w-4xl mx-auto flex flex-col sm:flex-row gap-4">
            <div class="flex-1 bg-white rounded-full shadow-md flex items-center overflow-hidden">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama jurusan..." class="flex-1 px-6 py-3 rounded-l-full text-gray-700 focus:outline-none" />
            </div>

            <div class="relative flex-shrink-0 sm:w-auto w-full">
                <select name="category" class="block w-full px-6 py-3 border border-gray-300 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-[var(--blue)] focus:border-transparent text-gray-700 text-base appearance-none bg-white pr-10">
                    <option value="all" {{ ($category ?? 'all') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                    @foreach (array_filter($categories, function($cat) { return $cat !== 'all'; }) as $catOption)
                        <option value="{{ $catOption }}" {{ $catOption == ($category ?? '') ? 'selected' : '' }}>
                            {{ $catOption }}
                        </option>
                    @endforeach
                </select>
                {{-- Arrow icon for select --}}
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.757 7.586 5.343 9z"/></svg>
                </div>
            </div>

            <button type="submit" class="sm:w-auto w-full px-8 py-3 text-white font-semibold rounded-full hover:opacity-90 bg-[var(--primary)] hover:bg-[var(--light-orange)] shadow-md transition-colors duration-300">
                Cari & Filter
            </button>
        </form>
    </div>

    <div class="max-w-6xl mx-auto my-12 px-4">
        <h3 class="text-2xl font-bold mb-6 text-center text-gray-800 flex items-center justify-center group transform transition-transform duration-200 hover:scale-105" style="color: var(--green);">
            Daftar Jurusan
            @if($category && $category !== 'all')
                <span class="ml-2 px-3 py-1 text-sm font-semibold rounded-full bg-[var(--green)] bg-opacity-15 text-[var(--green)]">
                    Kategori {{ $category }}
                </span>
            @endif
        </h3>

        @if ($majors->isEmpty())
            <div class="text-center text-gray-600 text-lg py-10">
                Tidak ada jurusan yang ditemukan untuk @if(request('search')) pencarian "{{ request('search') }}" @endif @if($category && $category !== 'all') di kategori "{{ $category }}" @endif.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($majors as $major)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col">
                        <div class="relative">
                            <img src="{{ $major['img'] }}" alt="{{ $major['title'] }}" class="w-full h-48 object-cover object-center" />
                            {{-- Tombol hati dihilangkan dari sini --}}
                            {{-- <button class="absolute top-3 right-3 bg-white bg-opacity-80 rounded-full p-2 shadow-md hover:bg-gray-100 transition-all duration-200">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                            </button> --}}
                        </div>
                        <div class="p-5 flex flex-col flex-grow">
                            <h4 class="text-black text-xl font-bold mb-2">{{ $major['title'] }}</h4>
                            <p class="text-sm text-gray-600 leading-relaxed mb-2 flex-grow">{{ $major['short_desc'] }}</p>
                            <p class="text-xs text-gray-500 mb-4 mt-auto">Kategori: <span class="font-medium">{{ $major['category'] }}</span></p>
                            <a href="{{ route('majors.show', $major['id']) }}" class="inline-flex items-center font-semibold text-base px-4 py-2 rounded-lg transition-colors duration-300 bg-[var(--blue)] text-white hover:bg-[var(--blue-dark)]">
                                Selengkapnya
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection