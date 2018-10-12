<?php

namespace Pluma\Requests;

use Pluma\Requests\FormRequest;
use Timesheet\Repositories\TimesheetRepository;

class UploadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'file|required',
        ];
    }

    /**
     * The array of override messages to use.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
