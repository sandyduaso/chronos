<?php

namespace Employee\Requests;

use Employee\Repositories\EmployeeRepository;
use Pluma\Requests\FormRequest;
use User\Models\User;

class EmployeeImportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'import' => 'file|required|mimes:csv,txt',
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
