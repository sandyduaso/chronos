<?php

namespace Profile\Support\Traits;

use Catalogue\Models\Catalogue;
use Illuminate\Http\Request;
use Library\Models\Library;

trait CanUploadToStorageApiTrait
{
	/**
     * Retrieve list of resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
	public function getAll(Request $request)
	{
		# code...
	}

	/**
	 * Upload to storage.
	 *
	 * @param  \Illuminate\Http\Request $request
     * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function postUpload(Request $request, $id)
	{
		try {
            $file = collect($request->file('file'))->first();

            $folderName = "public/users/" . date('Y-m-d');
            $uploadPath = storage_path(settings('library.storage_path_for_users', $folderName));

            $clientOriginalName = $file->getClientOriginalName();
            $name = (bool) $request->input('originalname') ? pathinfo($request->input('originalname'), PATHINFO_FILENAME) : pathinfo($clientOriginalName, PATHINFO_FILENAME);

            $fileName = $request->input('upload_type') ?? 'avatar';
            $fileName .= "." . $file->getClientOriginalExtension();

            $fullFilePath = "$uploadPath/$fileName";

            $file->move($uploadPath, $fileName);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }


        return response()->json($this->successResponse);
	}
}
