@extends('layout')

@section('title', $discussion->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Detail Diskusi -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex items-start space-x-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($discussion->user->name) }}"
                 alt="{{ $discussion->user->name }}"
                 class="w-12 h-12 rounded-full">
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-[var(--blue)] mb-2">{{ $discussion->title }}</h1>
                <p class="text-gray-500 mb-4">
                    Posted by {{ $discussion->user->name }} • {{ $discussion->created_at->diffForHumans() }}
                </p>
                <div class="prose max-w-none mb-6">
                    {{ $discussion->content }}
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <button id="discussion-like-btn-{{ $discussion->id }}"
                                class="flex items-center space-x-2 text-gray-500 hover:text-[var(--primary)] transition"
                                onclick="toggleLike('discussion', {{ $discussion->id }})">
                            <i class="{{ $discussion->isLikedBy(auth()->user()) ? 'fas' : 'far' }} fa-heart"></i>
                            <span id="discussion-likes-count">{{ $discussion->likes_count }}</span>
                            <span>Suka</span>
                        </button>
                        <button onclick="showCommentForm('main')"
                                class="flex items-center space-x-2 text-gray-500 hover:text-[var(--blue)] transition">
                            <i class="far fa-comment"></i>
                            <span>Balas</span>
                        </button>
                    @else
                        <span class="flex items-center space-x-2 text-gray-400">
                            <i class="far fa-heart"></i>
                            <span>{{ $discussion->likes_count }}</span>
                            <span>Suka</span>
                        </span>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Form Komentar Utama -->
    @auth
    <div id="comment-form-main" class="bg-white rounded-xl shadow-lg p-6 mb-8 hidden">
        <form action="{{ route('forum.comments.store', $discussion) }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 mb-2">Komentar Anda</label>
                    <textarea name="content"
                              class="w-full border-2 border-gray-200 rounded-lg p-3 h-32 focus:border-[var(--blue)] focus:ring-1 focus:ring-[var(--blue)]"
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
                   class="px-4 py-2 rounded-lg border border-blue-600 bg-blue-600 text-white hover:bg-blue-700 transition">
                    Kirim Komentar
                </button>
            </div>
        </form>
    </div>
    @endauth

    <!-- Daftar Komentar & Balasan -->
    <div class="space-y-6">
        @foreach($discussion->comments as $comment)
            @include('forum.partials.comment', ['comment' => $comment])
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showCommentForm(id) {
        document.getElementById(`comment-form-${id}`).classList.remove('hidden');
    }
    function hideCommentForm(id) {
        document.getElementById(`comment-form-${id}`).classList.add('hidden');
    }
    function toggleLike(type, id) {
        // sama seperti di index.blade.php
        const url = `/forum/like/${type}/${id}`;
        fetch(url, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
        })
        .then(r => r.json())
        .then(data => {
            if (!data.success) return;
            const countEl = document.getElementById('discussion-likes-count');
            const btn = document.getElementById(`discussion-like-btn-${id}`);
            if (countEl) countEl.textContent = data.likesCount;
            if (btn) {
                const icon = btn.querySelector('i');
                icon.classList.toggle('fas', data.liked);
                icon.classList.toggle('far', !data.liked);
            }
        }).catch(console.error);
    }
</script>
@endsection
