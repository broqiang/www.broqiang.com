<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function show(Request $request, Skill $skill, Post $post)
    {
        $posts = $post->withOrder($request->order)->where('skill_id', $skill->id)->paginate(10);
        return view('posts.index', compact('posts'));
    }

}
