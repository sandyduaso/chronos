<?php

namespace Setting\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Setting\Models\Setting;
use Setting\Requests\SettingRequest;

class DisplaySettingController extends AdminController
{
    /**
     * Display the General Settings Form.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("Setting::settings.display");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Setting\Requests\SettingRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        foreach ($request->except(['_token']) as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => is_array($value) ? serialize($value) : $value]);
        }

        return back();
    }
}
