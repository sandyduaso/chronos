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

if (! function_exists('logo')) {
    /**
     * Returns the svg file of logo.
     *
     * @param string $path
     * @return string
     */
    function logo($path)
    {
        if (file_exists($path)) {
            return file_get_contents($path);
        }

        return url('logo.png');
    }
}
