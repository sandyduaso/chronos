<?php

namespace Role\Controllers\Resources;

use Blacksmith\Support\Facades\Blacksmith;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Role\Requests\RoleRequest;

trait RoleResourceAdminTrait
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = $this->repository
            ->search($request->all())
            ->paginate();

        return view('Theme::roles.index')->with(compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $repository = $this->repository;

        return view('Theme::roles.create')->with(compact('repository'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Role\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->repository->create($request->all());

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
        $resource = $this->repository->find($id);
        $repository = $this->repository;

        return view('Theme::roles.edit')->with(compact('resource', 'repository'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Role\Requests\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = \Role\Models\Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->code = $request->input('code');
        $role->description = $request->input('description');
        $role->alias = $request->input('alias');
        $role->save();
        $role->permissions()->sync($request->input('permissions'));

        return back();
    }
}
