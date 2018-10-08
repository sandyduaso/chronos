<?php

namespace Pluma\Support\Database\Adjacency\Relations;

use Illuminate\Database\Eloquent\Builder;

trait AdjacentlyRelatedToSelf
{
    /**
     * Retrieves the lineage of the adjacently listed resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function adjaceables()
    {
        return $this->adjacentlyRelatedTo();
    }

    /**
     * Retrieve the immediate children of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getChildrenAttribute()
    {
        return $this->adjaceables()->children();
    }

    /**
     * Retrieve the descendants attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDescendantsAttribute()
    {
        return $this->adjaceables()->descendants();
    }

    /**
     * Retrieve the ancestors attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAncestorsAttribute()
    {
        return $this->adjaceables()->ancestors();
    }

    /**
     * Retrieve the parent attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getParentAttribute()
    {
        return $this->adjaceables()->parent();
    }

    /**
     * Retrieve the siblings of the current resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getSiblingsAttribute()
    {
        return $this->adjaceables()->siblings()->get();
    }

    /**
     * Retrieve next sibling.
     * E.g.
     * ---------------------
     *    Sibling 1
     *    Sibling 2  <-- if this is the current $key value
     *    Sibling 3  <-- then we should receive this
     *    Sibling 4
     *    ...
     *
     * @return mixed
     */
    public function next()
    {
        $adjaceables = $this->adjaceables();
        $siblings = $adjaceables->siblings();
        $sortKey = $this->getSortKey();

        if ($siblings->exists()) {
            return $siblings->next()->get()->first();
        }

        if ($adjaceables->exists()) {
            return $adjaceables->next()->get()->first();
        }

        return $this
            ->tree()
            ->where($sortKey, '>', $this->sort)
            ->orderBy($sortKey, 'ASC')
            ->first();
    }

    /**
     * Retrieve next sibling.
     * E.g.
     * ---------------------
     *    Sibling 1
     *    Sibling 3  <-- we should receive this
     *    Sibling 2  <-- if this is the current $key value
     *    Sibling 4
     *    ...
     *
     * @return mixed
     */
    public function previous()
    {
        $adjaceables = $this->adjaceables();
        $siblings = $adjaceables->siblings();
        $sortKey = $this->getSortKey();

        if ($siblings->exists()) {
            return $siblings->previous()->get()->last();
        }

        if ($adjaceables->exists()) {
            return $adjaceables->previous()->get()->last();
        }

        return $this
            ->tree()
            ->where($sortKey, '<', $this->sort)
            ->orderBy($sortKey, 'DESC')
            ->first();
    }
}
