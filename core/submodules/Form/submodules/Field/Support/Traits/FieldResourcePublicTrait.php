<?php

namespace Field\Support\Traits;

use Illuminate\Http\Request;
use Menu\Models\Menu;
use Field\Models\Field;

trait FieldResourcePublicTrait
{
    /**
     * Retrieve list of all resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $resources = Field::search($request->all())->all();

        return view("Theme::fields.all")->with(compact('resources'));
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
            $field = Field::codeOrFail($menu->code);

            // Check if template exists.
            $template = is_null($field->template) ? 'generic' : $field->template;
            if (view()->exists("Theme::templates.$template")) {
                return view("Theme::templates.$template")
                            ->with(compact('field'));
            }

            // Check if a field exists.
            if (view()->exists("Theme::fields.{$field->code}")) {
                return view("Theme::fields.{$field->code}")
                            ->with(compact('field'));
            }

            // Default to the index field.
            return view("Theme::templates.index")->compact('field');
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
