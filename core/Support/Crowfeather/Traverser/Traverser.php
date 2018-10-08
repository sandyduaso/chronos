<?php

namespace Crowfeather\Traverser;

use Crowfeather\Traverser\Contracts\Traverser as TraverserContract;

class Traverser implements TraverserContract
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
    protected $options = ['id' => 'id', 'name' => 'name', 'parent' => 'parent', 'left' => 'left', 'right' => 'right', 'children' => 'children'];

    /**
     * The Root parent of all traversables.
     *
     * @var array
     */
    protected $root = ['root' => ['name' => 'root', 'parent' => '', 'left' => '0', 'right' => '0']];

    public function __construct(array $traversables = [], $root = [], $options = [])
    {
        $this->root = array_merge($this->root, $root);

        $this->set($traversables);

        $this->options = array_merge($this->options, $options);
    }

    /**
     * Sets the traversables.
     *
     * @param array $traversables
     */
    public function set($traversables)
    {
        $this->traversables = $traversables;
        $this->traversables += $this->root;

        return $this;
    }

    /**
     * Gets the traversables.
     *
     * @return array
     */
    public function get()
    {
        uasort($this->traversables, function ($item1, $item2) {
            if (isset($item1['left'])) {
                return $item1['left'] <=> $item2['left'];
            }

            return -1;
        });

        return $this->traversables;
    }

    public function flatten($key = 'children', $traversables = null)
    {
        $traversables = is_null($traversables) ? $this->traversables : $traversables;

        foreach ($traversables as $parent => &$traversable) {
            if (isset($traversable[$key]) && $children = $traversable[$key]) {
                foreach ($children as &$child) {
                    $child['parent'] = $parent;
                    if (isset($child[$key])) {
                        $this->flatten($key, $child[$key]);
                    }
                }
                $traversables = array_merge($traversables, $children);
                unset($traversables[$parent][$key]);
            }
        }

        $this->traversables = $traversables;

        return $this;
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
    public function rechild($parent = 'root', $traversables = null, $options = [])
    {
        $traversables = is_null($traversables) ? $this->traversables : $traversables;
        $options = array_merge($this->options, $options);

        $tree = [];
        foreach ($traversables as $name => $traversable) {
            if ($traversable[$options['parent']] === $parent) {
                $tree[$name] = $traversable;
                if (! isset($tree[$name]['children'])) {
                    $tree[$name]['children'] = [];
                    $tree[$name]['is_parent'] = $tree[$name]['has_children'] > 0 ? true : false;
                }

                $tree[$name]['children'] += $this->rechild($traversable[$options['name']], $traversables, $options);
            }
        }

        return $tree;
    }

    public function prepare($parent = 'root', $left = 1, $options = [])
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
                $right = $this->prepare($traversable[$options['name']], $right, $options);
            }
        }

        $this->order($parent, $left, $right, $options);

        return $right + 1;
    }

    /**
     * Left right
     *
     * @param array $traversables
     */
    public function order($parent, $left, $right, $options = [])
    {
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
    }

    public function reorder(&$traversables = null, $key = 'order')
    {
        foreach ($traversables as &$traversable) {
            if (isset($traversable['children'])) {
                $traversable['children'] = $this->reorder($traversable['children'], $key);
            }
        }

        uasort($traversables, function ($item1, $item2) use ($key) {
            if (isset($item1[$key]) && isset($item2[$key])) {
                return $item1[$key] <=> $item2[$key];
            }

            return -1;
        });

        return $traversables;
    }

    public function add($traversable, $parent = 'root', $left = 1)
    {
        $this->traversables += $traversable;
        $this->traversable = array_shift($traversable);
        $this->left = $left;
        $this->right = $left + 1;
        $this->update($parent, null);

        return $this;
    }

    /**
     * Callback update.
     *
     * @param  array $traversables
     * @param  func $callback
     * @return array
     */
    public function update(&$traversables, $callback, &$oldTraversable = null)
    {
        foreach ($traversables as $key => &$traversable) {
            $callback($key, $traversable, $oldTraversable, $traversables);

            if (isset($traversable['has_children']) && $traversable['has_children'] && isset($traversable['children'])) {
                $this->update($traversable['children'], $callback, $traversable);
            }
        }

        $this->traversables = $traversables;

        return $traversables;
    }

    public function ancestors($left, $right)
    {
        $tree = [];
        foreach ($this->get() as $traversable) {
            if ($traversable['left'] < $left && $traversable['right'] > $right) {
                $tree[] = $traversable;
            }
        }

        return $tree;
    }

    public function descendants($left, $right)
    {
        $tree = [];
        foreach ($this->get() as $traversable) {
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

    public function parent($left, $right)
    {
        $ancestors = $this->ancestors($left, $right);

        return end($ancestors);
    }

    public function siblings($left, $right)
    {
        $parent = $this->parent($left, $right);

        return $parent['children'];
    }

    public function dd($traversables, $depth = 1)
    {
        $depth += $depth;
        foreach ($traversables as $traversable) {
            $order = isset($traversable['order']) ? $traversable['order'] : 'o';
            $name = isset($traversable[$this->options['name']]) ? $traversable[$this->options['name']] : '';
            echo str_repeat('------| ', $depth) . " - $order $name \n<br/>";
            if (isset($traversable['children'])) {
                $this->dd($traversable['children'], $depth);
            }
        }
    }

    public function dump($traversables = null, $key = null)
    {
        $right = [];
        $traversables = is_null($traversables) ? $this->get() : $traversables;

        foreach ($traversables as $traversable) {
            if (count($right) > 0) {
                while ($right[count($right) - 1] < $traversable['right']) {
                    array_pop($right);
                }
            }

            $l = str_pad($traversable['left'], 2, '0', STR_PAD_LEFT);
            $r = str_pad($traversable['right'], 2, '0', STR_PAD_LEFT);
            $value = ! isset($traversable[$key]) ? '-/-' : $traversable[$key];
            echo str_repeat('------| ', count($right)) . $l . " - " . $traversable[$this->options['name']] . " [$value] - " . $r . "\n<br/>";

            $right[] = $traversable['right'];
        }
    }

    /**
     * Reorder the traversables using the child's $key ('parent') attribute.
     * This is the inverse of $this->reorder as that orders the traversables
     * with parents knowing their children.
     *
     * This function assumes the parent doesn't know their children.
     * The children knows their parent.
     *
     * @param  string  $key           The 'parent' key attribute.
     * @param  boolean $rechildable   If allowed to rearrange the arrays
     * @return array
     */
    public function reorderViaChildKnowsParent($key = null, $rechildable = true)
    {
        $traversables = [];
        $key = is_null($key) ? $this->options['parent'] : $key;

        $this->flatten();
        $this->prepare();

        if ($rechildable) {
            foreach ($this->traversables as $traversable) {
                if (isset($traversable[$key])) {
                    return $this->rechild($traversable[$key]);
                }
            }
        } else {
            foreach ($this->traversables as &$traversable) {
                $traversable['children'] = [];
            }
        }

        return $this->traversables;
    }

    /**
     * Performs array_values recursively.
     *
     * @param  array $array
     * @param  string $key
     * @return array
     */
    public static function recursiveArrayValues($array, $key = 'children')
    {
        foreach ($array as $i => &$traversable) {
            if (isset($traversable[$key])) {
                $traversable[$key] = array_values($traversable[$key]);
                $traversable[$key] = self::recursiveArrayValues($traversable[$key], $key);
            }
        }

        return array_values($array);
    }

    /**
     * Get a traversable via name.
     *
     * @param  string $key
     * @param  string $keycode
     * @param  array $traversables
     * @return array
     */
    public function find($key, $keycode = "name", $traversables = null)
    {
        $traversables = is_null($traversables) ? $this->traversables : $traversables;
        $target = null;

        foreach ($traversables as $traversable) {
            if ($traversable['has_children']) {
                $target = $this->find($key, $keycode, $traversable['children']);

                if ($target[$keycode] == $key) {
                    return $target;
                }
            }

            if (isset($traversable[$keycode]) && $traversable[$keycode] == $key) {
                return $traversable;
            }
        }

        return $target ?? null;
    }
}
