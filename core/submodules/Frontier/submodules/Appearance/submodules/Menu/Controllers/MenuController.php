<?php

namespace Menu\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Menu\Models\Menu;
use Menu\Requests\MenuRequest;
use Page\Models\Page;

class MenuController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locations = Menu::locations();

        return view("Theme::menus.index")->with(compact('locations'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $code)
    {
        $resource = Menu::location($code);

        return view("Theme::menus.show")->with(compact('resource'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $code)
    {
        $menus = Menu::menus($code);
        $pages = Menu::pages();
        $location = Menu::location($code);
        $social = Menu::social();

        return view("Theme::menus.edit")->with(compact('menus', 'pages', 'social', 'location'));
    }
}
