<?php

namespace Category\Support\Traits;

use Illuminate\Http\Request;
use Category\Models\Category;
use Category\Requests\CategoryRequest;
use User\Models\User;

trait CategoryResourceApiTrait
{
    /**
     * Retrieve the resource(s) with the parameters.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string $type
     * @return Illuminate\Http\Response
     */
    public function postFind(Request $request, $type)
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

        $resources = Category::search($searches)->type($type)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $categories = $resources->paginate($take);

        return response()->json($categories);
    }

    /**
     * Retrieve list of resources.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string $type
     * @return Illuminate\Http\Response
     */
    public function getAll(Request $request, $type)
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

        $resources = Category::search($searches)->type($type)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $categories = $resources->paginate($take);

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  Category\Requests\CategoryRequest $request
     * @param  string $type
     * @return Illuminate\Http\Response
     */
    public function postStore(CategoryRequest $request, $type)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->alias = $request->input('alias');
        $category->code = $request->input('code');
        $category->description = $request->input('description');
        $category->icon = $request->input('icon');
        $category->type = $request->input('type');
        $category->save();

        return response()->json($category->id);
    }

    /**
     * Retrieve the resource specified by the slug.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string $type
     * @param  string  $slug
     * @return Illuminate\Http\Response
     */
    public function getShow(Request $request, $type, $slug = null)
    {
        $category = Category::type($type)->codeOrFail($slug);

        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Role\Requests\RoleRequest  $request
     * @param  string $type
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function putUpdate(Request $request, $type, $id)
    {
        $category = Category::type($type)->findOrFail($id);
        $category->name = $request->input('name');
        $category->alias = $request->input('alias');
        $category->code = $request->input('code');
        $category->description = $request->input('description');
        $category->icon = $request->input('icon');
        $category->type = $request->input('type');
        $category->save();

        return response()->json($category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  string $type
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function deleteDestroy(Request $request, $type, $id = null)
    {
        $success = Category::destroy($id ? $id : $request->input('id'));

        return response()->json($success);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  string $type
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function postRestore(Request $request, $type, $id = null)
    {
        $category = Category::onlyTrashed()->find($id);
        $category->exists() || $category->restore();

        if (is_array($request->input('id'))) {
            foreach ($request->input('id') as $id) {
                $category = Category::onlyTrashed()->find($id);
                $category->restore();
            }
        }

        return response()->json($success);
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  string $type
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function deleteDelete(Request $request, $type, $id = null)
    {
        $success = Category::forceDelete($id ? $id : $request->input('id'));

        return response()->json($success);
    }
}
