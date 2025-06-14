<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Discussion;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Simpan komentar (atau reply) untuk diskusi tertentu.
     */
    public function store(Request $request, Discussion $discussion)
    {
        $request->validate([
            'content'   => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        Comment::create([
            'discussion_id' => $discussion->id,
            'parent_id'     => $request->parent_id,
            'user_id'       => Auth::id(),
            'content'       => $request->content,
        ]);

        // Increment counter komentar
        $discussion->increment('comments_count');

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
