<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Request $request)
    {
        if ($request->has('skill_id')) {
            $post->where('skill_id', $request->$request);
        }

        $posts = $post->with(['User', 'Skill', 'Visits'])->orderBy('created_at', 'desc')->paginate(10);

        return view('admins.posts.index', compact('posts'));
    }

    public function edit(Post $post)
    {
        return view('admins.posts.create_edit')
            ->with('skills', Skill::orderBy('sort', 'desc')->get())
            ->with('post', $post);
    }

    public function update(Post $post, PostRequest $request)
    {
        $post->update($request->all());

        return redirect(route('admins.posts.index'));
    }

    public function create()
    {
        return view('admins.posts.create_edit')
            ->with('skills', Skill::orderBy('sort', 'desc')->get());
    }

    public function store(PostRequest $request)
    {
        $data            = $request->all();
        $data['user_id'] = Auth::id();

        Post::create($data);

        return redirect(route('admins.posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $title = $post->title;
        $post->follows()->detach();
        $post->comments()->delete();
        $post->delete();

        return back()->with('message', $title . ' 已经删除 ! ');
    }
}
