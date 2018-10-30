<?php

namespace Theme\Controllers\Resources;

use Illuminate\Http\Request;
use Theme\Models\Theme;

trait ThemeResourceAdminTrait
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
        $resources = Theme::files();

        return view('Theme::themes.index')->with(compact('resources', 'active'));
    }

    /**
     * Display the preview of a given theme.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $theme
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $theme)
    {
        $resource = Theme::theme($theme);

        if (view()->exists("{$resource->hintpath}::themes.preview")) {
            return view("{$resource->hintpath}::themes.preview")->with(compact('resource'));
        }

        return view('Theme::themes.preview')->with(compact('resource'));
    }

}
