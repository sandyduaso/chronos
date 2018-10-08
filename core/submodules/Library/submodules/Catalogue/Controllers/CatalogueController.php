<?php

namespace Catalogue\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Catalogue\Models\Catalogue;
use Catalogue\Requests\CatalogueRequest;

class CatalogueController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trashed = Catalogue::onlyTrashed()->count();

        return view("Theme::catalogues.index")->with(compact('trashed'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //

        return view("Theme::catalogues.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::catalogues.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Catalogue\Requests\CatalogueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatalogueRequest $request)
    {
        $catalogue = new Catalogue();
        $catalogue->name = $request->input('name');
        $catalogue->code = $request->input('code');
        $catalogue->alias = $request->input('alias');
        $catalogue->icon = $request->input('icon');
        $catalogue->description = $request->input('description');
        $catalogue->save();

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $resource = Catalogue::findOrFail($id);

        return view("Theme::catalogues.edit")->with(compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Catalogue\Requests\CatalogueRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CatalogueRequest $request, $id)
    {
        $catalogue = Catalogue::findOrFail($id);
        $catalogue->name = $request->input('name');
        $catalogue->code = $request->input('code');
        $catalogue->alias = $request->input('alias');
        $catalogue->icon = $request->input('icon');
        $catalogue->description = $request->input('description');
        $catalogue->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        return redirect()->route('catalogues.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::catalogues.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Catalogue\Requests\CatalogueRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(CatalogueRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Catalogue\Requests\CatalogueRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(CatalogueRequest $request, $id)
    {
        //

        return redirect()->route('catalogues.trash');
    }
}
