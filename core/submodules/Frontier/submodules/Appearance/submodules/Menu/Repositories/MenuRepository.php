<?php

namespace Menu\Repositories;

use Menu\Models\Menu;
use Page\Models\Page;
use Pluma\Support\Repository\Repository;

class MenuRepository extends Repository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Menu::class;

    /**
     * Set of rules the model should be validated against when
     * storing or updating a resource.
     *
     * @return array
     */
    public static function rules()
    {
        return [];
    }

    /**
     * Array of custom error messages upon validation.
     *
     * @return array
     */
    public static function messages()
    {
        return [];
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

    /**
     * Retrieve model resource details.
     *
     * @param string $code
     * @return  mixed
     */
    public function find($code)
    {
        $menu = $this->model->location($code);

        return $menu;
    }

    /**
     * Retrieve all available pages.
     *
     * @return \Page\Models\Page
     */
    public function pages()
    {
        $pages = Page::all();

        return $pages->map(function ($page) {
            $page['name'] = $page->title;
            $page['description'] = $page->code;
            return $page;
        })->toArray();
    }

    /**
     * Retrieve the menu from a given location.
     *
     * @param string $location
     * @return mixed
     */
    public function location($location = null)
    {
        if (is_null($location)) {
            return [];
        }

        return json_decode(json_encode(array_merge(
            (array) $this->model->location($location), [
            'menus' => $this->model->menus($location),
        ])));
    }
}
