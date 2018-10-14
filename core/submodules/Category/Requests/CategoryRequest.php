<?php

namespace Category\Requests;

use Pluma\Requests\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->isRoot()) {
            return true;
        }

        switch ($this->method()) {
            case 'POST':
                if ($this->user()->can('store-category')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-category')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-category')) {
                    return true;
                }
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
            'name' => 'required|regex:/^[\pL\s\-\*\#\(0-9)]+$/u|unique:categories' . $isUpdating,
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
            'code.regex' => 'Only letters, numbers, spaces, and hypens are allowed.',
        ];
    }
}
