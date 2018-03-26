<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tutorial;
use BroQiang\LaravelMarkdown\Markdown;
use Illuminate\Http\Request;

class TutorialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tutorials = Tutorial::get();

        return view('tutorials.index', compact('tutorials'));
    }

    public function show(Tutorial $tutorial)
    {
        $tutorial->allArticles();

        return view('tutorials.show', compact('tutorial'));
    }

    public function article(Request $request, Tutorial $tutorial, Article $article)
    {
        // 强制 url 带有 slug，如果没有就 301 重定向
        if (!empty($article->slug) && $article->slug != $request->slug) {
            return redirect($article->link($tutorial), 301);
        }

        $tutorial->allArticles();
        $article->body = (new Markdown())->convertMarkdownToHtml($article->body);
        return view('tutorials.show', compact(['tutorial', 'article']));
    }
}
