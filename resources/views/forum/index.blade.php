@extends('layout')

@section('title', 'Forum Diskusi Jurusan - Find My Major')

@section('head')
    <style>
        .discussion-card {
            transition: transform 0.2s ease-in-out;
        }
        
        .discussion-card:hover {
            transform: translateY(-2px);
        }

        .comment-input {
            min-height: 60px;
            resize: vertical;
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
        <!-- Forum Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-[var(--blue)] mb-4">Forum Diskusi Jurusan</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Diskusikan pengalaman, tanyakan keraguan, dan bagikan pengetahuanmu tentang berbagai jurusan kuliah!
            </p>
        </div>

        <!-- Create New Discussion Button -->
        <div class="mb-8 text-center">
            <button onclick="showNewDiscussionForm()" 
                    class="bg-[var(--primary)] text-white px-6 py-3 rounded-full font-semibold hover:bg-opacity-90 
                           transition transform hover:scale-105 shadow-lg">
                <i class="fas fa-plus-circle mr-2"></i>
                Mulai Diskusi Baru
            </button>
        </div>

        <!-- Discussion Categories/Filter -->
        <div class="mb-8 flex flex-wrap gap-3 justify-center">
            <a href="{{ route('forum.index') }}" 
               class="px-4 py-2 rounded-full {{ !request('category') ? 'bg-[var(--blue)] text-white' : 'bg-white text-[var(--blue)] border-2 border-[var(--blue)]' }} hover:bg-[var(--blue)] hover:text-white transition">
                Semua Jurusan
            </a>
            @foreach(['Teknik', 'Kesehatan', 'Ekonomi'] as $category)
                <a href="{{ route('forum.category', $category) }}" 
                   class="px-4 py-2 rounded-full {{ request('category') == $category ? 'bg-[var(--blue)] text-white' : 'bg-white text-[var(--blue)] border-2 border-[var(--blue)]' }} hover:bg-[var(--blue)] hover:text-white transition">
                    {{ $category }}
                </a>
            @endforeach
        </div>

        <!-- Discussion List -->
        <div class="space-y-6">
            @forelse($discussions as $discussion)
                <div class="bg-white rounded-xl shadow-lg p-6 discussion-card">
                    <div class="flex items-start space-x-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($discussion->author_name) }}" 
                             alt="{{ $discussion->author_name }}" 
                             class="w-12 h-12 rounded-full">
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <a href="{{ route('discussions.show', $discussion) }}" 
                                   class="text-xl font-semibold text-[var(--blue)] hover:text-[var(--primary)] transition">
                                    {{ $discussion->title }}
                                </a>
                                <span class="text-sm text-gray-500">{{ $discussion->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-600 mb-4">
                                {{ Str::limit($discussion->content, 200) }}
                            </p>
                            
                            <!-- Interaction Buttons -->
                            <div class="flex items-center space-x-4 mb-4">
                                {{-- TOMBOL LIKE DISKUSI --}}
                                <button 
                                    id="discussion-like-btn-{{ $discussion->id }}"
                                    class="flex items-center space-x-2 text-gray-500 hover:text-[var(--primary)] transition"
                                    onclick="toggleLike('{{ $discussion->id }}')"
                                >
                                    @php
                                        // Cek apakah 'Anonymous' sudah pernah like diskusi ini?
                                        $isLiked = $discussion->isLikedBy('Anonymous');
                                    @endphp

                                    @if($isLiked)
                                        {{-- solid heart (sudah liked) --}}
                                        <i class="fas fa-heart"></i>
                                    @else
                                        {{-- outline heart (belum liked) --}}
                                        <i class="far fa-heart"></i>
                                    @endif

                                    <span id="likes-count-{{ $discussion->id }}">{{ $discussion->likes_count }}</span>
                                    <span>Suka</span>
                                </button>

                                <a href="{{ route('discussions.show', $discussion) }}" 
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
                    <p class="text-gray-500">Belum ada diskusi. Mulai diskusi pertama!</p>
                </div>
            @endforelse

            <!-- Pagination -->
            {{ $discussions->links() }}
        </div>
    </div>

    <!-- New Discussion Modal -->
    <div id="newDiscussionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-2xl w-full mx-4">
            <h2 class="text-2xl font-bold text-[var(--blue)] mb-4">Mulai Diskusi Baru</h2>
            <form action="{{ route('discussions.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Nama Anda</label>
                        <input type="text" 
                               name="author_name"
                               class="w-full border-2 border-gray-200 rounded-lg p-3 focus:border-[var(--blue)] focus:ring-1 focus:ring-[var(--blue)] text-gray-900"
                               placeholder="Masukkan nama Anda"
                               required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Judul Diskusi</label>
                        <input type="text" 
                               name="title"
                               class="w-full border-2 border-gray-200 rounded-lg p-3 focus:border-[var(--blue)] focus:ring-1 focus:ring-[var(--blue)] text-gray-900"
                               placeholder="Apa yang ingin kamu diskusikan?"
                               required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Kategori</label>
                        <select name="category" 
                                class="w-full border-2 border-gray-200 rounded-lg p-3 focus:border-[var(--blue)] focus:ring-1 focus:ring-[var(--blue)] text-gray-900"
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
                                  class="w-full border-2 border-gray-200 rounded-lg p-3 h-32 focus:border-[var(--blue)] focus:ring-1 focus:ring-[var(--blue)] text-gray-900"
                                  placeholder="Jelaskan lebih detail tentang apa yang ingin kamu diskusikan..."
                                  required></textarea>
                    </div>
                </div>
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="button" 
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition"
                            onclick="hideNewDiscussionForm()">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 rounded-lg bg-[var(--primary)] text-white hover:bg-opacity-90 transition">
                        Mulai Diskusi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    /**
     * toggleLike bisa dipanggil:
     * 1) toggleLike('123')           => dianggap diskusi ID=123 (dari index)
     * 2) toggleLike('discussion', 123) => diskusi ID=123 (dari halaman detail)
     * 3) toggleLike('comment', 456)    => komentar ID=456
     */
    function toggleLike(typeOrId, id) {
        let type, itemId;

        if (id === undefined) {
            // Jika fungsi dipanggil dengan satu argumen, anggap type='discussion'
            type   = 'discussion';
            itemId = typeOrId;
        } else {
            type   = typeOrId;
            itemId = id;
        }

        let url, counterId, buttonId;

        if (type === 'discussion') {
            url       = `/forum/discussions/${itemId}/like`;
            buttonId  = `discussion-like-btn-${itemId}`;
            // Dari index → counter id = likes-count-{itemId}
            if (id === undefined) {
                counterId = `likes-count-${itemId}`;
            } else {
                // Dari halaman detail → counter id = discussion-likes-count
                counterId = `discussion-likes-count`;
            }
        }
        else if (type === 'comment') {
            url       = `/forum/comments/${itemId}/like`;
            buttonId  = `comment-like-btn-${itemId}`;
            counterId = `comment-${itemId}-likes-count`;
        }

        const formData = new FormData();
        formData.append('author_name', 'Anonymous');

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (! data.success) {
                console.error('Gagal memproses like:', data.message);
                return;
            }

            // 1) Update jumlah like
            const countEl = document.getElementById(counterId);
            if (countEl) {
                countEl.textContent = data.likesCount;
            }

            // 2) Ganti ikon sesuai data.liked (solid ↔ outline)
            const btn = document.getElementById(buttonId);
            if (btn) {
                const icon = btn.querySelector('i');
                if (icon) {
                    if (data.liked) {
                        // Jika baru saja di-like → pakai solid heart
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                    } else {
                        // Jika baru di-unlike → pakai outline heart
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                    }
                }
            }
        })
        .catch(err => {
            console.error('Fetch error:', err);
        });
    }

    function showCommentForm(id) {
        const el = document.getElementById(`comment-form-${id}`);
        if (el) el.classList.remove('hidden');
    }

    function hideCommentForm(id) {
        const el = document.getElementById(`comment-form-${id}`);
        if (el) el.classList.add('hidden');
    }

    function showNewDiscussionForm() {
        const modal = document.getElementById('newDiscussionModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function hideNewDiscussionForm() {
        const modal = document.getElementById('newDiscussionModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>
@endsection
