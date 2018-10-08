<?php

namespace Submission\Support\Traits;

use Illuminate\Http\Request;
use Submission\Models\Submission;

trait SubmissionResourceSoftDeleteTrait
{
    /**
     * Display a listing of the trashed resource.
     *
     * @return Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $resources = Submission::onlyTrashed()
                         ->search($request->all())
                         ->paginate();

        return view("Submission::submissions.trashed")->with(compact('resources'));
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
        $submissions = Submission::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($submissions as $submission) {
            $submission->restore();
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
        $submissions = Submission::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($submissions as $submission) {
            $submission->forceDelete();
        }

        return back();
    }
}
