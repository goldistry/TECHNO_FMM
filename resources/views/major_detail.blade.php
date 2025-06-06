@extends('layout')

@section('title', $major['title'] . ' - Info Jurusan')

@section('content')
<div class="hero-bg py-12 px-4 text-white text-center rounded-bl-[4rem] rounded-br-[4rem] flex flex-col items-center justify-center min-h-[250px]">
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight tracking-tight mt-2 drop-shadow-lg">
        Selami Lebih Dalam <br class="md:hidden"> Jurusan <span style="color: var(--primary);">{{ $major['title'] }}</span>
    </h1>
    <p class="text-xl md:text-2xl mt-4 font-semibold opacity-90 drop-shadow">Kategori: {{ $major['category'] }}</p>
</div>

<div class="max-w-6xl mx-auto my-12 px-4">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transform transition-all duration-300 hover:scale-[1.005]">
        <div class="relative">
            <img src="{{ $major['img'] }}" alt="{{ $major['title'] }}" class="w-full h-64 sm:h-80 md:h-96 object-cover object-center rounded-t-xl" />
            <a href="{{ route('majors.index') }}" class="absolute top-4 left-4 inline-flex items-center font-semibold text-base px-5 py-2 rounded-full bg-white bg-opacity-95 text-[var(--blue)] hover:bg-gray-100 transition-colors duration-300 shadow-lg group">
                <svg class="w-5 h-5 mr-2 -translate-x-1 group-hover:-translate-x-0 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>

        <div class="p-6 md:p-10 lg:p-12">
            <h2 class="text-3xl sm:text-4xl font-extrabold mb-6 text-gray-900">{{ $major['title'] }}</h2>

            <section class="mb-10 border-b border-gray-200 pb-8">
                <h3 class="text-2xl font-bold mb-4 text-gray-800 flex items-center" style="color: var(--green);">
                    <svg class="w-7 h-7 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Tentang Jurusan Ini
                </h3>
                <p class="text-lg text-gray-700 leading-relaxed indent-8 text-justify">
                    {{ $major['full_desc'] }}
                </p>
            </section>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 mb-10">
                @if (!empty($major['required_skills']))
                <div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800 flex items-center" style="color: var(--green);">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 mr-3 text-blue-500">
                            <path d="M12 .75a8.25 8.25 0 0 0-4.135 15.39c.686.398 1.115 1.008 1.134 1.623a.75.75 0 0 0 .577.706c.352.083.71.148 1.074.195.323.041.6-.218.6-.544v-4.661a6.714 6.714 0 0 1-.937-.171.75.75 0 1 1 .374-1.453 5.261 5.261 0 0 0 2.626 0 .75.75 0 1 1 .374 1.452 6.712 6.712 0 0 1-.937.172v4.66c0 .327.277.586.6.545.364-.047.722-.112 1.074-.195a.75.75 0 0 0 .577-.706c.02-.615.448-1.225 1.134-1.623A8.25 8.25 0 0 0 12 .75Z" />
                            <path fill-rule="evenodd" d="M9.013 19.9a.75.75 0 0 1 .877-.597 11.319 11.319 0 0 0 4.22 0 .75.75 0 1 1 .28 1.473 12.819 12.819 0 0 1-4.78 0 .75.75 0 0 1-.597-.876ZM9.754 22.344a.75.75 0 0 1 .824-.668 13.682 13.682 0 0 0 2.844 0 .75.75 0 1 1 .156 1.492 15.156 15.156 0 0 1-3.156 0 .75.75 0 0 1-.668-.824Z" clip-rule="evenodd" />
                        </svg>
                        Skill yang Diperlukan
                    </h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach ($major['required_skills'] as $skill)
                        <span class="skill-tag bg-[var(--blue)] text-white text-base font-medium px-4 py-1.5 rounded-full shadow-md hover:scale-105 transition-transform duration-200 cursor-default">
                            {{ $skill }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if (!empty($major['career_prospects']))
                <div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800 flex items-center" style="color: var(--green);">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 mr-3 text-purple-500">
                            <path fill-rule="evenodd" d="M7.5 5.25a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0 1 12 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 0 1 7.5 5.455V5.25Zm7.5 0v.09a49.488 49.488 0 0 0-6 0v-.09a1.5 1.5 0 0 1 1.5-1.5h3a1.5 1.5 0 0 1 1.5 1.5Zm-3 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                            <path d="M3 18.4v-2.796a4.3 4.3 0 0 0 .713.31A26.226 26.226 0 0 0 12 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 0 1-6.477-.427C4.047 21.128 3 19.852 3 18.4Z" />
                        </svg>
                        Prospek Karir
                    </h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach ($major['career_prospects'] as $career)
                        <span class="career-tag bg-[var(--green)] text-white text-base font-medium px-4 py-1.5 rounded-full shadow-md hover:scale-105 transition-transform duration-200 cursor-default">
                            {{ $career }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            @if ($major['video_url'])
            <section class="mb-8">
                <h3 class="text-2xl font-bold mb-4 text-gray-800 flex items-center" style="color: var(--green);">
                    <svg class="w-7 h-7 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18H13a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    Video Pengenalan Jurusan
                </h3>
                <div class="relative w-full" style="padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; background: #000; border-radius: 0.75rem;">
                    <iframe
                        class="absolute top-0 left-0 w-full h-full rounded-xl"
                        src="{{ $major['video_url'] }}"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </section>
            @endif
        </div>
    </div>
</div>
@endsection