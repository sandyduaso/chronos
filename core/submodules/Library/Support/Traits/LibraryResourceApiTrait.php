<?php

namespace Library\Support\Traits;

use Illuminate\Http\Request;
use Library\Models\Library;
use Library\Requests\LibraryRequest;
use User\Models\User;

trait LibraryResourceApiTrait
{
    /**
     * Retrieve the resource with the parameters.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function postFind(Request $request)
    {
        $parameters = $request->get('search') !== 'null' && $request->get('search')
                        ? $request->get('search')
                        : $request->all();

        if ($request->get('type')) {
            $resources->type($request->get('type'));
        }

        $library = Library::search($parameters)->first();

        return response()->json($library);
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

        $parameters = $request->get('search') !== 'null' && $request->get('search')
                        ? $request->get('search')
                        : $request->all();

        $sort = $request->get('sort') && $request->get('sort') !== 'null'
                        ? $request->get('sort')
                        : 'id';

        $take = $request->get('take') && $request->get('take') > 0
                        ? $request->get('take')
                        : 0;

        $resources = Library::search($parameters)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        if ($request->get('type')) {
            $resources->type($request->get('type'));
        }

        $libraries = $resources->paginate($take);

        return response()->json($libraries);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  Library\Requests\LibraryRequest $request
     * @return Illuminate\Http\Response
     */
    public function postStore(LibraryRequest $request)
    {
        // $library = new Library();
        // $library->title = $request->input('title');
        // $library->code = $request->input('code');
        // $library->feature = $request->input('feature');
        // $library->body = $request->input('body');
        // $library->delta = $request->input('delta');
        // $library->template = $request->input('attributes')['template'] ?? 'generic';
        // $library->user()->associate(User::find($request->input('user_id') ?? user()->id));
        // $library->save();

        // return response()->json($library->id);
        return null;
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
        $library = Library::codeOrFail($slug);

        return response()->json($library);
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
        // $library = Library::findOrFail($id);
        // $library->title = $request->input('title');
        // $library->code = $request->input('code');
        // $library->feature = $request->input('feature');
        // $library->body = $request->input('body');
        // $library->delta = $request->input('delta');
        // $library->template = $request->input('template');
        // $library->user()->associate(User::find($request->input('user_id')));
        // $library->save();

        // return response()->json($library->id);
        return null;
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
        $status = Library::destroy($request->has('id') ? $request->input('id') : $id);

        return response()->json($status);
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
        $library = Library::onlyTrashed()->find($id);
        $library->exists() || $library->restore();

        if (is_array($request->input('id'))) {
            foreach ($request->input('id') as $id) {
                $library = Library::onlyTrashed()->find($id);
                $library->exists() || $library->restore();
            }
        }

        $status = true;

        return response()->json($status);
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
        $status = Library::forceDelete($id ? $id : $request->input('id'));

        return response()->json($status);
    }
}
