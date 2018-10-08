<?php

if (! function_exists('font_link_tags')) {
    /**
     * Gets the HTML link tags specified
     *
     * @param  string  $fonts
     * @return HTML|string
     */
    function font_link_tags($configFileLocation)
    {
        $tags = config($configFileLocation, null);
        return implode("\n\r", $tags ?? []);
    }
}
