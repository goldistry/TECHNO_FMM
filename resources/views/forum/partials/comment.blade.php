<div class="bg-gray-50 rounded-lg p-4" id="comment-{{ $comment->id }}">
    <div class="flex items-start space-x-3">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}" 
             alt="{{ $comment->user->name }}" 
             class="w-8 h-8 rounded-full">
        <div class="flex-1">
            <p class="font-semibold text-[var(--blue)]">{{ $comment->user->name }}</p>
            <p class="text-gray-600 text-sm mt-1">{{ $comment->content }}</p>
            <div class="flex items-center space-x-4 mt-2">
                @auth
                    <button class="text-sm {{ $comment->isLikedBy(auth()->user()) ? 'text-[var(--primary)]' : 'text-gray-500' }} hover:text-[var(--primary)] transition"
                            onclick="toggleLike('comment', {{ $comment->id }})"
                            id="comment-{{ $comment->id }}-like">
                        <i class="far fa-heart"></i>
                        <span id="comment-{{ $comment->id }}-like-count">{{ $comment->likes_count }}</span>
                        <span>Suka</span>
                    </button>
                    <button class="text-sm text-gray-500 hover:text-[var(--blue)] transition"
                            onclick="toggleReplyForm('reply-{{ $comment->id }}')">
                        Balas
                    </button>
                @endauth
                <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
            </div>

            @auth
                <!-- Reply Form -->
                <form id="reply-{{ $comment->id }}" 
                      class="reply-form mt-4"
                      action="{{ route('comments.store', $discussion) }}" 
                      method="POST">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <div class="flex items-start space-x-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}" 
                             alt="{{ auth()->user()->name }}" 
                             class="w-8 h-8 rounded-full">
                        <div class="flex-1">
                            <textarea name="content"
                                      class="w-full border-2 border-gray-200 rounded-lg p-3 comment-input focus:border-[var(--blue)] focus:ring-1 focus:ring-[var(--blue)]"
                                      placeholder="Tulis balasan..."
                                      required></textarea>
                            <div class="flex justify-end space-x-2 mt-2">
                                <button type="button" 
                                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition"
                                        onclick="toggleReplyForm('reply-{{ $comment->id }}')">
                                    Batal
                                </button>
                                <button type="submit" 
                                        class="px-4 py-2 rounded-lg bg-[var(--blue)] text-white hover:bg-opacity-90 transition">
                                    Kirim
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            @endauth

            <!-- Replies -->
            @if($comment->replies->count() > 0)
                <div class="ml-8 mt-4 space-y-4">
                    @foreach($comment->replies as $reply)
                        @include('forum.partials.comment', ['comment' => $reply])
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>