<?php

namespace Page\Controllers\Resources;

use Catalogue\Models\Catalogue;
use Category\Models\Category;
use Illuminate\Http\Request;
use Page\Models\Page;
use Page\Requests\PageRequest;
use Template\Models\Template;
use User\Models\User;

trait PageResourceAdminTrait
{
    /**
     * Show list of resources.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Page::search($request->all())->paginate();

        return view("Page::pages.index")->with(compact('resources'));
    }

    /**
     * Show a given page resource.
     *
     * @param  Request $request
     * @param  int     $id
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $resource = Page::findOrFail($id);

        return view("Page::pages.show")->with(compact('resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $templates = Template::getTemplatesFromFiles('Page');
        $categories = Category::type('pages')->select(['name', 'icon', 'id'])->get();
        $catalogues = Catalogue::mediabox();

        return view("Page::pages.create")->with(compact('templates', 'categories', 'catalogues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Page\Requests\PageRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $page = new Page();
        $page->title = $request->input('title');
        $page->code = $request->input('code');
        $page->feature = $request->input('feature');
        $page->body = $request->input('body');
        $page->delta = $request->input('delta');
        $page->template = $request->input('template');
        $page->user()->associate(User::find(user()->id));
        $page->category()->associate(Category::find($request->input('category_id')));
        $page->save();

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
        $resource = Page::lockForUpdate()->findOrFail($id);
        $templates = Template::getTemplatesFromFiles();
        $categories = Category::type('pages')->select(['name', 'icon', 'id'])->get();
        $catalogues = Catalogue::mediabox();

        return view("Page::pages.edit")->with(compact('resource', 'templates', 'categories', 'catalogues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  Page\Models\Page  $page
     * @return Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->title = $request->input('title');
        $page->code = $request->input('code');
        $page->feature = $request->input('feature');
        $page->body = $request->input('body');
        $page->delta = $request->input('delta');
        $page->template = $request->input('template');
        $page->category()->associate(Category::find($request->input('category_id')));
        $page->save();

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
        Page::destroy($request->has('id') ? $request->input('id') : $id);

        return back();
    }
}
