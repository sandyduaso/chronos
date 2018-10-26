<?php

namespace Profile\Controllers\Resources;

use Illuminate\Http\Request;

trait ProfileResourceAdminTrait
{
    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string  $handle
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $handle)
    {
        $resource = $this->repository->model()
            ->whereUsername(ltrim($handle, '@'))
            ->firstOrFail();

        return view('Theme::profiles.show')->with(compact('resource'));
    }
}
