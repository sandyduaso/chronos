<?php

namespace Field\Support\Traits;

use Illuminate\Http\Request;
use Field\Models\Field;

trait FieldResourceSoftDeleteTrait
{
    /**
     * Display a listing of the trashed resource.
     *
     * @return Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $resources = Field::onlyTrashed()
                         ->search($request->all())
                         ->paginate();

        return view("Field::fields.trashed")->with(compact('resources'));
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
        $fields = Field::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($fields as $field) {
            $field->restore();
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
        $fields = Field::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($fields as $field) {
            $field->forceDelete();
        }

        return back();
    }
}
