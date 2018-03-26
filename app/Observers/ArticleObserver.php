<?php

namespace App\Observers;

use App\Handlers\SlugTranslateHandler;
use App\Models\Article;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ArticleObserver
{
    public function saving(Article $article)
    {
        if (!$article->slug) {
            $article->slug = app(SlugTranslateHandler::class)->translate($article->title);
        }
    }

    public function deleting(Article $article)
    {
        $article->where('pid', $article->id)->delete();
    }
}
