<?php

namespace Setting\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Setting\Models\Setting;
use Setting\Requests\SettingRequest;

class SystemSettingController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        return view("Theme::settings.system");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Setting\Requests\SettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(SettingRequest $request)
    // {
    //     //

    //     return back();
    // }
}
