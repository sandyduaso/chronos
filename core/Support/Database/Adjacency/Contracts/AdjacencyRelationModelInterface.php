<?php

namespace Pluma\Support\Database\Adjacency\Contracts;

interface AdjacencyRelationModelInterface
{
    /**
     * Get the short name of the "ancestor" column.
     *
     * @return string
     */
    public function getAncestorKey();

    /**
     * Get the short name of the "descendant" column.
     *
     * @return string
     */
    public function getDescendantKey();

    /**
     * Get the short name of the "depth" column.
     *
     * @return string
     */
    public function getDepthKey();
}
