<div class="bg-white rounded-xl shadow-lg p-6" id="comment-{{ $comment->id }}">
    <div class="flex items-start space-x-4">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}"
             alt="{{ $comment->user->name }}"
             class="w-10 h-10 rounded-full">
        <div class="flex-1">
            <p class="font-semibold text-[var(--blue)]">{{ $comment->user->name }}</p>
            <p class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
            <div class="prose max-w-none my-4">
                {{ $comment->content }}
            </div>
            <div class="flex items-center space-x-4 mt-2">
                @auth
                    <button id="comment-like-btn-{{ $comment->id }}"
                            class="flex items-center space-x-2 text-gray-500 hover:text-[var(--primary)] transition"
                            onclick="toggleLike('comment', {{ $comment->id }})">
                        <i class="{{ $comment->isLikedBy(auth()->user()) ? 'fas' : 'far' }} fa-heart"></i>
                        <span id="comment-{{ $comment->id }}-likes-count">{{ $comment->likes_count }}</span>
                        <span>Suka</span>
                    </button>
                    <button class="text-gray-500 hover:text-[var(--blue)] transition"
                            onclick="toggleReplyForm('{{ $comment->id }}')">
                        Balas
                    </button>
                @else
                    <span class="flex items-center space-x-2 text-gray-400">
                        <i class="far fa-heart"></i>
                        <span>{{ $comment->likes_count }}</span>
                        <span>Suka</span>
                    </span>
                @endauth
            </div>

            @auth
            <form id="reply-{{ $comment->id }}" class="reply-form mt-4 hidden"
                  action="{{ route('forum.comments.store', $comment->discussion) }}"
                  method="POST">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <div>
                    <textarea name="content"
                              class="w-full border-2 border-gray-200 rounded-lg p-3 comment-input focus:border-[var(--blue)] focus:ring-1 focus:ring-[var(--blue)]"
                              placeholder="Tulis balasan..."
                              required></textarea>
                </div>
                <div class="flex justify-end space-x-2 mt-2">
                    <button type="button"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition"
                            onclick="toggleReplyForm('{{ $comment->id }}')">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600  transition">
                        Kirim
                    </button>
                </div>
            </form>
            @endauth

            @if($comment->replies->count())
                <div class="ml-8 mt-4 space-y-4">
                    @foreach($comment->replies as $reply)
                        @include('forum.partials.comment', ['comment' => $reply])
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@section('scripts')
<script>
    function toggleReplyForm(id) {
        const el = document.getElementById(`reply-${id}`);
        el.classList.toggle('hidden');
    }
    function toggleLike(type, id) {
        // reuse fungsi toggleLike yang sama
        const url = `/forum/like/${type}/${id}`;
        fetch(url, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
        })
        .then(r => r.json())
        .then(data => {
            if (!data.success) return;
            const countEl = document.getElementById(`comment-${id}-likes-count`);
            const btn     = document.getElementById(`comment-like-btn-${id}`);
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
