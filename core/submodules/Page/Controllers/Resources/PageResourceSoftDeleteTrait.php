<?php

namespace Page\Controllers\Resources;

use Illuminate\Http\Request;
use Page\Models\Page;

trait PageResourceSoftDeleteTrait
{
    /**
     * Display a listing of the trashed resource.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $resources = Page::onlyTrashed()
                         ->search($request->all())
                         ->paginate();

        return view("Page::pages.trashed")->with(compact('resources'));
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
        $pages = Page::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($pages as $page) {
            $page->restore();
        }

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $pages = Page::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($pages as $page) {
            $page->forceDelete();
        }

        return back();
    }
}
