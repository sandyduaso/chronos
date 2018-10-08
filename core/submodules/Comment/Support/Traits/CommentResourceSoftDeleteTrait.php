<?php

namespace Comment\Support\Traits;

use Comment\Models\Comment;
use Comment\Requests\CommentOwnerRequest;
use Illuminate\Http\Request;

trait CommentResourceSoftDeleteTrait
{
    /**
     * Display a listing of the trashed resource.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $resources = Comment::onlyTrashed()
                         ->search($request->all())
                         ->paginate();

        return view("Comment::comments.trashed")->with(compact('resources'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function restore(Request $request, $id = null)
    {
        $comments = Comment::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($comments as $comment) {
            $comment->restore();
        }

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Comment\Requests\CommentOwnerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(CommentOwnerRequest $request, $id)
    {
        $comments = Comment::withTrashed()
                           ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                           ->get();
        foreach ($comments as $comment) {
            $comment->forceDelete();
        }

        return back();
    }
}
