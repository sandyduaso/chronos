<?php

namespace Fieldtype\Support\Traits;

use Illuminate\Http\Request;
use Fieldtype\Models\Fieldtype;

trait FieldtypeResourceSoftDeleteTrait
{
    /**
     * Display a listing of the trashed resource.
     *
     * @return Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $resources = Fieldtype::onlyTrashed()
                         ->search($request->all())
                         ->paginate();

        return view("Fieldtype::fieldtypes.trashed")->with(compact('resources'));
    }

    /**```
     * Restore the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function restore(Request $request, $id = null)
    {
        $fieldtypes = Fieldtype::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($fieldtypes as $fieldtype) {
            $fieldtype->restore();
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
        $fieldtypes = Fieldtype::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($fieldtypes as $fieldtype) {
            $fieldtype->forceDelete();
        }

        return back();
    }
}
