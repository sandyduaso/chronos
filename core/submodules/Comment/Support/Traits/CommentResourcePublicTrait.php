<?php

namespace Comment\Support\Traits;

use Comment\Models\Comment;
use Illuminate\Http\Request;

trait CommentResourcePublicTrait
{
    /**
     * Retrieve list of all resources.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $resources = Comment::search($request->all())->all();

        return view("Theme::comments.all")->with(compact('resources'));
    }

    /**
     * Try to retrieve the resource of the given slug.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $code
     * @return \Illuminate\Http\Response
     */
    public function single(Request $request, $code = null)
    {
        //
        return view("Theme::comments.show");
    }
}
