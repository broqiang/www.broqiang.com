<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tutorial;
use App\Observers\ArticleObserver;
use App\Observers\CommentObserver;
use App\Observers\PostObserver;
use App\Observers\TutorialObservers;
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
        Article::observe(ArticleObserver::class);
        Tutorial::observe(TutorialObservers::class);
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
