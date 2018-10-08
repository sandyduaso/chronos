<?php

use Illuminate\Support\Facades\Request;

if (! function_exists('url_filter')) {
    /**
     * Merge the url parameters.
     *
     * @param  array $params
     * @return array
     */
    function url_filter($params = [])
    {
        return array_merge(Request::all(), $params);
    }
}
