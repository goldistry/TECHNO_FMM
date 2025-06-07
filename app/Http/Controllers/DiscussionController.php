<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index(Request $request)
    {
        $discussions = Discussion::query()
            ->when($request->category, function ($query, $category) {
                return $query->where('category', $category);
            })
            ->latest()
            ->paginate(10);

        return view('forum.index', compact('discussions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category'    => 'required|string',
            'author_name' => 'required|string|max:255',
        ]);

        $discussion = Discussion::create($validated);

        return redirect()->route('forum.index')
            ->with('success', 'Diskusi berhasil dibuat!');
    }

    public function show(Discussion $discussion)
    {
        $discussion->load(['comments.replies']);
        return view('forum.show', compact('discussion'));
    }

    public function byCategory($category)
    {
        $discussions = Discussion::where('category', $category)
            ->latest()
            ->paginate(10);

        return view('forum.index', compact('discussions'));
    }

    public function toggleLike(Request $request, Discussion $discussion)
    {
        $validated = $request->validate([
            'author_name' => 'required|string|max:255'
        ]);

        $existingLike = $discussion->likes()
                                   ->where('author_name', $validated['author_name'])
                                   ->first();

        if ($existingLike) {
            $existingLike->delete();
            $discussion->decrement('likes_count');
            $discussion->refresh();

            $liked = false;
            $message = 'Like dihapus';
        } else {
            $discussion->likes()->create([
                'author_name' => $validated['author_name']
            ]);
            $discussion->increment('likes_count');
            $discussion->refresh();

            $liked = true;
            $message = 'Like ditambahkan';
        }

        return response()->json([
            'success'    => true,
            'message'    => $message,
            'likesCount' => $discussion->likes_count,
            'liked'      => $liked
        ]);
    }
}
