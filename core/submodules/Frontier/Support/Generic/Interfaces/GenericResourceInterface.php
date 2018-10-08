<?php

namespace Frontier\Support\Generic\Interfaces;

use Illuminate\Http\Request;

interface GenericResourceInterface
{
    /**
     * Retrieve list of all resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function all(Request $request);

    /**
     * Retrieve the resource of the given slug.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string $slug
     * @return Illuminate\Http\Response
     */
    public function single(Request $request, $slug = null);
}
