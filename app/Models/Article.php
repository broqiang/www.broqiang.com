<?php

namespace App\Models;

use App\Models\Traits\Markdown;
use App\Models\Tutorial;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Markdown;
    
    protected $fillable = ['title', 'body', 'slug', 'pid', 'user_id', 'tutorial_id', 'sort'];

    public function children_articles()
    {
        return $this->hasMany(Article::class, 'pid');
    }

    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class);
    }

    public function link(Tutorial $tutorial,$params = [])
    {
        return route('tutorials.article', array_merge([$tutorial->slug, $this->id, $this->slug], $params));
    }
}
