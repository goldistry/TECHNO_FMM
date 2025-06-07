<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Discussion;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Discussion $discussion)
    {
        $validated = $request->validate([
            'content'     => 'required|string',
            'author_name' => 'required|string|max:255',
            'parent_id'   => 'nullable|exists:comments,id'
        ]);

        $comment = $discussion->comments()->create([
            'content'     => $validated['content'],
            'author_name' => $validated['author_name'],
            'parent_id'   => $validated['parent_id'] ?? null
        ]);

        // Increment total komentar di discussion
        $discussion->increment('comments_count');

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }

     public function toggleLike(Request $request, Comment $comment)
    {
        try {
            $validated = $request->validate([
                'author_name' => 'required|string|max:255'
            ]);

            // Cek apakah like milik author_name ini sudah ada
            $existingLike = $comment->likes()
                                    ->where('author_name', $validated['author_name'])
                                    ->first();

            if ($existingLike) {
                // Kalau sudah ada, hapus like dan decrement counter
                $existingLike->delete();
                $comment->decrement('likes_count');
                $comment->refresh();

                $liked = false;
                $message = 'Like dihapus';
            } else {
                // Kalau belum ada, buat like baru dan increment counter
                $comment->likes()->create([
                    'author_name' => $validated['author_name']
                ]);
                $comment->increment('likes_count');
                $comment->refresh();

                $liked = true;
                $message = 'Like ditambahkan';
            }

            return response()->json([
                'success'    => true,
                'message'    => $message,
                'likesCount' => $comment->likes_count,
                'liked'      => $liked
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses like'
            ], 500);
        }
    }
}
