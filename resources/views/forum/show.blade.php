@extends('layout')

@section('title', $discussion->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Discussion Detail -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex items-start space-x-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($discussion->author_name) }}" 
                 alt="{{ $discussion->author_name }}" 
                 class="w-12 h-12 rounded-full">
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-[var(--blue)] mb-2">{{ $discussion->title }}</h1>
                <p class="text-gray-500 mb-4">
                    Posted by {{ $discussion->author_name }} • {{ $discussion->created_at->diffForHumans() }}
                </p>
                <div class="prose max-w-none mb-6">
                    {{ $discussion->content }}
                </div>
                <div class="flex items-center space-x-4">
                    {{-- Tombol Like Diskusi --}}
                    @php
                        $isLikedDisc = $discussion->isLikedBy('Anonymous');
                    @endphp
                    <button 
                        id="discussion-like-btn-{{ $discussion->id }}"
                        class="flex items-center space-x-2 text-gray-500 hover:text-[var(--primary)] transition"
                        onclick="toggleLike('discussion', {{ $discussion->id }})"
                    >
                        @if($isLikedDisc)
                            <i class="fas fa-heart"></i>
                        @else
                            <i class="far fa-heart"></i>
                        @endif
                        <span id="discussion-likes-count">{{ $discussion->likes_count }}</span>
                        <span>Suka</span>
                    </button>
                    <button onclick="showCommentForm('main')" 
                            class="flex items-center space-x-2 text-gray-500 hover:text-[var(--blue)] transition">
                        <i class="far fa-comment"></i>
                        <span>Balas</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Comment Form -->
    <div id="comment-form-main" class="bg-white rounded-xl shadow-lg p-6 mb-8 hidden">
        <form action="{{ route('comments.store', $discussion) }}" method="POST">
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
                    <label class="block text-gray-700 mb-2">Komentar Anda</label>
                    <textarea name="content"
                              class="w-full border-2 border-gray-200 rounded-lg p-3 h-32 focus:border-[var(--blue)] focus:ring-1 focus:ring-[var(--blue)] text-gray-900"
                              placeholder="Tulis komentar Anda..."
                              required></textarea>
                </div>
            </div>
            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" 
                        onclick="hideCommentForm('main')"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                    Batal
                </button>
                <button type="submit" 
                        class="px-4 py-2 rounded-lg bg-[var(--primary)] text-white hover:bg-opacity-90 transition">
                    Kirim Komentar
                </button>
            </div>
        </form>
    </div>

    <!-- Comments List -->
    <div class="space-y-6">
        @foreach($discussion->comments as $comment)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-start space-x-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->author_name) }}" 
                         alt="{{ $comment->author_name }}" 
                         class="w-10 h-10 rounded-full">
                    <div class="flex-1">
                        <p class="font-semibold text-[var(--blue)]">{{ $comment->author_name }}</p>
                        <p class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                        <div class="prose max-w-none my-4">
                            {{ $comment->content }}
                        </div>
                        <div class="flex items-center space-x-4">
                            {{-- Tombol Like Komentar Utama --}}
                            @php
                                $isLikedCmt = $comment->isLikedBy('Anonymous');
                            @endphp
                            <button 
                                id="comment-like-btn-{{ $comment->id }}"
                                class="flex items-center space-x-2 text-gray-500 hover:text-[var(--primary)] transition"
                                onclick="toggleLike('comment', {{ $comment->id }})"
                            >
                                @if($isLikedCmt)
                                    <i class="fas fa-heart"></i>
                                @else
                                    <i class="far fa-heart"></i>
                                @endif
                                <span id="comment-{{ $comment->id }}-likes-count">{{ $comment->likes_count }}</span>
                                <span>Suka</span>
                            </button>
                            <button onclick="showCommentForm('{{ $comment->id }}')" 
                                    class="text-gray-500 hover:text-[var(--blue)] transition">
                                Balas
                            </button>
                        </div>

                        <!-- Reply Form -->
                        <div id="comment-form-{{ $comment->id }}" class="mt-4 hidden">
                            <form action="{{ route('comments.store', $discussion) }}" method="POST">
                                @csrf
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
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
                                        <label class="block text-gray-700 mb-2">Balasan Anda</label>
                                        <textarea name="content"
                                                  class="w-full border-2 border-gray-200 rounded-lg p-3 h-32 focus:border-[var(--blue)] focus:ring-1 focus:ring-[var(--blue)] text-gray-900"
                                                  placeholder="Tulis balasan Anda..."
                                                  required></textarea>
                                    </div>
                                </div>
                                <div class="flex justify-end space-x-2 mt-4">
                                    <button type="button" 
                                            onclick="hideCommentForm('{{ $comment->id }}')"
                                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                                        Batal
                                    </button>
                                    <button type="submit" 
                                            class="px-4 py-2 rounded-lg bg-[var(--primary)] text-white hover:bg-opacity-90 transition">
                                        Kirim Balasan
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Replies -->
                        @if($comment->replies->count() > 0)
                            <div class="ml-8 mt-4 space-y-4">
                                @foreach($comment->replies as $reply)
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex items-start space-x-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($reply->author_name) }}" 
                                                 alt="{{ $reply->author_name }}" 
                                                 class="w-8 h-8 rounded-full">
                                            <div class="flex-1">
                                                <p class="font-semibold text-[var(--blue)]">{{ $reply->author_name }}</p>
                                                <p class="text-gray-500 text-sm">{{ $reply->created_at->diffForHumans() }}</p>
                                                <div class="prose max-w-none my-2">
                                                    {{ $reply->content }}
                                                </div>
                                                {{-- Tombol Like Balasan --}}
                                                @php
                                                    $isLikedReply = $reply->isLikedBy('Anonymous');
                                                @endphp
                                                <button 
                                                    id="comment-like-btn-{{ $reply->id }}"
                                                    class="flex items-center space-x-2 text-gray-500 hover:text-[var(--primary)] transition"
                                                    onclick="toggleLike('comment', {{ $reply->id }})"
                                                >
                                                    @if($isLikedReply)
                                                        <i class="fas fa-heart"></i>
                                                    @else
                                                        <i class="far fa-heart"></i>
                                                    @endif
                                                    <span id="comment-{{ $reply->id }}-likes-count">{{ $reply->likes_count }}</span>
                                                    <span>Suka</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
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
            counterId = `discussion-likes-count`;
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
                console.error('Error like:', data.message);
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
</script>
@endsection
