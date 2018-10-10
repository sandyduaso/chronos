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

        return view('User::admin.index')->with(compact('resources'));
    }
}
