<?php

namespace Library\Controllers\Resources;

use Illuminate\Http\Request;

trait LibraryResourceUploadTrait
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Library\Requests\LibraryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        dd($request->all());
    }
}
