<?php

namespace Category\Controllers;

use Category\Models\Category;
use Category\Requests\CategoryRequest;
use Category\Support\Traits\CategoryResourceApiTrait;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class CategoryController extends GeneralController
{
    use CategoryResourceApiTrait;

    /**
     * The view hintpath.
     *
     * @var string
     */
    protected $hintpath;

    /**
     * The category type of the resource.
     *
     * @var string
     */
    protected $type;

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Category::type($this->type)->paginate();

        return view("{$this->hintpath}::categories.index")->with(compact('resources', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Category\Requests\CategoryRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->alias = $request->input('alias');
        $category->code = $request->input('code');
        $category->description = $request->input('description');
        $category->icon = $request->input('icon');
        $category->type = $request->input('type');
        $category->save();

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $type = $this->type;
        $hintpath = $this->hintpath;
        $resource = Category::findOrFail($id);

        return view("{$hintpath}::categories.edit")->with(compact('resource', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Category\Requests\CategoryRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->alias = $request->input('alias');
        $category->code = $request->input('code');
        $category->description = $request->input('description');
        $category->icon = $request->input('icon');
        $category->type = $request->input('type');
        $category->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        Category::destroy($request->has('id') ? $request->input('id') : $id);

        return back();
    }
}
