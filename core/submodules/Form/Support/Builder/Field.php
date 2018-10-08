<?php

namespace Form\Support\Builder;

use Form\Support\Builder\Traits\TemplatableFieldTrait;

class Field
{
    use TemplatableFieldTrait;

    /**
     * Collection of key-value data.
     *
     * @var mixed
     */
    protected $items;

    /**
     * Instantiate with an array of items.
     *
     * @param mixed $items
     */
    public function __construct($items = null)
    {
        $this->setItems($items);
    }

    /**
     * Sets the items.
     *
     * @param array  $items
     */
    public function setItems($items)
    {
        $this->items = $items;

        $this->sortItems();

        $this->nameItems();

        return $this;
    }

    /**
     * Retrieves the array.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Sorts the items via the key `sort`.
     *
     * @return void
     */
    protected function sortItems()
    {
        if (! is_array($this->items)) {
            return $this->items;
        }

        uasort($this->items, function ($item1, $item2) {
            if (isset($item1['sort']) && isset($item2['sort'])) {
                return $item1['sort'] <=> $item2['sort'];
            }

            return -1;
        });
    }

    /**
     * Give each item's key an associative name based on their `code` key.
     *
     * @return void
     */
    protected function nameItems()
    {
        $items = [];
        foreach ((array) $this->items as $i => $item) {
            $items[$item['code'] ?? $i] = json_decode(json_encode($item));
        }

        $this->items = $items;
    }

    /**
     * Retrieves a collected instance of the items.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function items($name = null)
    {
        if (! is_null($name)) {
            return $this->item($name);
        }

        return collect(json_decode(json_encode($this->getItems())));
    }

    /**
     * Retrieves the item via key.
     *
     * @param  string $key
     * @return mixed
     */
    public function item($key)
    {
        return $this->items()->get($key) ?? null;
    }
}
