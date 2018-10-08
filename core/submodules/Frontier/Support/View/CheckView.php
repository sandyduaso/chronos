<?php

namespace Frontier\Support\View;

trait CheckView
{
    public function view($slug, $hintpath = "")
    {
        if (is_null($slug) || null == $slug) {
            $slug = "home";
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
