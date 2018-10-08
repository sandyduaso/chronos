<?php

namespace Fieldtype\Controllers;

use Crowfeather\Traverser\Traverser;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Fieldtype\Models\Fieldtype;
use Fieldtype\Requests\FieldtypeRequest;
use Fieldtype\Support\Traits\FieldtypeResourceApiTrait;
use Fieldtype\Support\Traits\FieldtypeResourcePublicTrait;
use Fieldtype\Support\Traits\FieldtypeResourceSoftDeleteTrait;

class FieldtypeController extends GeneralController
{
    use FieldtypeResourcePublicTrait, FieldtypeResourceSoftDeleteTrait, FieldtypeResourceApiTrait;

    /**
     * Show list of resources.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Fieldtype::search($request->all())->paginate();
        // $trashed = Fieldtype::onlyTrashed()->count();

        return view("Fieldtype::fieldtypes.index")->with(compact('resources'));
    }

    /**
     * Show a given fieldtype resource.
     *
     * @param  Request $request
     * @param  string  $slug
     * @param  int     $id
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $resource = Fieldtype::findOrFail($id);

        return view("Fieldtype::fieldtypes.show")->with(compact('resource'));
    }

    /**
     * Show the fieldtype for creating a new resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view("Fieldtype::fieldtypes.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Fieldtype\Requests\FieldtypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fieldtype = new Fieldtype();
        $fieldtype->name = $request->input('name');
        $fieldtype->code = $request->input('code');
        $fieldtype->template = $request->input('template');
        $fieldtype->save();

        return back();
    }

    /**
     * Show the fieldtype for editing the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // $resource = Fieldtype::lockForUpdate()->findOrFail($id);
        $resource = Fieldtype::findOrFail($id);

        return view("Fieldtype::fieldtypes.edit")->with(compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Fieldtype\Requests\FieldtypeRequest  $request
     * @param  \Fieldtype\Models\Fieldtype  $fieldtype
     * @return \Illuminate\Http\Response
     */
    public function update(FieldtypeRequest $request, $id)
    {
        // dd($request->all());
        $fieldtype = Fieldtype::findOrFail($id);
        $fieldtype->name = $request->input('name');
        $fieldtype->code = $request->input('code');
        $fieldtype->template = $request->input('template');
        $fieldtype->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        Fieldtype::destroy($request->has('id') ? $request->input('id') : $id);

        return back();
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $resources = Fieldtype::onlyTrashed()->paginate();

        return view("Theme::fieldtypes.trashed")->with(compact('resources'));
    }
}
