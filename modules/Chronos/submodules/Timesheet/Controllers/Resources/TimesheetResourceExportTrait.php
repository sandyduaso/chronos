<?php

namespace Timesheet\Controllers\Resources;

use Illuminate\Http\Request;

trait TimesheetResourceExportTrait
{
    /**
     * Export to given format.
     *
     * @param \Illuminate\Http\Request $request
     * @param  inst $id
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request, $id = null)
    {
        $this->repository->export($id, $request->all());

        return back();
    }
}
