<?php
namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function retrieved(Post $post)
    {
        if (url()->current() != route('admins.posts.index')) {
            $post->increment('view_count', 1);
        }
    }

    public function created(Post $post)
    {
        // 每次发布博客，所属分类下的博客+1
        $post->skill->increment('post_count', 1);
    }

    public function deleted(Post $post)
    {
        $skill = $post->skill;

        if ($skill->post_count > 1) {
            $skill->decrement('post_count', 1);
        }
    }
}
