<?php

namespace User\Requests;

use Pluma\Requests\FormRequest;

class PasswordChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch ($this->method()) {
            case 'POST':
                if ($this->user()->can('store-user')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-user')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-user')) {
                    return true;
                }
                break;

            default:
                return false;
                break;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('id');

        return [
            'old_password' => "sometimes|required|old_password:$id,$this->old_password",
            'password' => 'required|min:6|confirmed',
        ];
    }
}
