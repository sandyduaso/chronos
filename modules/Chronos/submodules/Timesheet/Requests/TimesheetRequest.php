<?php

namespace Timesheet\Requests;

use Pluma\Requests\FormRequest;
use Timesheet\Repositories\TimesheetRepository;

class TimesheetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return TimesheetRepository::rules();
    }

    /**
     * The array of override messages to use.
     *
     * @return array
     */
    public function messages()
    {
        return TimesheetRepository::messages();
    }
}
