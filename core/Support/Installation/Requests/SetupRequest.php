<?php

namespace Pluma\Support\Installation\Requests;

use Pluma\Requests\FormRequest;

class SetupRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'APP_NAME' => 'required|max:255',
            'DB_CONNECTION' => 'required|max:255',
            'DB_HOST' => 'required|max:255',
            'DB_PORT' => 'required|max:255',
            'DB_DATABASE' => 'required|max:255',
            'DB_USERNAME' => 'required|max:255',
            'DB_PASSWORD' => 'required|max:255',
            'MAIL_USERNAME' => 'email',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages($value='')
    {
        return [
            'APP_NAME.required' => 'The Name fields is required.',
            'DB_CONNECTION.required' => 'The Connection fields is required.',
            'DB_HOST.required' => 'The Host fields is required.',
            'DB_PORT.required' => 'The Port fields is required.',
            'DB_DATABASE.required' => 'The Database fields is required.',
            'DB_USERNAME.required' => 'The Username fields is required.',
            'DB_PASSWORD.required' => 'The Password fields is required.',
            'MAIL_USERNAME.email' => 'The email must be a valid email address.',
        ];
    }
}
