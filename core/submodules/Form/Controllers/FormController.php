<?php

namespace Form\Controllers;

use Crowfeather\Traverser\Traverser;
use Field\Models\Field;
use Fieldtype\Models\Fieldtype;
use Form\Models\Form;
use Form\Requests\FormRequest;
use Form\Support\Traits\FormResourceApiTrait;
use Form\Support\Traits\FormResourcePublicTrait;
use Form\Support\Traits\FormResourceSoftDeleteTrait;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Template\Models\Template;
use User\Models\User;

class FormController extends GeneralController
{
    use FormResourcePublicTrait,
        FormResourceSoftDeleteTrait,
        FormResourceApiTrait;

    /**
     * Show list of resources.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Form::search($request->all())->paginate();
        $trashed = Form::onlyTrashed()->count();

        return view("Form::forms.index")->with(compact('resources', 'trashed'));
    }

    /**
     * Show a given form resource.
     *
     * @param  Request $request
     * @param  string  $slug
     * @param  int     $id
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // dd($request->all());
        $resource = Form::findOrFail($id);
        $form = \Form\Models\Form::find($id);
        // $builder = new \Form\Support\Builder\FormBuilder($form, $form->fields, 'Form::templates.test');

        return view("Form::forms.show")->with(compact('resource', 'form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = Template::getTemplatesFromFiles();
        $fieldtypes = Fieldtype::all();

        return view("Form::forms.create")->with(compact('fieldtypes', 'templates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Form\Requests\FormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormRequest $request)
    {
        $form = new Form();
        $form->name = $request->input('name');
        $form->code = $request->input('code');
        $form->action = $request->input('action');
        $form->method = $request->input('method');
        $form->type = $request->input('type');
        // $form->attributes = $request->input('attributes');
        $form->body = $request->input('body');
        $form->delta = $request->input('delta');
        $form->template = $request->input('template');
        $form->success_message = $request->input('success_message');
        $form->error_message = $request->input('error_message');
        $form->user()->associate(User::find(user()->id));
        $form->save();

        //Field
        collect(json_decode(json_encode($request['fields'])))->each(function ($input, $key) use ($form) {
            $field = new Field();
            $field->name = $input->name;
            $field->sort = $input->sort;
            $field->label = $input->label ? $input->label : NULL;
            $field->value = $input->value ? $input->value : NULL;
            // $field->attribute = $input->attribute ? $input->attribute : NULL;
            $field->fieldtype()->associate(Fieldtype::find($input->fieldtype_id));
            $field->form()->associate($form);
            $field->save();
        });

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
        $resource = Form::findOrFail($id);
        $templates = Template::getTemplatesFromFiles();
        $fieldtypes = Fieldtype::all();

        return view("Form::forms.edit")->with(compact('resource', 'templates', 'fieldtypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  Form\Models\Form  $form
     * @return Illuminate\Http\Response
     */
    public function update(FormRequest $request, $id)
    {
        $form = Form::findOrFail($id);
        $form->name = $request->input('name');
        $form->code = $request->input('code');
        $form->action = $request->input('action');
        $form->method = $request->input('method');
        $form->type = $request->input('type');
        // $form->attributes = $request->input('attributes');
        $form->body = $request->input('body');
        $form->delta = $request->input('delta');
        $form->template = $request->input('template');
        $form->success_message = $request->input('success_message');
        $form->error_message = $request->input('error_message');
        $form->save();

        // Field
        $form->fields()->whereNotIn('id', array_column($request['fields'], 'id'))->delete();
        collect(json_decode(json_encode($request['fields'])))->each(function ($input, $key) use ($form) {
            $field = Field::findOrNew($input->id);
            $field->name = $input->name;
            $field->sort = $input->sort;
            $field->label = $input->label ? $input->label : NULL;
            $field->value = $input->value ? $input->value : NULL;
            // $field->attribute = $input->attribute ? $input->attribute : NULL;
            $field->fieldtype()->associate(Fieldtype::find($input->fieldtype_id));
            $field->form()->associate($form);
            $field->save();
        });

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        Form::destroy($request->has('id') ? $request->input('id') : $id);

        return back();
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $resources = Form::onlyTrashed()->paginate();

        return view("Theme::forms.trashed")->with(compact('resources'));
    }
}
