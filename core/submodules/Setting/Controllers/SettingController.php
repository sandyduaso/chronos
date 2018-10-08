<?php

namespace Setting\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Setting\Models\General;
use Setting\Models\Setting;
use Setting\Requests\SettingRequest;

class SettingController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        return view("Theme::settings.index");
    }

    /**
     * Display the General Settings Form.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getGeneralForm(Request $request)
    {
        return view("Theme::settings.general");
    }

    /**
     * Display the Social Settings Form.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getSocialForm(Request $request)
    {
        $setting = Setting::where('key', 'social_links')->first();
        $resources = $setting ? unserialize($setting->value) : [];

        return view("Theme::settings.social")->with(compact('resources'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Setting\Requests\SettingRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->except(['_token', 'user_id']) as $key => $value) {
            Setting::updateOrCreate([
                'key' => $key,
            ], [
                'value' => is_array($value) ? serialize($value) : $value,
                'user_id' => $request->input('user_id'),
            ]);
        }

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //

        return view("Theme::settings.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Setting\Requests\SettingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        return redirect()->route('Setting.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::settings.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Setting\Requests\SettingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(SettingRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Setting\Requests\SettingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(SettingRequest $request, $id)
    {
        //

        return redirect()->route('Setting.trash');
    }
}
