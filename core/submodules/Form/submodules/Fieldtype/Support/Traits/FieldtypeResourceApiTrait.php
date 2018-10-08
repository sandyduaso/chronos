<?php

namespace Fieldtype\Support\Traits;

use Illuminate\Http\Request;
use Fieldtype\Models\Fieldtype;
use Fieldtype\Requests\FieldtypeRequest;
use User\Models\User;

trait FieldtypeResourceApiTrait
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

        $resources = Fieldtype::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $fieldtypes = $resources->paginate($take);

        return response()->json($fieldtypes);
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

        $resources = Fieldtype::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $fieldtypes = $resources->paginate($take);

        return response()->json($fieldtypes);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  Fieldtype\Requests\FieldtypeRequest $request
     * @return Illuminate\Http\Response
     */
    public function postStore(FieldtypeRequest $request)
    {
        $fieldtype = new Fieldtype();
        $fieldtype->title = $request->input('title');
        $fieldtype->code = $request->input('code');
        $fieldtype->feature = $request->input('feature');
        $fieldtype->body = $request->input('body');
        $fieldtype->delta = $request->input('delta');
        $fieldtype->template = $request->input('template');
        $fieldtype->user()->associate(User::find($request->input('user_id')));
        $fieldtype->save();

        return response()->json($fieldtype->id);
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
        $fieldtype = Fieldtype::codeOrFail($slug);

        return response()->json($fieldtype);
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
        $fieldtype = Fieldtype::findOrFail($id);
        $fieldtype->title = $request->input('title');
        $fieldtype->code = $request->input('code');
        $fieldtype->feature = $request->input('feature');
        $fieldtype->body = $request->input('body');
        $fieldtype->delta = $request->input('delta');
        $fieldtype->template = $request->input('template');
        $fieldtype->user()->associate(User::find($request->input('user_id')));
        $fieldtype->save();

        return response()->json($fieldtype->id);
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
        $success = Fieldtype::destroy($id ? $id : $request->input('id'));

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
        $fieldtype = Fieldtype::onlyTrashed()->find($id);
        $fieldtype->exists() || $fieldtype->restore();

        if (is_array($request->input('id'))) {
            foreach ($request->input('id') as $id) {
                $fieldtype = Fieldtype::onlyTrashed()->find($id);
                $fieldtype->restore();
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
        $success = Fieldtype::forceDelete($id ? $id : $request->input('id'));

        return response()->json($success);
    }
}
