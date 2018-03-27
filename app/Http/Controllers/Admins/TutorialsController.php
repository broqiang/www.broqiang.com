<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\TutorialRequest;
use App\Models\Category;
use App\Models\Tutorial;
use BroQiang\LaravelImage\BroImage;
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
        $tutorials = Tutorial::orderBy('sort', 'desc')->with('category')->paginate(10);
        return view('admins.tutorials.index', compact('tutorials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoris = Category::orderBy('sort', 'desc')->get();
        return view('admins.tutorials.create_edit', compact('categoris'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TutorialRequest $request)
    {
        Tutorial::create(array_filter($request->all()));

        return redirect(route('admins.tutorials.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tutorial $tutorial)
    {
        $tutorial->allArticles();

        return view('admins.tutorials.show', compact('tutorial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tutorial $tutorial)
    {
        $categoris = Category::orderBy('sort', 'desc')->get();
        return view('admins.tutorials.create_edit', compact(['categoris', 'tutorial']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TutorialRequest $request, Tutorial $tutorial)
    {
        $tutorial->update($tutorial->dataFilter($request->all()));

        return redirect(route('admins.tutorials.index'))->with('message', '保存成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutorial $tutorial)
    {
        $tutorial->delete();
        return back()->with('message', '删除成功！');
    }

    public function upload(Request $request, BroImage $image, Tutorial $tutorial)
    {
        $res = $image->setConfig(['max_size' => 128])->validateUpload($request, 'title_page');

        if ($res) {
            return $res;
        }

        $res = $image->upload($request->title_page);

        $tutorial->update(['title_page' => $res['url']]);

        return $res;
    }
}
