<?php

namespace Pluma\Support\View;

use Illuminate\Support\Facades\Request;
use Illuminate\View\Factory as BaseFactory;

class Factory extends BaseFactory
{
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $mergeData
     * @return \Illuminate\Contracts\View\View
     */
    public function make($view, $data = array(), $mergeData = array())
    {
        if (Request::wantsJson()) {
            return array_merge($data, $mergeData);
        }

        return parent::make($view, $data, $mergeData);
    }
}
