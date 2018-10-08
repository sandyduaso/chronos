<?php

namespace Frontier\Support\View;

trait DefaultViewsForAdmin
{
    /**
     * Default views for admin.
     *
     * @param string $hintpath
     * @return \Illuminate\View\View
     */
    public function view($hintpath)
    {
        if (is_null($hintpath) || null == $hintpath) {
            $hintpath = $this->module ?? 'Theme::admin.partials.content';
        }

        if (! view()->exists("{$hintpath}{$slug}")) {
            $slug = $this->fromStatic($slug);
        }

        if ($slug) {
            return view("{$hintpath}{$slug}");
        }

        return abort(404);
    }

    public function fromStatic($slug)
    {
        return view()->exists("Static::$slug") ? view("Static::$slug") : false;
    }
}
