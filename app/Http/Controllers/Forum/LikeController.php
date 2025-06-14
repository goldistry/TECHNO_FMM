<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Discussion;
use App\Models\Comment;

class LikeController extends Controller
{
    /**
     * Toggle like untuk diskusi atau komentar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $type  "discussion" atau "comment"
     * @param  int     $id
     */
    public function toggle(Request $request, string $type, int $id)
    {
        $model = $type === 'discussion'
            ? Discussion::findOrFail($id)
            : Comment::findOrFail($id);

        $user = Auth::user();

        $existing = $model->likes()
            ->where('user_id', $user->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            $model->likes()->create(['user_id' => $user->id]);
            $liked = true;
        }

        // Update count
        $model->likes_count = $model->likes()->count();
        $model->save();

        return response()->json([
            'success'    => true,
            'liked'      => $liked,
            'likesCount' => $model->likes_count,
        ]);
    }
}
