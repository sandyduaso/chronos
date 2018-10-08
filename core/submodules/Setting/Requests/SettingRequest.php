<?php

namespace Setting\Requests;

use Pluma\Requests\FormRequest;

class SettingRequest extends FormRequest
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
                if ($this->user()->can('store-setting')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-setting')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-setting')) {
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
        $isUpdating = $this->method() == "PUT" ? ",id,$this->id" : "";

        return [
            // '*' => 'required|max:255',
            'theme' => 'sometimes|file|required',
        ];
    }

    /**
     * The array of override messages to use.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
