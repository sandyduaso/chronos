<?php

namespace Submission\Controllers;

use Form\Models\Form;
use Illuminate\Http\Request;
use Pluma\API\Controllers\APIController;
use Submission\Models\Submission;

class AnalyticController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getStatistic(Request $request)
    {
        $form = Form::find($request->input('form_id') ?? 1);
        $dataset = $form->submissions;
        $results = [];

        foreach ($dataset as $i => $set) {
            foreach ($set->fields() as $fieldname => $field) {
                $results[$fieldname]['label'] = $field->question->label;
                $results[$fieldname]['headers'] = $field->choices;
                $results[$fieldname]['data'][$field->guess] = ($results[$fieldname]['data'][$field->guess] ?? 0) + 1;
            }
        }

        // var_dump($results); exit();

        return response()->json($results);
    }
}
