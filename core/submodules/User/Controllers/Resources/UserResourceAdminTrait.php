<?php

namespace User\Controllers\Resources;

use Illuminate\Http\Request;
use Role\Models\Role;
use User\Models\User;
use User\Requests\UserRequest;

trait UserResourceAdminTrait
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resources = $this->repository;

        return view('User::admin.create')->with(compact('resources'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  User\Requests\UserRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // UserRequest
        $this->repository->create($request->all());

        return back();
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

        return view('User::admin.show')->with(compact('resource'));
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
        $resource = $this->repository->find($id);
        // $roles = Role::select('name', 'code', 'description', 'id');
        // if (! user()->isRoot()) {
        //     $roles = $roles->except(config('auth.rootroles', []));
        // }
        // $roles = $roles->get();

        return view('User::admin.edit')->with(compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  User\Requests\UserRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        // User
        $user = User::findOrFail($id);
        $user->prefixname = $request->input('prefixname');
        $user->firstname = $request->input('firstname');
        $user->middlename = $request->input('middlename');
        $user->lastname = $request->input('lastname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->avatar = $request->input('avatar');
        $user->save();

        // Role
        $user->roles()->sync($request->input('roles'));

        // Detail
        foreach (($request->input('details') ?? []) as $key => $value) {
            $user->details()->updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  mixed $id
     * @return Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        $this->repository->destroy($id ?? $request->input('id'));

        return redirect()->route('users.index');
    }
}
