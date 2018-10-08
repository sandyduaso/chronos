<?php

namespace Submission\Support\Traits;

use Illuminate\Http\Request;
use Menu\Models\Menu;
use Submission\Models\Submission;

trait SubmissionResourcePublicTrait
{
    /**
     * Retrieve list of all resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $resources = Submission::search($request->all())->all();

        return view("Theme::submissions.all")->with(compact('resources'));
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
            $submission = Submission::codeOrFail($menu->code);

            // Check if template exists.
            $template = is_null($submission->template) ? 'generic' : $submission->template;
            if (view()->exists("Theme::templates.$template")) {
                return view("Theme::templates.$template")
                            ->with(compact('submission'));
            }

            // Check if a submission exists.
            if (view()->exists("Theme::submissions.{$submission->code}")) {
                return view("Theme::submissions.{$submission->code}")
                            ->with(compact('submission'));
            }

            // Default to the index submission.
            return view("Theme::templates.index")->compact('submission');
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
