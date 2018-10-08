<?php

namespace Submission\Controllers;

use Form\Models\Form;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;
use Submission\Models\Submission;
use Submission\Requests\SubmissionRequest;
use Submission\Support\Traits\CanExportResultTrait;
use Submission\Support\Traits\CanViewResultTrait;
use Submission\Support\Traits\SubmissionMutatorTrait;
use Submission\Support\Traits\SubmissionResourceApiTrait;
use Submission\Support\Traits\SubmissionResourcePublicTrait;
use Submission\Support\Traits\SubmissionResourceSoftDeleteTrait;
use User\Models\User;

class SubmissionController extends GeneralController
{
    use CanExportResultTrait,
        CanViewResultTrait,
        SubmissionResourcePublicTrait,
        SubmissionResourceSoftDeleteTrait,
        SubmissionMutatorTrait,
        SubmissionResourceApiTrait;

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $form = Form::search($request->all())->paginate();

        return view("Theme::submissions.index")->with(compact('form'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        $form = Form::findOrFail($id);
        $resources = $form->submissions;

        if (! $form->submissions->count()) {
            abort(404);
        }

        return view("Theme::submissions.show")->with(compact('resources', 'form', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("Theme::submissions.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Submission\Requests\SubmissionRequest  $request
     * @return Illuminate\Http\Response
     */
    public function submit(SubmissionRequest $request)
    {
        $submission = new Submission();
        $submission->results = serialize($request->except(['_token', 'form_id', 'type']));
        $submission->form()->associate(Form::find($request->input('form_id')));
        $submission->user()->associate(User::find(user()->id));
        $submission->save();

        return back();
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
        //
        return view("Theme::submissions.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Submission\Requests\SubmissionRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(SubmissionRequest $request, $id)
    {
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Submission::destroy($request->has('id') ? $request->input('id') : $id);

        return back();
    }
}
