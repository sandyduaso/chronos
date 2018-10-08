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
}
