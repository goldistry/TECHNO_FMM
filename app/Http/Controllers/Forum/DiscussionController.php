<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Discussion;

class DiscussionController extends Controller
{
    /**
     * Tampilkan daftar semua diskusi.
     */
    public function index()
    {
        $discussions = Discussion::with('user')
            ->withCount(['comments', 'likes'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('forum.index', compact('discussions'));
    }

    /**
     * Tampilkan detail satu diskusi.
     */
    public function show(Discussion $discussion)
    {
        $discussion->load([
            'user',
            'comments.user',
            'comments.replies.user',
            'likes'
        ]);

        return view('forum.show', compact('discussion'));
    }

    /**
     * Simpan diskusi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content'  => 'required|string',
        ]);

        $discussion = Discussion::create([
            'user_id'  => Auth::id(),
            'title'    => $request->title,
            'category' => $request->category,
            'content'  => $request->content,
        ]);

        return redirect()
            ->route('forum.show', $discussion)
            ->with('success', 'Diskusi berhasil dibuat.');
    }
}
