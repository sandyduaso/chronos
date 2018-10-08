<?php

namespace Menu\Requests;

use Pluma\Requests\FormRequest;

class MenuRequest extends FormRequest
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
                if ($this->user()->can('store-menu')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-menu')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-menu')) {
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
            'menus' => 'required',
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
            'menus' => 'The menus should contain atleast one item.',
        ];
    }
}
