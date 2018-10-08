<?php

namespace Form\Support\Traits;

use Illuminate\Http\Request;
use Form\Models\Form;
use Form\Requests\FormRequest;
use User\Models\User;

trait FormResourceApiTrait
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

        $resources = Form::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $forms = $resources->paginate($take);

        return response()->json($forms);
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

        $resources = Form::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $forms = $resources->paginate($take);

        return response()->json($forms);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  Form\Requests\FormRequest $request
     * @return Illuminate\Http\Response
     */
    public function postStore(FormRequest $request)
    {
        $form = new Form();
        $form->title = $request->input('title');
        $form->code = $request->input('code');
        $form->feature = $request->input('feature');
        $form->body = $request->input('body');
        $form->delta = $request->input('delta');
        $form->template = $request->input('template');
        $form->user()->associate(User::find($request->input('user_id')));
        $form->save();

        return response()->json($form->id);
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
        $form = Form::codeOrFail($slug);

        return response()->json($form);
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
        $form = Form::findOrFail($id);
        $form->title = $request->input('title');
        $form->code = $request->input('code');
        $form->feature = $request->input('feature');
        $form->body = $request->input('body');
        $form->delta = $request->input('delta');
        $form->template = $request->input('template');
        $form->user()->associate(User::find($request->input('user_id')));
        $form->save();

        return response()->json($form->id);
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
        $success = Form::destroy($id ? $id : $request->input('id'));

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
        $form = Form::onlyTrashed()->find($id);
        $form->exists() || $form->restore();

        if (is_array($request->input('id'))) {
            foreach ($request->input('id') as $id) {
                $form = Form::onlyTrashed()->find($id);
                $form->restore();
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
        $success = Form::forceDelete($id ? $id : $request->input('id'));

        return response()->json($success);
    }

    /**
     * Retrieve all forms in media array.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getMedia(Request $request)
    {
        $forms = Form::type($request->get('type'))->paginate();
        $fo = [];
        foreach ($forms->items() as $i => $form) {
            $fo[$i]['name'] = $form->name;
            $fo[$i]['id'] = $form->id;
            $fo[$i]['contentable_id'] = $form->id;
            $fo[$i]['contentable_type'] = get_class($form);
        }

        return response()->json($fo);
    }
}
