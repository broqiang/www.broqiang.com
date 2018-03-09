<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Comment $comment)
    {
        return view('admins.comments.index')
            ->with('comments', $comment->orderBy('created_at', 'desc')->paginate(10));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('admins.comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $this->validate($request, [
            'content' => 'required|string|min:5|max:128',
        ]);

        $comment->update(['content' => $request->content]);

        return redirect(route('admins.comments.index'))->with('message', '评论修改成功 ！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect(route('admins.comments.index'))->with('message', '评论删除成功 ！');
    }
}
