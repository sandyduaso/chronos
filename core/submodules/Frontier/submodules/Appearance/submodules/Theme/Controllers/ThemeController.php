<?php

namespace Theme\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Library\Models\Library;
use Setting\Requests\SettingRequest;
use Theme\Models\Theme;
use Theme\Requests\ThemeRequest;

class ThemeController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $active = Theme::theme(settings('active_theme', 'default'));
        $resources = Theme::themes(false);

        return view("Theme::theme.index")->with(compact('resources', 'active'));
    }

    /**
     * Display the preview of a given theme.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $theme
     * @return \Illuminate\Http\Response
     */
    public function preview(Request $request, $theme)
    {
        $resource = Theme::theme($theme);

        if (view()->exists("{$resource->hintpath}::theme.preview")) {
            return view("{$resource->hintpath}::theme.preview")->with(compact('resource'));
        }

        return view("Theme::theme.preview")->with(compact('resource'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Setting\Requests\SettingRequest $request
     * @return \Illuminate\Http\Response
     */
    public function upload(SettingRequest $request)
    {
        $file = $request->file('theme');

        if ($file) {
            Library::extract($file->getPathName(), themes_path());
        }

        return back();
    }
}
