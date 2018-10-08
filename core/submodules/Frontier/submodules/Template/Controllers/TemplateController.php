<?php

namespace Template\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Template\Models\Template;
use Template\Requests\TemplateRequest;

class TemplateController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        return view("Theme::templates.index");
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

        return view("Theme::templates.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::templates.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Template\Requests\TemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TemplateRequest $request)
    {
        //

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
        //

        return view("Theme::templates.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Template\Requests\TemplateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TemplateRequest $request, $id)
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
    public function destroy(Request $request, $id)
    {
        //

        return redirect()->route('templates.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::templates.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Template\Requests\TemplateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(TemplateRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Template\Requests\TemplateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(TemplateRequest $request, $id)
    {
        //

        return redirect()->route('templates.trash');
    }
}
