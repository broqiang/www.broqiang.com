<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    public function create(Request $request, Tutorial $tutorial)
    {
        $view = view('admins.articles.create', compact('tutorial'));

        if ($request->filled('pid')) {
            $view->with('pid', $request->pid);
        }

        return $view;
    }

    public function store(ArticleRequest $request, Tutorial $tutorial)
    {
        $data = array_filter($request->all());

        $data['tutorial_id'] = $tutorial->id;
        $data['user_id']     = Auth::id();

        $article = Article::create($data);

        return [
            'success' => 1,
            'message' => '保存成功！',
            'url'     => route('admins.articles.edit', [$tutorial->slug, $article->id]),
        ];
    }

    /**
     * 编辑文章标题
     * @param  Request $request [description]
     * @param  Article $article [description]
     * @return [type] [description]
     */
    public function edit_title(Tutorial $tutorial, Article $article)
    {
        return view('admins.articles.edit', compact(['tutorial', 'article']));
    }

    public function edit(Tutorial $tutorial, Article $article)
    {
        $tutorial->allArticles();

        return view('admins.tutorials.show', compact(['tutorial', 'article']));
    }

    public function update(ArticleRequest $request, Tutorial $tutorial, Article $article)
    {
        $article->update(array_filter($request->all()));

        return [
            'success' => 1,
            'message' => '保存成功！',
            'url'     => route('admins.articles.edit', [$tutorial->slug, $article->id]),
        ];
    }

    public function destroy(Tutorial $tutorial, Article $article)
    {
        $article->delete();
        return redirect(route('admins.tutorials.show', $tutorial->slug));
    }
}
