<?php

namespace Category\Support\Traits;

trait CategoryMutatorTrait
{
    /**
     * Gets the categorable name of the resource.
     *
     * @return string
     */
    public static function categorable()
    {
        $intance = new static;

        return isset($instance->categorable) ? $instance->categorable : $intance->getTable();
    }
}
