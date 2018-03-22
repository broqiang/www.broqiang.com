<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function create(Tutorial $tutorial)
    {
        return view('admins.articles.create', compact('tutorial'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
