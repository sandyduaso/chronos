<?php

namespace Submission\Support\Traits;

use Illuminate\Http\Request;
use Submission\Models\Submission;

trait CanViewResultTrait
{
    /**
     * View the results of a given resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function result(Request $request, $id)
    {
        $resource = Submission::findOrFail($id);

        return view("Submission::submissions.result")->with(compact('resource'));
    }
}
