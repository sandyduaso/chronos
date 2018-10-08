<?php

namespace Crowfeather\Traverser\Contracts;

interface Traverser
{
    /**
     * Sets the traversables.
     *
     * @param array $traversables
     */
    public function set($traversables);

    /**
     * Gets the traversables.
     *
     * @return array
     */
    public function get();

    /**
     * Sorts the traversable tree,
     * adding parent-child relationship to the
     * traversables array.
     *
     * @param  array  $traversables
     * @param  string $parent
     * @param  array  $options
     * @return array
     */
    public function rechild($traversables, $parent = '', $options = []);

    /**
     * Prepares the traversable tree,
     * with children, siblings, parent relationship.
     *
     * @param  string  $parent
     * @param  integer $left    the starting left value
     * @param  array   $options options to pass
     * @return integer
     */
    public function prepare($parent = 'root', $left = 1, $options = []);

    /**
     * Gets the ancestors of a traversable
     * from a given left, right value.
     *
     * @param  integer $left
     * @param  integer $right
     * @return array|mixed
     */
    public function ancestors($left, $right);

    /**
     * Gets the descendants of a traversable
     * from a given left, right value.
     *
     * @param  integer $left
     * @param  integer $right
     * @return array|mixed
     */
    public function descendants($left, $right);

    /**
     * Gets the immediate parent of a given traversable.
     *
     * @param  int $left
     * @param  int $right
     * @return array|mixed|null
     */
    public function parent($left, $right);
}
