<?php

namespace Comment\Controllers;

use Illuminate\Http\Request;
use Setting\Controllers\SettingController;
use Setting\Models\Setting;
use Setting\Requests\SettingRequest;

class CommentingSettingController extends SettingController
{
    /**
     * Display the Settings Form.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("Comment::settings.commenting");
    }
}
