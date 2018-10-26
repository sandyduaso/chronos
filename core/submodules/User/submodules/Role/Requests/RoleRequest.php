<?php

namespace Role\Requests;

use Pluma\Requests\FormRequest;
use Role\Repositories\RoleRepository;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return RoleRepository::rules();
    }

    public function messages()
    {
        return RoleRepository::messages();
    }
}
