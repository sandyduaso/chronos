<?php

namespace Calendar\Controllers;

use Calendar\Models\Calendar;
use Frontier\Controllers\AdminController as Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Calendar::paginate();

        return view("Calendar::calendar.index")->with(compact('resources'));
    }
}
