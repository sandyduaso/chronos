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
    use Resources\ThemeResourceAdminTrait;

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
