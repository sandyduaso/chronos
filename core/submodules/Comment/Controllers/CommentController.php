<?php

namespace Comment\Controllers;

use Comment\Models\Comment;
use Comment\Requests\CommentOwnerRequest;
use Comment\Requests\CommentRequest;
use Comment\Support\Traits\CommentResourceApiTrait;
use Comment\Support\Traits\CommentResourcePublicTrait;
use Comment\Support\Traits\CommentResourceSoftDeleteTrait;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class CommentController extends GeneralController
{
    use CommentResourceApiTrait,
        CommentResourcePublicTrait,
        CommentResourceSoftDeleteTrait;

    /**
     * The view hintpath.
     *
     * @var string
     */
    protected $hintpath = 'Theme::comments';

    /**
     * The category type of the resource.
     *
     * @var string
     */
    protected $type = 'default';

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hintpath = $this->hintpath;
        $resources = Comment::type($this->type)->paginate();

        return view("$hintpath.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //

        return view("Theme::comments.show");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Comment\Requests\CommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->delta = $request->input('delta');
        $comment->user_id = $request->input('user_id');
        $comment->approved = 1;
        $comment->parent_id = $request->input('parent_id');
        $comment->commentable_id = $request->input('commentable_id');
        $comment->commentable_type = $request->input('commentable_type');
        $comment->save();

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $resource = Comment::findOrFail($id);

        return view("Theme::comments.edit")->with(compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Comment\Requests\CommentOwnerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentOwnerRequest $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->body = $request->input('body');
        $comment->delta = $request->input('delta');
        $comment->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Comment::destroy($request->has('id') ? $request->input('id') : $id);

        return back();
    }
}
