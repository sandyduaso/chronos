<?php

namespace Profile\Requests;

use Pluma\Requests\FormRequest;

class CredentialRequest extends FormRequest
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
        $id = (int) $this->route('profile');

        return [
            'old_password' => "sometimes|required|old_password:$id,$this->old_password",
            'password' => 'sometimes|required|min:6|confirmed',
            'username' => 'sometimes|required',
        ];
    }
}
