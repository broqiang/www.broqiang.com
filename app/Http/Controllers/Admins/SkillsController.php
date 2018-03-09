<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use App\Models\Post;
use App\Models\Skill;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Skill $skill)
    {
        return view('admins.skills.index')
            ->with('skills', $skill->orderBy('sort', 'desc')->paginate(10));
    }

    public function show(Skill $skill, Post $post)
    {
        $posts = $post->with(['User', 'Skill', 'Visits'])
            ->orderBy('created_at', 'desc')
            ->where('skill_id', $skill->id)
            ->paginate(10);

        return view('admins.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.skills.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillRequest $request)
    {
        Skill::create(array_filter($request->all()));

        return redirect(route('admins.skills.index'))->with('message', '技能分类创建成功');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        return view('admins.skills.create_edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function update(SkillRequest $request, Skill $skill)
    {
        $skill->update($request->all());

        return redirect(route('admins.skills.index'))->with('message', '保存成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        $name = $skill->name;

        $skill->delete();

        return back()->with('message', $name . ' 已经删除');
    }
}
