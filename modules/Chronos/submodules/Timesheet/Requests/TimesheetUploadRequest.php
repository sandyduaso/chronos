<?php

namespace Timesheet\Requests;

use Pluma\Requests\FormRequest;
use Timesheet\Repositories\TimesheetRepository;

class TimesheetUploadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'file|required|mimes:csv,txt',
        ];
    }
}
