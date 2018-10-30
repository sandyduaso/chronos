<?php

namespace Timesheet\Controllers;

use Illuminate\Http\Request;
use Setting\Controllers\SettingController;

class TimesheetSettingsController extends SettingController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('Timesheet::settings.general');
    }
}
