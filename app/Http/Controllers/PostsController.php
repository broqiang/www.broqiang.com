<?php

namespace App\Http\Controllers;

use App\Models\Post;
use BroQiang\LaravelMarkdown\Markdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index(Post $post, Request $request, Markdown $markdown)
    {
        $posts = $post->withArchive($request->year)->withOrder($request->order)->paginate(10);

        foreach ($posts as &$post) {
            $post->excerpt = $markdown->convertMarkdownToHtml($post->excerpt);
        }

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post, Markdown $markdown, Request $request)
    {
        $post->visit($request);

        $post->body = $markdown->convertMarkdownToHtml($post->body);

        return view('posts.show', compact('post'));
    }

    /**
     * 关注
     * @param  Post $post [description]
     * @return [type] [description]
     */
    public function follow(Post $post)
    {
        $post->follows()->attach(Auth::id());
        $post->increment('follow_count', 1);

        return back()->with('message', '关注成功');
    }

    /**
     * 取消关注
     * @param  Post $post [description]
     * @return [type] [description]
     */
    public function unfollow(Post $post)
    {
        $rs = $post->follows()->detach(Auth::id());
        if ($post->follow_count > 0) {
            $post->decrement('follow_count', 1);
        }

        return back()->with('message', '已经取消关注');
    }

    public function comment(Post $post, Request $request)
    {
        $this->validate($request, [
            'content' => 'required|string|min:5|max:256',
        ]);

        $comment            = $request->all();
        $comment['post_id'] = $post->id;
        $comment['user_id'] = Auth::id();

        $post->comments()->create($comment);

        return back()->with('success', '评论成功 ！');
    }
}
