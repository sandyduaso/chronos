<?php

namespace User\Controllers\Resources;

use Illuminate\Http\Request;
use Pluma\Requests\UploadRequest;

trait AvatarResourceUploadTrait
{
    /**
     * Upload the resource to avatar storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload(UploadRequest $request)
    {
        $resource = $this->repository->upload($request->file('file'));

        if (request()->wantsJson()) {
            return response()->json($resource);
        }

        return back();
    }
}
