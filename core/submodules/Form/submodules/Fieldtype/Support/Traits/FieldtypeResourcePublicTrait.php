<?php

namespace Fieldtype\Support\Traits;

use Illuminate\Http\Request;
use Menu\Models\Menu;
use Fieldtype\Models\Fieldtype;

trait FieldtypeResourcePublicTrait
{
    /**
     * Retrieve list of all resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $resources = Fieldtype::search($request->all())->all();

        return view("Theme::fieldtypes.all")->with(compact('resources'));
    }

    /**
     * Try to retrieve the resource of the given slug.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string $code
     * @return Illuminate\Http\Response
     */
    public function single(Request $request, $code = null)
    {
        $menu = Menu::whereSlug(
            is_null($code) ? settings('site_home', 'home') : $code
        );

        if ($menu->exists()) {
            $menu = $menu->first();
            $fieldtype = Fieldtype::codeOrFail($menu->code);

            // Check if template exists.
            $template = is_null($fieldtype->template) ? 'generic' : $fieldtype->template;
            if (view()->exists("Theme::templates.$template")) {
                return view("Theme::templates.$template")
                            ->with(compact('fieldtype'));
            }

            // Check if a fieldtype exists.
            if (view()->exists("Theme::fieldtypes.{$fieldtype->code}")) {
                return view("Theme::fieldtypes.{$fieldtype->code}")
                            ->with(compact('fieldtype'));
            }

            // Default to the index fieldtype.
            return view("Theme::templates.index")->compact('fieldtype');
        }

        // The $code does not exist on the app's menus.
        // Try if a static file exists for the $code.
        if (view()->exists("Theme::static.$code")) {
            return view("Theme::static.$code");
        }

        // Try the generic Static hintpath
        if (view()->exists("Static::$code")) {
            return view("Static::$code");
        }

        // Finally, give up your dreams.
        return abort(404);
    }
}
