<?php
namespace App\Observers;

use App\Models\Comment;
use Illuminate\Support\Carbon;

class CommentObserver
{
    public function created(Comment $comment)
    {
        $post = $comment->post;

        // 评论数+1
        $post->increment('comment_count', 1);

        // 更新文章的最后更新时间
        $post->update(['updated_at' => Carbon::now()]);
    }

    public function deleted(Comment $comment)
    {
        $post = $comment->post;
        
        // 删除时候评论数 -1
        if ($post->comment_count > 0) {
            $post->decrement('comment_count', 1);
        }
    }
}
