@extends('layout')

@section('title', 'Info Jurusan')

@section('head_extra')
<style>
    .hero-bg {
        background: linear-gradient(135deg, var(--light-green) 0%, var(--blue) 50%, var(--green) 100%);
        background-size: 200% 200%;
        animation: gradientShift 10s ease infinite alternate;
        background-position: 0% 50%;
        /* Posisi awal gradasi */
    }
</style>
@endsection

@section('content')
<div class="hero-bg py-12 px-4 text-white text-center rounded-bl-[4rem] rounded-br-[4rem] flex flex-col items-center justify-center min-h-[250px]">
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight tracking-tight mt-2 drop-shadow-lg">
        Temukan Jurusan yang Paling Cocok Untukmu <br>
        <span style="color: var(--primary);">Bersama Find My Major</span>
    </h1>

    <form action="{{ route('majors.index') }}" method="GET" class="mt-8 max-w-4xl mx-auto flex lg:flex-row md:flex-col sm:flex-col gap-4">
        <div class="flex-grow bg-white rounded-full shadow-md flex items-center overflow-hidden">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama jurusan..." class="flex-1 px-6 py-3 rounded-l-full text-gray-700 focus:outline-none search-input" />
        </div>

        <div class="relative flex-initial flex-grow sm:w-auto">
            <select name="category" class="block w-full px-6 py-3 border border-gray-300 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-[var(--blue)] focus:border-transparent text-gray-700 text-base hide-default-arrow bg-white pr-10">
                <option value="all" {{ ($category ?? 'all') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                @foreach (array_filter($categories, function($cat) { return $cat !== 'all'; }) as $catOption)
                <option value="{{ $catOption }}" {{ $catOption == ($category ?? '') ? 'selected' : '' }}>
                    {{ $catOption }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="!bg-[var(--primary)] flex-grow  sm:w-auto px-8 py-3 text-white font-semibold rounded-full hover:opacity-90 hover:bg-[var(--light-orange)] shadow-md transition-colors duration-300"> {{-- Changed flex-none to flex-initial --}}
            Cari & Filter
        </button>
    </form>
</div>

<div class="max-w-6xl mx-auto my-12 px-4">
    <h3 class="text-2xl font-bold mb-6 text-center text-gray-800 flex items-center justify-center group transform transition-transform duration-200 hover:scale-105" style="color: var(--green);">
        Daftar Jurusan
        @if($category && $category !== 'all')
        <span class="ml-2 px-3 py-1 text-sm font-semibold rounded-full bg-[var(--green)] bg-opacity-15 text-white">
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
                <img src="{{ $major->img }}" alt="{{ $major->title }}" class="w-full h-48 object-cover object-center" />
            </div>
            <div class="p-5 flex flex-col flex-grow">
                <h4 class="text-black text-xl font-bold mb-2">{{ $major->title }}</h4>
                <p class="text-sm text-gray-600 leading-relaxed mb-2 flex-grow">{{ $major->short_desc }}</p>
                <p class="text-xs text-gray-500 mb-4 mt-auto">Kategori: <span class="font-medium">{{ $major->category }}</span></p>
                <a href="{{ route('majors.show', $major->id) }}" class="inline-flex items-center font-semibold text-base px-4 py-2 rounded-lg transition-colors duration-300 bg-[var(--blue)] text-white hover:bg-[var(--blue-dark)]">
                    Selengkapnya
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection