<?php

namespace Timesheet\Controllers\Resources;

use Illuminate\Http\Request;
use Timesheet\Requests\TimesheetRequest;

trait TimesheetResourceAdminTrait
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = $this->repository
            ->search($request->all())
            ->paginate();

        return view('Timesheet::admin.index')->with(compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $resources = null; // $request;

        return view('Timesheet::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Timesheet\Requests\TimesheetRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(TimesheetRequest $request)
    {
        $resource = $this->repository->store($request->all());

        return redirect()->route('timesheets.show', $resource->id);
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
        $resource = $this->repository->find($id);

        return view('Timesheet::admin.show')->with(compact('resource'));
    }

    /* Show the form for editing the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $resource = $this->repository->find($id);

        return view('Timesheet::admin.edit')->with(compact('resource'));
    }
}
