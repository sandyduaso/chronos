<?php

namespace Employee\Controllers\Resources;

use Employee\Requests\EmployeeImportRequest;

trait EmployeeImportResourceTrait
{
    /**
     * Import from file to storage.
     *
     * @param  \Employee\Requests\EmployeeImportRequest $request
     * @return \Illuminate\Http\Response
     */
    public function import(EmployeeImportRequest $request)
    {
        try {
            $this->repository->import($request->file('import'));
        } catch (\Exception $e) {
            return back()->withErrors($e);
        }

        return back();
    }
}
