<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = Comment::latest()->paginate(5);

        return new CommentResource(true, 'Comments Generated Successfully', $comment);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $data = $request->all();

        try {
            $comment = Comment::findOrFail($data['newsId']);
        } catch (ModelNotFoundException $e) {
            return new CommentResource(false, 'News Not Found', null);
        }

        $data['userEmail'] = auth()->guard('api')->user()->email;

        $comment = Comment::create($data);

        return new CommentResource(true, 'Comment Added to News Successfully!', $comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $comment = Comment::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return new CommentResource(false, 'Comment Not Found', null);
        }

        return new CommentResource(true, 'Comment Details Generated Successfully!', $comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCommentRequest $request, Comment $comment)
    {
        $data = $request->all();
        $data['userEmail'] = auth()->guard('api')->user()->email;

        $comment->update($data);

        return new CommentResource(true, 'Comment Updated Successfully!', $comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return new CommentResource(true, 'Comment Deleted Successfully!', $comment);
    }
}
