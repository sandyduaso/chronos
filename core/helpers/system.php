<?php

use Pluma\Support\System\SystemInfo;

if (! function_exists('pluma_system')) {
    /**
     * Pluma's system function.
     *
     * @param string $key
     * @return mixed
     */
    function pluma_system($key)
    {
        switch ($key) {
            case 'memory':
                return memory_get_usage();
                break;

            case 'cpu':
                $system = new SystemInfo();
                return $system;
                break;

            default:
                # code...
                break;
        }
    }
}
