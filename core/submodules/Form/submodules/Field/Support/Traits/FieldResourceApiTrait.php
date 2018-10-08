<?php

namespace Field\Support\Traits;

use Illuminate\Http\Request;
use Field\Models\Field;
use Field\Requests\FieldRequest;
use User\Models\User;

trait FieldResourceApiTrait
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

        $resources = Field::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $fields = $resources->paginate($take);

        return response()->json($fields);
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

        $resources = Field::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $fields = $resources->paginate($take);

        return response()->json($fields);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  Field\Requests\FieldRequest $request
     * @return Illuminate\Http\Response
     */
    public function postStore(FieldRequest $request)
    {
        $field = new Field();
        $field->title = $request->input('title');
        $field->code = $request->input('code');
        $field->feature = $request->input('feature');
        $field->body = $request->input('body');
        $field->delta = $request->input('delta');
        $field->template = $request->input('template');
        $field->user()->associate(User::find($request->input('user_id')));
        $field->save();

        return response()->json($field->id);
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
        $field = Field::codeOrFail($slug);

        return response()->json($field);
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
        $field = Field::findOrFail($id);
        $field->title = $request->input('title');
        $field->code = $request->input('code');
        $field->feature = $request->input('feature');
        $field->body = $request->input('body');
        $field->delta = $request->input('delta');
        $field->template = $request->input('template');
        $field->user()->associate(User::find($request->input('user_id')));
        $field->save();

        return response()->json($field->id);
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
        $success = Field::destroy($id ? $id : $request->input('id'));

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
        $field = Field::onlyTrashed()->find($id);
        $field->exists() || $field->restore();

        if (is_array($request->input('id'))) {
            foreach ($request->input('id') as $id) {
                $field = Field::onlyTrashed()->find($id);
                $field->restore();
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
        $success = Field::forceDelete($id ? $id : $request->input('id'));

        return response()->json($success);
    }
}
