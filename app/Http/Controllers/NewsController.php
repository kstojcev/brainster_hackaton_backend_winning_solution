<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\NewsEditRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'DESC')->paginate(10);
        $newsCount = News::get()->count();

        return view('news.index', compact('news', 'newsCount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\NewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $news = new News();
        $filePath = $this->UserImageUpload($request->file('image')); //passing parameter to our trait method one after another using foreach loop

        $news->title = $request->title;
        $news->description = $request->description;
        $news->image = $filePath;
        $news->save();

        return redirect()->route('dashboard.news')->with('created', 'News Article created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newsTemp = News::where('id', $id)->first();
        return view('news.edit', compact('newsTemp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\NewsRequest  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsEditRequest $request, $id)
    {
        if ($request->hasFile('image')) {
            $filePath = $this->UserImageUpload($request->file('image'));
            $news = News::where('id', $id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $filePath
            ]);
        } else {
            $news = News::find($id);
            $news->title = $request->title;
            $news->description = $request->description;
            $news->save();
        }

        return redirect()->route('dashboard.news')->with('edited', 'News Edited Successfully!');
    }

    // /**
    //  * Process the news image for upload to storage.
    //  *
    //  */
    public function UserImageUpload($query)
    {
        $image_name = Str::random(20);
        $ext = strtolower($query->getClientOriginalName());
        $image_full_name = $image_name . '.' . $ext;
        $upload_path = 'storage/news_images/';
        $image_url = $upload_path . $image_full_name;
        $success = $query->move($upload_path, $image_full_name);

        return $image_url;
    }
}
