<?php

namespace User\Controllers\Resources;

use Illuminate\Http\Request;
use User\Models\User;

trait UserResourceSoftDeleteTrait
{
    /**
     * Display a listing of the trashed resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $resources = $this->repository
            ->search($request->all())
            ->onlyTrashed()
            ->paginate();

        return view('User::admin.trashed')->with(compact('resources'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id = null)
    {
        $this->repository->restore(
            $request->has('id') ? $request->input('id') : [$id]
        );

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id = null)
    {
        $this->repository->delete(
            $request->has('id') ? $request->input('id') : [$id]
        );

        return back();
    }
}
