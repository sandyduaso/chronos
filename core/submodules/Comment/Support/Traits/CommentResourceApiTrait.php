<?php

namespace Comment\Support\Traits;

use Comment\Models\Comment;
use Comment\Requests\CommentRequest;
use Illuminate\Http\Request;

trait CommentResourceApiTrait
{
    /**
     * Retrieve the resource(s) with the parameters.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function postFind(Request $request)
    {
        $searches = $request->get('search') !== 'null' && $request->get('search')
                        ? $request->get('search')
                        : $request->all();

        $onlyTrashed = $request->get('only_trashed') !== 'null' && $request->get('only_trashed')
                        ? $request->get('only_trashed')
                        : false;

        $order = $request->get('descending') === 'true' && $request->get('descending') !== 'null'
                        ? 'DESC'
                        : 'ASC';

        $sort = $request->get('sort') && $request->get('sort') !== 'null'
                        ? $request->get('sort')
                        : 'id';

        $take = $request->get('take') && $request->get('take') > 0
                        ? $request->get('take')
                        : 0;

        $resources = Comment::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $comments = $resources->paginate($take);

        return response()->json($comments);
    }

    /**
     * Retrieve list of resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        $onlyTrashed = $request->get('only_trashed') !== 'null' && $request->get('only_trashed')
                        ? $request->get('only_trashed')
                        : false;

        $order = $request->get('descending') === 'true' && $request->get('descending') !== 'null'
                        ? 'DESC'
                        : 'ASC';

        $searches = $request->get('search') !== 'null' && $request->get('search')
                        ? $request->get('search')
                        : $request->all();

        $sort = $request->get('sort') && $request->get('sort') !== 'null'
                        ? $request->get('sort')
                        : 'id';

        $take = $request->get('take') && $request->get('take') > 0
                        ? $request->get('take')
                        : 0;

        $resources = Comment::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $comments = $resources->paginate($take);

        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  Comment\Requests\CommentRequest $request
     * @return Illuminate\Http\Response
     */
    public function postStore(CommentRequest $request)
    {
        $comment = new Comment();
        $comment->title = $request->input('title');
        $comment->code = $request->input('code');
        $comment->feature = $request->input('feature');
        $comment->body = $request->input('body');
        $comment->delta = $request->input('delta');
        $comment->template = $request->input('template');
        $comment->user()->associate(User::find($request->input('user_id')));
        $comment->save();

        return response()->json($comment->id);
    }

    /**
     * Retrieve the resource specified by the slug.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string  $slug
     * @return Illuminate\Http\Response
     */
    public function getShow(Request $request, $slug = null)
    {
        $comment = Comment::codeOrFail($slug);

        return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Role\Requests\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function putUpdate(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->title = $request->input('title');
        $comment->code = $request->input('code');
        $comment->feature = $request->input('feature');
        $comment->body = $request->input('body');
        $comment->delta = $request->input('delta');
        $comment->template = $request->input('template');
        $comment->user()->associate(User::find($request->input('user_id')));
        $comment->save();

        return response()->json($comment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteDestroy(Request $request, $id = null)
    {
        $success = Comment::destroy($id ? $id : $request->input('id'));

        return response()->json($success);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postRestore(Request $request, $id = null)
    {
        $comment = Comment::onlyTrashed()->find($id);
        $comment->exists() || $comment->restore();

        if (is_array($request->input('id'))) {
            foreach ($request->input('id') as $id) {
                $comment = Comment::onlyTrashed()->find($id);
                $comment->restore();
            }
        }

        return response()->json($success);
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteDelete(Request $request, $id = null)
    {
        $success = Comment::forceDelete($id ? $id : $request->input('id'));

        return response()->json($success);
    }
}
