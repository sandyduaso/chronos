<?php

namespace Form\Support\Traits;

use Illuminate\Http\Request;
use Form\Models\Form;

trait FormResourceSoftDeleteTrait
{
    /**
     * Display a listing of the trashed resource.
     *
     * @return Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $resources = Form::onlyTrashed()
                         ->search($request->all())
                         ->paginate();

        return view("Form::forms.trashed")->with(compact('resources'));
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
        $forms = Form::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($forms as $form) {
            $form->restore();
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
        $forms = Form::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($forms as $form) {
            $form->forceDelete();
        }

        return back();
    }
}
