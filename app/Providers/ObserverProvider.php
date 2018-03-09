<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Observers\CommentObserver;
use App\Observers\PostObserver;
use Illuminate\Support\ServiceProvider;

class ObserverProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Comment::observe(CommentObserver::class);
        Post::observe(PostObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
