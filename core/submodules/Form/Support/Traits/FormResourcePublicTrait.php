<?php

namespace Form\Support\Traits;

use Illuminate\Http\Request;
use Menu\Models\Menu;
use Form\Models\Form;

trait FormResourcePublicTrait
{
    /**
     * Retrieve list of all resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $resources = Form::search($request->all())->all();

        return view("Theme::forms.all")->with(compact('resources'));
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
            $form = Form::codeOrFail($menu->code);

            // Check if template exists.
            $template = is_null($form->template) ? 'generic' : $form->template;
            if (view()->exists("Theme::templates.$template")) {
                return view("Theme::templates.$template")
                            ->with(compact('form'));
            }

            // Check if a form exists.
            if (view()->exists("Theme::forms.{$form->code}")) {
                return view("Theme::forms.{$form->code}")
                            ->with(compact('form'));
            }

            // Default to the index form.
            return view("Theme::templates.index")->compact('form');
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
