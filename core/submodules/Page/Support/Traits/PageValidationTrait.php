<?php

namespace Page\Support\Traits;

use Page\Models\Page;

trait PageValidationTrait
{
    /**
     * Get the validation rules that apply to the model.
     *
     * @var string
     * @return array
     */
    public static function rules($isUpdating = '')
    {
        return [
            'title' => 'required|max:255',
            'code' => 'required|regex:/^[\pL\s\-\*\#\(0-9)]+$/u|unique:pages' . $isUpdating,
        ];
    }

    /**
     * The array of override messages to use.
     *
     * @return array
     */
    public static function messages()
    {
        return [
            'code.regex' => 'Only letters, numbers, spaces, and hypens are allowed.',
        ];
    }
}
