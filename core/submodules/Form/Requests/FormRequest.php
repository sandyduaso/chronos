<?php

namespace Form\Requests;

use Pluma\Requests\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
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
                if ($this->user()->can('store-form')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-form')) {
                    return true;
                }
                break;

            case 'PATCH':
                if ($this->user()->can('restore-form')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-form')) {
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
            'name' => 'required|max:255',
            'code' => 'required|regex:/^[\pL\s\-\*\#\(0-9)]+$/u|unique:forms' . $isUpdating,
            'fields' => 'required',
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
            'lessons.*.title.required' => 'The Lesson Title field is required.',
        ];
    }
}
