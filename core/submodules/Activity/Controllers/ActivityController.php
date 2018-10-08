<?php

namespace Activity\Controllers;

use Activity\Models\Activity;
use Activity\Requests\ActivityRequest;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class ActivityController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        return view("Theme::activities.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //

        return view("Theme::activities.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::activities.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Activity\Requests\ActivityRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(ActivityRequest $request)
    {
        //

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
        //

        return view("Theme::activities.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Activity\Requests\ActivityRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(ActivityRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        return back();
    }
}
