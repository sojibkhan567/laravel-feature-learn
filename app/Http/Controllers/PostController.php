<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // Eager load posts with comments and replies
        $posts = Post::with(['comments.replies', 'comments.user'])->get();

        return $posts;

        // Accessing nested relationships
        foreach ($posts as $post) {
            echo "Post: {$post->title}\n";

            foreach ($post->comments as $comment) {
                echo " - Comment: {$comment->body} (by {$comment->user->name})\n";

                foreach ($comment->replies as $reply) {
                    echo "   - Reply: {$reply->body}\n";
                }
            }
        }
    }

    /**
     * post & comment create method
     */
    public function store(Request $request)
    {
        // Create a reply to a comment
        $comment = Comment::find(1);
        $reply = $comment->replies()->create([
            'user_id' => auth()->id(),
            'body' => 'This is a reply to the comment'
        ]);

        // Or create directly
        Reply::create([
            'comment_id' => 1,
            'user_id' => auth()->id(),
            'body' => 'Another reply'
        ]);
    }
}
