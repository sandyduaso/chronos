<?php

namespace Widget\Requests;

use Pluma\Requests\FormRequest;

class WidgetRequest extends FormRequest
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
                if ($this->user()->can('store-widget')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-widget')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-widget')) {
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
        return [
            //
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
