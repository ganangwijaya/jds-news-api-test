<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->paginate(5);

        return new NewsResource(true, 'News Generated Successfully!', $news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
        $this->validate($request, [
            'imageUrl' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $image_path = $request->file('imageUrl')->store('news-image', 'public');
        $data = $request->all();
        $data['imageUrl'] = $image_path;
        $data['author'] = auth()->guard('api')->user()->email;

        $news = News::create($data);

        return new NewsResource(true, 'News Created Successfully!', $news);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {
            $news = News::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return new NewsResource(false, 'News Not Found', null);
        }

        $comments = Comment::where('newsId', '=', $id)->get();
        $data = $news;
        $data['comments'] = $comments;

        return new NewsResource(true, 'News Detail Generated Successfully!', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNewsRequest $request, News $news)
    {
        $this->validate($request, [
            'imageUrl' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $image_path = $request->file('imageUrl')->store('news-image', 'public');
        $data = $request->all();
        $data['imageUrl'] = $image_path;
        $data['author'] = auth()->guard('api')->user()->email;
        $news->update($data);

        return new NewsResource(true, 'News Updated Successfully!', $news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        try {
            $data = News::findOrFail($news->id);
        } catch (ModelNotFoundException $e) {
            return new NewsResource(false, 'News Not Found', null);
        }

        $image_path = public_path() . '/storage/' . $data->imageUrl;
        unlink($image_path);
        $data->delete();

        return new NewsResource(true, 'News Deleted Successfully!', $news);
    }
}
