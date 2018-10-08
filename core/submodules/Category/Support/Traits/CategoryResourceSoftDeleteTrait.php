<?php

namespace Category\Support\Traits;

use Category\Models\Category;
use Illuminate\Http\Request;

trait CategoryResourceSoftDeleteTrait
{
    /**
     * Display a listing of the trashed resource.
     *
     * @return Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $resources = Category::onlyTrashed()
                         ->search($request->all())
                         ->paginate();

        return view("Category::categories.trashed")->with(compact('resources'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function restore(Request $request, $id = null)
    {
        $categories = Category::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($categories as $category) {
            $category->restore();
        }

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $categories = Category::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($categories as $category) {
            $category->forceDelete();
        }

        return back();
    }
}
