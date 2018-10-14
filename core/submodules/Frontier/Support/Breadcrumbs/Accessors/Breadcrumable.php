<?php

namespace Frontier\Support\Breadcrumbs\Accessors;

trait Breadcrumable
{
    /**
     * Retrieves the mutated crumb field.
     *
     * @return string
     */
    public function getCrumbAttribute()
    {
        $crumb = isset($this->crumb) ? $this->{$this->crumb} : null;

        return $crumb;
    }

    /**
     * Guess the title from breadcrumb middleware
     *
     * @param string $segment
     * @return string
     */
    public function guessFromBreadcrumb($segment = null)
    {
        return request()->route('breadcrumb') ?? config('breadcrumb:leaf') ?? $segment;
    }
}
