<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Support\Facades\Auth;

class PostInteractionController extends Controller
{
    /**
     * Like or dislike a post
     */
    public function toggleLike(Request $request, $postId)
    {
        $request->validate([
            'type' => 'required|in:like,dislike'
        ]);

        $post = Post::findOrFail($postId);

        // Check if the user is authenticated
        if (Auth::check()) {
            $userId = Auth::id();
            $ipAddress = null;
        } else {
            $userId = null;
            $ipAddress = $request->ip();
        }

        // Check if the user has already liked/disliked this post
        $existingLike = PostLike::where('post_id', $postId)
            ->where(function($query) use ($userId, $ipAddress) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('ip_address', $ipAddress);
                }
            })
            ->first();

        if ($existingLike) {
            // If the user is toggling the same type, remove the like/dislike
            if ($existingLike->type === $request->type) {
                $existingLike->delete();
                $action = 'removed';
            } else {
                // Change the type
                $existingLike->update(['type' => $request->type]);
                $action = 'changed';
            }
        } else {
            // Create a new like/dislike
            PostLike::create([
                'post_id' => $postId,
                'user_id' => $userId,
                'ip_address' => $ipAddress,
                'type' => $request->type
            ]);
            $action = 'added';
        }

        // Return the updated counts
        $post->refresh();
        $likesCount = $post->getLikesCountAttribute();
        $dislikesCount = $post->getDislikesCountAttribute();
        $netLikes = $post->getNetLikesAttribute();

        return response()->json([
            'success' => true,
            'action' => $action,
            'type' => $request->type,
            'counts' => [
                'likes' => $likesCount,
                'dislikes' => $dislikesCount,
                'net' => $netLikes
            ]
        ]);
    }

    /**
     * Get the like/dislike counts for a post
     */
    public function getLikeCounts($postId)
    {
        $post = Post::findOrFail($postId);
        
        $likesCount = $post->getLikesCountAttribute();
        $dislikesCount = $post->getDislikesCountAttribute();
        $netLikes = $post->getNetLikesAttribute();

        return response()->json([
            'post_id' => $postId,
            'counts' => [
                'likes' => $likesCount,
                'dislikes' => $dislikesCount,
                'net' => $netLikes
            ]
        ]);
    }
}
