<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * 搜索博客文章
     * @param  Request $request [description]
     * @return [type] [description]
     */
    public function posts(Request $request)
    {
        /**
         * 暂时数据量也不大，先用 like，等有空再看看是用分词还是什么
         */
        if ($request->has('query')) {
            return Post::where('title', 'like', '%' . $request->input('query') . '%')->limit(10)->get();
        }
    }
}
