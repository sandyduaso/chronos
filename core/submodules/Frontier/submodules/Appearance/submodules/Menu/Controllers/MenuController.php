<?php

namespace Menu\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Menu\Models\Menu;
use Menu\Repositories\MenuRepository;
use Menu\Requests\MenuRequest;
use Page\Models\Page;

class MenuController extends AdminController
{
    use Resources\MenuResourceAdminTrait;

    /**
     * Inject the resource model to the repository instance.
     *
     * @param \Pluma\Models\Model $model
     */
    public function __construct()
    {
        $this->repository = new MenuRepository();

        parent::__construct();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::menus.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Menu\Requests\MenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        Menu::where('location', $request->input('location'))->delete();

        foreach ($request->input('menus') as $key => $menus) {
            $menu = new Menu();
            $menu->title = $menus['title'];
            $menu->location = $request->input('location');
            $menu->slug = is_null($menus['slug']) ? "" : $menus['slug'];
            $menu->code = $menus['code'];
            $menu->icon = isset($menus['icon']) ? $menus['icon'] : '';
            $menu->sort = $menus['sort'];
            $menu->parent = $menus['parent'];
            $menu['page_id'] = $menus['page_id'];
            $menu->key = $key;
            $menu->save();
        }


        return back();
    }
}
