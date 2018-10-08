<?php

namespace Category\Support\Accessors;

trait CategoryAccessor
{
    /**
     * Gets the categorable name of the resource.
     *
     * @return string
     */
    public static function categorable()
    {
        $instance = new static;

        return isset($instance->categorable) ? $instance->categorable : $instance->getTable();
    }
}
