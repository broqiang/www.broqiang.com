<?php
namespace App\Observers;

use App\Models\Comment;
use Illuminate\Support\Carbon;

class CommentObserver
{
    public function created(Comment $comment)
    {
        $post = $comment->post;
        
        // 回复数+1
        $post->increment('comment_count', 1);

        // 更新文章的最后更新时间
        $post->update(['updated_at'=>Carbon::now()]);

    }
}
