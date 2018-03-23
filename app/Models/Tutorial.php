<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    protected $fillable = ['title', 'description', 'sort', 'category_id', 'title_page', 'alias'];

    public function getRouteKeyName()
    {
        return 'alias';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
