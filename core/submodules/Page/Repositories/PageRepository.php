<?php

namespace Page\Repositories;

use Page\Models\Page;
use Pluma\Support\Repository\Repository;

class PageRepository extends Repository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Page::class;

    /**
     * Set of rules the model should be validated against when
     * storing or updating a resource.
     *
     * @return array
     */
    public static function rules($method = 'POST')
    {
        switch (strtoupper($method)) {
            case 'PUT':
                $instance = new static;

                return [
                    'title' => 'required|max:255',
                    'code' => 'required|unique:pages,id,'.$instance->model->id,
                ];

            case 'POST':
            default:
                return [
                    'title' => 'required|max:255',
                    'code' => 'required|unique:pages',
                ];
        }
    }

    /**
     * Array of custom error messages upon validation.
     *
     * @return array
     */
    public static function messages()
    {
        return [
            'code.regex' => 'Only letters, numbers, spaces, and hypens are allowed.',
        ];
    }

    /**
     * Retrieve the full model instance.
     *
     * @return \Pluma\Models\Model
     */
    public function model()
    {
        return $this->model;
    }
}
