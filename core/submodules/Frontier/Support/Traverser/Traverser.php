<?php

namespace Frontier\Support\Traverser;

trait Traverser
{
    /**
     * Array of traversable items.
     *
     * @var array
     */
    protected $traversables = [];

    /**
     * Single traversable item.
     *
     * @var mixed
     */
    protected $traversable;

    /**
     * Left/Right value.
     *
     * @var integer
     */
    protected $left;

    /**
     * The traversable attributes.
     *
     * @var array
     */
    protected $options = ['id' => 'id', 'name' => 'name', 'parent' => 'parent', 'left' => 'left', 'right' => 'right'];

    /**
     * The Root parent of all traversables.
     *
     * @var array
     */
    protected $rootTraverable = ['root' => ['name' => 'root', 'parent' => '', 'left' => '0', 'right' => '0']];

    /**
     * Sets the traversables.
     *
     * @param array $traversables
     */
    protected function setTraversables($traversables)
    {
        $this->traversables = $traversables;
        $this->traversables += $this->rootTraverable;

        return $this;
    }

    /**
     * Gets the traversables.
     *
     * @return array
     */
    public function getTraversables()
    {
        uasort($this->traversables, function ($item1, $item2) {
            if (isset($item1['left'])) {
                return $item1['left'] <=> $item2['left'];
            }

            return -1;
        });

        return $this->traversables;
    }

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
    public function rechildTraversables($traversables, $parent = '', $options = [])
    {
        $options = array_merge($this->options, $options);

        $tree = [];
        foreach ($traversables as $name => $traversable) {
            if ($traversable[$options['parent']] === $parent) {
                $tree[$name] = $traversable;
                if (! isset($tree[$name]['children'])) {
                    $tree[$name]['children'] = [];
                }

                $tree[$name]['children'] += $this->rechildTraversables($traversables, $traversable[$options['name']], $options);
            }
        }

        return $tree;
    }

    public function prepareTraverables($parent = 'root', $left = 1, $options = [])
    {
        $right = $left + 1;
        $options = array_merge($this->options, $options);

        foreach ($this->traversables as $key => &$traversable) {
            if ('root' === $traversable[$options['name']]) {
                $traversable[$options['parent']] = '';
            }

            if (! isset($traversable[$options['parent']]) && 'root' !== $traversable[$options['name']]) {
                $traversable[$options['parent']] = 'root';
            }

            // $traversable['is_child'] = false;
            if ($parent === $traversable[$options['parent']]) {
                $traversable['is_child'] = true;
                $right = $this->prepareTraverables($traversable[$options['name']], $right, $options);
            }
        }

        foreach ($this->traversables as $key => &$traversable) {
            if ($parent === $traversable[$options['name']]) {
                $traversable[$options['left']] = $left;
                $traversable[$options['right']] = $right;
            }

            if (isset($traversable['right'])) {
                if (($descendants = ($traversable['right'] - $traversable['left'] - 1) / 2) > 0) {
                    $traversable['has_children'] = $descendants;
                    $traversable['is_parent'] = true;
                } else {
                    $traversable['has_children'] = false;
                    $traversable['is_parent'] = false;
                }
            }
        }

        return $right + 1;
    }

    public function add($traversable, $parent = 'root', $left = 1)
    {
        $this->traversables += $traversable;
        $this->traversable = array_shift($traversable);
        $this->left = $left;
        $this->right = $left + 1;
        $this->update($parent);

        return $this;
    }

    public function updateTraversables($parent, $traversables = null)
    {
        foreach ($traversables as &$traversable) {
            if (isset($traversable['left']) && $traversable['left'] > ($this->left - 1)) {
                $traversable['left'] = $traversable['left'] + 2;
            }

            if (isset($traversable['right']) && $traversable['right'] > ($this->left - 1)) {
                $traversable['right'] = $traversable['right'] + 2;
            }

            if ($this->traversable['name'] == $traversable['name']) {
                $traversable['left'] = $this->left;
                $traversable['right'] = $this->right;
            }
        }
        return $this;
    }

    public function ancestors($left, $right)
    {
        $tree = [];
        foreach ($this->getTraversables() as $traversable) {
            if ($traversable['left'] < $left && $traversable['right'] > $right) {
                $tree[] = $traversable;
            }
        }

        return $tree;
    }

    public function descendants($left, $right)
    {
        $tree = [];
        foreach ($this->getTraversables() as $traversable) {
            if ($left < $traversable['left'] && $right > $traversable['right']) {
                $tree[] = $traversable;
            }
        }

        return $tree;
    }

    public function getDescendantsCount($left, $right)
    {
        return ($right - $left - 1) / 2;
    }

    public function parent($parent = 'root')
    {
        foreach ($this->getTraversables() as $traversable) {
            if (isset($traversable[$parent])) {
                return $traversable[$parent];
            }
        }

        return null;
    }


    public function dumpTraversables( $startAt = 'root' )
    {
        $right = [];

        $traversables = $this->getTraversables();
        foreach ( $traversables as $traversable ) {
            if ( count( $right ) > 0 ) {
                while ( $right[ count($right) - 1 ] < $traversable['right'] ) {
                    array_pop( $right );
                }
            }
            $l = str_pad($traversable['left'], 2, '0', STR_PAD_LEFT);
            $r = str_pad($traversable['right'], 2, '0', STR_PAD_LEFT);
            echo str_repeat('------| ', count($right)) . $l . " - " . $traversable['name'] . " - " . $r . "\n<br/>";

            $right[] = $traversable['right'];
        }
    }
}
