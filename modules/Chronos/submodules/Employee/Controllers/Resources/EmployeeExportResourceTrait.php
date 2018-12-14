<?php

namespace Employee\Controllers\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use User\Models\User;

trait EmployeeResourceExportTrait
{
    /**
     * Export the resource to a downloadable format.
     *
     * @param Illuminate\Http\Request $request
     * @param int  $id
     * @return Illuminate\Http\Response
     */
    public function export(Request $request, $id = null)
    {
        $users = $this->repository->model()->whereIn('id', $request->input('id'))->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=".$request->input('filename').".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array_keys($users->first()->getOriginal());

        $callback = function () use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($users as $user) {
                fputcsv($file, $user->toArray());
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
