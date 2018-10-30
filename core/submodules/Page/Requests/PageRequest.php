<?php

namespace Page\Requests;

use Illuminate\Http\Request;
use Page\Repositories\PageRepository;
use Pluma\Requests\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * The name of the authorization action.
     *
     * @var string
     */
    protected $name = 'page';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return PageRepository::rules($this->method());
    }

    /**
     * The array of override messages to use.
     *
     * @return array
     */
    public function messages()
    {
        return PageRepository::messages();
    }
}
