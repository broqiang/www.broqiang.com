<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Category;
use App\Models\Traits\Markdown;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    use Markdown;

    protected $fillable = ['title', 'description', 'sort', 'category_id', 'title_page', 'slug', 'auth'];

    protected $exceptFilterData = ['auth'];

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

    /**
     * 过滤数据，将为空的数据过滤，但是忽略 auth
     * @param  [type] $data [description]
     * @return [type] [description]
     */
    public function dataFilter($data)
    {
        return array_filter($data, function ($value, $key) {
            if (in_array($key, $this->exceptFilterData)) {
                return true;
            }
            if ($value) {
                return true;
            }
        }, ARRAY_FILTER_USE_BOTH);
    }

    public function isPublic()
    {
        return $this->auth;
    }
}
