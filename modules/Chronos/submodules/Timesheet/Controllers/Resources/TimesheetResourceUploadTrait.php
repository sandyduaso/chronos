<?php

namespace Timesheet\Controllers\Resources;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Csv as CsvReader;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Timesheet\Requests\TimesheetRequest;

trait TimesheetResourceUploadTrait
{
    /**
     * Process the resource then return to view.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function process(TimesheetRequest $request)
    {
        $resources = $this->repository->process($request->file('file'))->toArray();
        $name = $request->input('name');

        return back()->with([
            'data' => $resources,
            'name' => $name,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Library\Requests\LibraryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $resources = $request->file('file')
            ? $this->repository->process($request->file('file'))->toArray()
            : json_decode($request->input('data'));

        if ($request->ajax()) {
            return response()->json($resources, 200);
        }

        return view('Timesheet::admin.preview')->with(compact('resources'));
    }

    /**
     * Preview a newly created resource in storage.
     *
     * @param  \Library\Requests\LibraryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function preview(Request $request)
    {
        $resources = json_decode($request->input('data'));

        return view('Timesheet::admin.preview')->with(compact('resources'));
    }
}
