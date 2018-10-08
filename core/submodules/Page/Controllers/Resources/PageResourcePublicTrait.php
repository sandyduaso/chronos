<?php

namespace Page\Controllers\Resources;

use Illuminate\Http\Request;
use Menu\Models\Menu;
use Page\Models\Page;

trait PageResourcePublicTrait
{
    /**
     * Retrieve list of all resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $resources = Page::search($request->all())->get();

        return view("Theme::pages.all")->with(compact('resources'));
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
            is_null($code) ? settings('site_url_for_home', 'home') : $code
        );

        if ($menu->exists()) {
            $menu = $menu->first();
            $page = Page::codeOrFail($menu->code);

            // Check if template exists.
            $template = is_null($page->template) ? 'generic' : $page->template;
            if (view()->exists("Theme::templates.$template")) {
                return view("Theme::templates.$template")
                            ->with(compact('page'));
            }

            // Check if a page exists.
            if (view()->exists("Theme::pages.{$page->code}")) {
                return view("Theme::pages.{$page->code}")
                            ->with(compact('page'));
            }

            // Default to the index page.
            return view("Theme::templates.index")->with(compact('page'));
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

        // If no home is set, then just render the login page.
        if (is_null($code)) {
            return redirect()->route("login.show");
        }

        // Finally, give up your dreams.
        return abort(404);
    }
}
