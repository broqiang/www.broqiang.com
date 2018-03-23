<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'alias', 'pid', 'user_id', 'tutorial_id', 'sort'];

    public function getRouteKeyName()
    {
        return 'alias';
    }

    public function children_articles()
    {
        return $this->hasMany(Article::class, 'pid');
    }

    public function parent_article()
    {

    }
}
