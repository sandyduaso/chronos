<?php

if (! function_exists('home')) {
    /**
     * Returns the url of home.
     *
     * @return string
     */
    function home()
    {
        return settings('home_url', url('/'));
    }
}
