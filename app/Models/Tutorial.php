<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    protected $fillable = ['title', 'description', 'sort', 'category_id', 'title_page', 'slug'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function allArticles()
    {
        return $this->load(['articles' => function ($query) {
            $query->where('pid', 0)
                ->select('id', 'title', 'sort', 'slug', 'pid', 'tutorial_id')
                ->orderBy('sort', 'asc')->orderBy('title', 'asc')
                ->with(['children_articles' => function ($query) {
                    $query->select('id', 'title', 'sort', 'slug', 'pid', 'tutorial_id')
                        ->orderBy('sort', 'asc')->orderBy('title', 'asc');
                }]);
        }]);
    }
}
