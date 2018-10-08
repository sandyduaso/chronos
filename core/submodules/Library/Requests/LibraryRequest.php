<?php

namespace Library\Requests;

use Pluma\Requests\FormRequest;

class LibraryRequest extends FormRequest
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
                if ($this->user()->can('store-library')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-library')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-library')) {
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
        $mimes = implode(',', config('download.supported', []));

        return [
            'originalname' => 'sometimes|required|unique:library'.$isUpdating,
            'file.*' => 'required|mimes:'.$mimes,
            // 'code' => 'required|regex:/^[\pL\s\-\*\#\(0-9)]+$/u|unique:libraries'.$isUpdating,
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
            'originalname.unique' => 'The file or the filename already exists.',
            'file.*.mimes' => 'The file type is not allowed to be uploaded.',
        ];
    }
}
