<?php

namespace User\Controllers\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use User\Models\User;

trait UserResourceExportTrait
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
        dd($request->all());

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('ReviewID', 'Provider');

        $callback = function() use ($users, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($users as $user) {
                fputcsv($file, array($user->id, $user->fullname));
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);

        $resources = User::exportOrFail($id, $request->input('format'));

        return view("User::exports.report")->with(compact('resources'));
    }
}
