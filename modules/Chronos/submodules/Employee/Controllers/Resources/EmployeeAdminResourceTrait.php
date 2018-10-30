<?php

namespace Employee\Controllers\Resources;

use Illuminate\Http\Request;

trait EmployeeAdminResourceTrait
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

        return view('Employee::admin.index')->with(compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resources = $this->repository;

        return view('Employee::admin.create')->with(compact('resources'));
    }
}
