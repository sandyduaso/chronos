<?php

namespace Frontier\Support\Breadcrumbs;

class Breadcrumb
{
    /**
     * The array of breadcrumb segment.
     *
     * @var array
     */
    protected $segment;

    /**
     * Initialize the segment.
     *
     * @param array $segment
     */
    public function __construct($segment)
    {
        $this->segment = $segment;
    }

    /**
     * Get the breadcrumb title.
     *
     * @return string
     */
    public function title()
    {
        return $this->segment['title'];
    }

    /**
     * Get the breadcrumb url.
     *
     * @return string
     */
    public function url()
    {
        return $this->segment['url'];
    }

    /**
     * Retrieves the extra parameter in the segment.
     *
     * @return mixed
     */
    public function get()
    {
        return json_decode(json_encode($this->segment));
    }
}
