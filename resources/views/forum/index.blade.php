@extends('layout')

@section('title', 'Forum Diskusi Jurusan - Find My Major')

@section('head')
    <!-- Ensure Bootstrap CSS is loaded in the head section -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Global font family and color changes */
        :root {
            --beige: #F5F2EA;
            /* Kalau masih dipakai di tempat lain */
            --light-beige: #F5F2EA;
            /* Gantilah ini ke warna yang diambil dari gambar */
            --blue: #0066ff;
            /* Contoh variable lain */
            --blue-dark: #0056c9;
            /* Contoh variable lain */
            --green: #28a745;
            /* Contoh variable lain */
            --primary: #ff5722;
            /* Contoh variable lain */
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--light-beige);
            color: #000;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #000;
        }

        .avatar-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--green);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 20px;
        }

        .testimonial-item {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: #000;
        }

        .testimonial-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .testimonial-content {
            flex: 1;
        }

        .testimonial-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .testimonial-header .name {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .testimonial-header .time-ago {
            font-size: 0.875rem;
            color: #888;
        }

        .stars {
            color: #f0ad4e;
        }

        .rating i {
            font-size: 24px;
            color: #ccc;
            cursor: pointer;
            margin-right: 5px;
        }

        .rating i.selected {
            color: #f0ad4e;
        }

        .rating i:hover {
            color: #f0ad4e;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Category Styling (ensure the category text is black and bold) */
        .testimonial-item small.text-muted {
            font-size: 1.1rem;
            font-weight: bold;
            color: #000;
            /* Ensure the category text is visible */
        }

        .filter-area {
            margin-bottom: 30px;
            padding: 15px;
            border-radius: 8px;
            background-color: var(--light-beige);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Button Styling for Add Testimonial */
        .btn-primary {
            background-color: #0066ff;
            border-color: #0066ff;
        }

        .btn-primary:hover {
            background-color: #0056c9;
            border-color: #0056c9;
        }

        /* Global styles agar konsisten dengan homepage */
        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--light-beige);
            color: #000;
        }

        /* Container utama dengan padding dan margin yang konsisten */
        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .hero-heading {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--blue);
        }

        /* Area Filter */
        .filter-area {
            background-color: #fff;
            padding: 1.25rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        /* Kartu testimoni, mengikuti style card homepage */
        .testimonial-item {
            background-color: #fff;
            border-radius: 1.5rem;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 2rem;
        }

        .testimonial-item:hover {
            transform: scale(1.03);
        }

        /* Avatar lingkaran untuk inisial */
        .avatar-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--green);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 1.25rem;
            flex-shrink: 0;
        }

        /* Tombol, agar sesuai dengan tombol di homepage */
        .btn-primary {
            background-color: var(--blue);
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--blue-dark);
        }

        .discussion-card {
            transition: transform 0.2s ease-in-out;
        }

        .discussion-card:hover {
            transform: translateY(-2px);
        }

        .reply-form {
            display: none;
        }

        .reply-form.active {
            display: block;
        }
    </style>
@endsection


@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-[var(--blue)] mb-4">Forum Diskusi Jurusan</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Diskusikan pengalaman, tanyakan keraguan, dan bagikan pengetahuanmu tentang berbagai jurusan kuliah!
            </p>
        </div>

        <!-- Tombol Mulai Diskusi -->
        <div class="mb-8 text-center">
            @auth
                <button onclick="showNewDiscussionForm()"
                    class="bg-[var(--primary)] text-white px-6 py-3 rounded-full font-semibold hover:bg-opacity-90
                           transition transform hover:scale-105 shadow-lg">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Mulai Diskusi Baru
                </button>
            @else
                <a href="{{ route('login') }}" class="text-[var(--primary)] font-semibold hover:underline">
                    Login untuk memulai diskusi
                </a>
            @endauth
        </div>

        <!-- Filter Kategori (opsional, bisa dihapus jika tidak pakai) -->
        <div class="mb-8 flex flex-wrap gap-3 justify-center">
            <a href="{{ route('forum.index') }}"
                class="px-4 py-2 rounded-full {{ request()->routeIs('forum.index') ? 'bg-[var(--blue)] text-white' : 'bg-white text-[var(--blue)] border-2 border-[var(--blue)]' }}
                  hover:bg-[var(--blue)] hover:text-white transition">
                Semua Jurusan
            </a>
            @foreach (['Teknik', 'Kesehatan', 'Ekonomi'] as $cat)
                <a href="{{ route('forum.index', ['category' => $cat]) }}"
                    class="px-4 py-2 rounded-full {{ request('category') == $cat ? 'bg-[var(--blue)] text-white' : 'bg-white text-[var(--blue)] border-2 border-[var(--blue)]' }}
                      hover:bg-[var(--blue)] hover:text-white transition">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        <!-- Daftar Diskusi -->
        <div class="space-y-6">
            @forelse($discussions as $discussion)
                <div class="bg-white rounded-xl shadow-lg p-6 discussion-card">
                    <div class="flex items-start space-x-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($discussion->user->name) }}"
                            alt="{{ $discussion->user->name }}" class="w-12 h-12 rounded-full">
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <a href="{{ route('forum.show', $discussion) }}"
                                    class="text-xl font-semibold text-[var(--blue)] hover:text-[var(--primary)] transition">
                                    {{ $discussion->title }}
                                </a>
                                <span class="text-sm text-gray-500">{{ $discussion->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-600 mb-4">
                                {{ Str::limit($discussion->content, 200) }}
                            </p>
                            <div class="flex items-center space-x-4 mb-4">
                                @auth
                                    <button id="discussion-like-btn-{{ $discussion->id }}"
                                        class="flex items-center space-x-2 text-gray-500 hover:text-[var(--primary)] transition"
                                        onclick="toggleLike('discussion', {{ $discussion->id }})">
                                        <i class="{{ $discussion->isLikedBy(auth()->user()) ? 'fas' : 'far' }} fa-heart"></i>
                                        <span id="likes-count-{{ $discussion->id }}">{{ $discussion->likes_count }}</span>
                                        <span>Suka</span>
                                    </button>
                                @else
                                    <span class="flex items-center space-x-2 text-gray-400">
                                        <i class="far fa-heart"></i>
                                        <span>{{ $discussion->likes_count }}</span>
                                        <span>Suka</span>
                                    </span>
                                @endauth

                                <a href="{{ route('forum.show', $discussion) }}"
                                    class="flex items-center space-x-2 text-gray-500 hover:text-[var(--blue)] transition">
                                    <i class="far fa-comment"></i>
                                    <span>{{ $discussion->comments_count }} Komentar</span>
                                </a>
                                <span class="text-gray-400">•</span>
                                <span class="text-sm text-gray-500">Kategori: {{ $discussion->category }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <p class="text-gray-500">Belum ada diskusi. Jadilah yang pertama memulai!</p>
                </div>
            @endforelse

            <!-- Pagination -->
            {{ $discussions->links() }}
        </div>
    </div>

    <!-- Modal: New Discussion -->
    @auth
        <div id="newDiscussionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-xl p-6 max-w-2xl w-full mx-4">
                <h2 class="text-2xl font-bold text-[var(--blue)] mb-4">Mulai Diskusi Baru</h2>
                <form action="{{ route('forum.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Judul Diskusi</label>
                            <input type="text" name="title"
                                class="w-full border-2 border-gray-200 rounded-lg p-3 focus:border-[var(--blue)] focus:ring-1 focus:ring-[var(--blue)]"
                                placeholder="Apa yang ingin kamu diskusikan?" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Kategori</label>
                            <select name="category"
                                class="w-full border-2 border-gray-200 rounded-lg p-3 focus:border-[var(--blue)] focus:ring-1 focus:ring-[var(--blue)]"
                                required>
                                <option value="">Pilih Kategori</option>
                                <option value="Teknik">Teknik</option>
                                <option value="Kesehatan">Kesehatan</option>
                                <option value="Ekonomi">Ekonomi</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Isi Diskusi</label>
                            <textarea name="content"
                                class="w-full border-2 border-gray-200 rounded-lg p-3 h-32 focus:border-[var(--blue)] focus:ring-1 focus:ring-[var(--blue)]"
                                placeholder="Jelaskan lebih detail..." required></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition"
                            onclick="hideNewDiscussionForm()">
                            Batal
                            <button type="submit"
                                class="px-4 py-2 rounded-lg border border-blue-600 bg-blue-600 text-white hover:bg-blue-700 transition">
                                Mulai Diskusi
                            </button>

                    </div>
                </form>
            </div>
        </div>
    @endauth

@endsection

@section('scripts')
    <script>
        function showNewDiscussionForm() {
            const m = document.getElementById('newDiscussionModal');
            m.classList.remove('hidden');
            m.classList.add('flex');
        }

        function hideNewDiscussionForm() {
            const m = document.getElementById('newDiscussionModal');
            m.classList.remove('flex');
            m.classList.add('hidden');
        }

        function toggleLike(type, id) {
            const url = `/forum/like/${type}/${id}`;
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) return;
                    let countEl, btn;
                    if (type === 'discussion') {
                        countEl = document.getElementById(`likes-count-${id}`) ||
                            document.getElementById('discussion-likes-count');
                        btn = document.getElementById(`discussion-like-btn-${id}`);
                    } else {
                        countEl = document.getElementById(`comment-${id}-likes-count`);
                        btn = document.getElementById(`comment-like-btn-${id}`);
                    }
                    if (countEl) countEl.textContent = data.likesCount;
                    if (btn) {
                        const icon = btn.querySelector('i');
                        if (data.liked) {
                            icon.classList.remove('far');
                            icon.classList.add('fas');
                        } else {
                            icon.classList.remove('fas');
                            icon.classList.add('far');
                        }
                    }
                })
                .catch(console.error);
        }
    </script>
@endsection
