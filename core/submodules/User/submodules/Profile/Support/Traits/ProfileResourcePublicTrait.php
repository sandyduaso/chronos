<?php

namespace Profile\Support\Traits;

use Illuminate\Http\Request;
use Menu\Models\Menu;
use User\Models\User;

trait ProfileResourcePublicTrait
{
    /**
     * Retrieve list of all resources.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $resources = User::search($request->all())->all();

        return view("Theme::profiles.all")->with(compact('resources'));
    }

    /**
     * Try to retrieve the resource of the given slug.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $handle
     * @return \Illuminate\Http\Response
     */
    public function single(Request $request, $handle = null)
    {
        $resource = User::whereUsername(ltrim($handle, '@'))->firstOrFail();

        return view("Theme::profiles.single")->with(compact('resource'));
    }
}
