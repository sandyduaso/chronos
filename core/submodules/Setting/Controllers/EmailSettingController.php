<?php

namespace Setting\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Setting\Models\Setting;
use Setting\Requests\SettingRequest;

class EmailSettingController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("Theme::settings.email");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Setting\Requests\SettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        foreach ($request->except(['_token']) as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // write_to_env($request->except(['_token']));

        return back();
    }
}
