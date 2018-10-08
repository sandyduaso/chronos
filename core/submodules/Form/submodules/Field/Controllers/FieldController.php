<?php

namespace Field\Controllers;

use Crowfeather\Traverser\Traverser;
use Field\Models\Field;
use Field\Requests\FieldRequest;
use Field\Support\Traits\FieldResourceApiTrait;
use Field\Support\Traits\FieldResourcePublicTrait;
use Field\Support\Traits\FieldResourceSoftDeleteTrait;
use FieldType\Models\FieldType;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Template\Models\Template;
use User\Models\User;

class FieldController extends GeneralController
{
    use FieldResourcePublicTrait, FieldResourceSoftDeleteTrait, FieldResourceApiTrait;

    /**
     * Show list of resources.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Field::search($request->all())->paginate();
        $trashed = Field::onlyTrashed()->count();

        return view("Theme::fields.index")->with(compact('resources', 'trashed'));
    }

    /**
     * Show a given field resource.
     *
     * @param  Request $request
     * @param  string  $slug
     * @param  int     $id
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $resource = Field::findOrFail($id);

        $resource = Field($id);

        return view("Field::fields.show")->with(compact('resource'));
    }

    /**
     * Show the field for creating a new resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        return view("Field::fields.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Field\Requests\FieldRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FieldRequest $request)
    {
        //

        return back();
    }

    /**
     * Show the field for editing the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //

        return view("Field::fields.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  Field\Models\Field  $field
     * @return Illuminate\Http\Response
     */
    public function update(FieldRequest $request, $id)
    {
        //

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
        Field::destroy($request->has('id') ? $request->input('id') : $id);

        return back();
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $resources = Field::onlyTrashed()->paginate();

        return view("Theme::fields.trashed")->with(compact('resources'));
    }
}
