<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'slug', 'pid', 'user_id', 'tutorial_id', 'sort'];

    public function children_articles()
    {
        return $this->hasMany(Article::class, 'pid');
    }
}
