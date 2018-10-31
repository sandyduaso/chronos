<?php

namespace Timesheet\Controllers\Resources;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Csv as CsvReader;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Timesheet\Requests\TimesheetRequest;
use Timesheet\Requests\TimesheetUploadRequest;

trait TimesheetResourceUploadTrait
{
    /**
     * Process the resource then return to view.
     *
     * @param \Timesheet\Requests\TimesheetUploadRequest $request
     * @return \Illuminate\Http\Response
     */
    public function process(TimesheetUploadRequest $request)
    {
        $data = $this->repository->process($request->file('file'))->toArray();
        $headers = $data[0];

        return back()->with([
            'data' => $data,
            'headers' => $headers,
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Timesheet\Requests\TimesheetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(TimesheetRequest $request)
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
