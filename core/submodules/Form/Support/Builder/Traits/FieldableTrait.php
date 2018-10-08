<?php

namespace Form\Support\Builder\Traits;

use Form\Support\Builder\Field;

trait FieldableTrait
{
    /**
     * Collection of key-value data.
     *
     * @var mixed
     */
    protected $fields;

    /**
     * Sets the fields.
     *
     * @param array  $fields
     */
    public function setFields($fields)
    {
        $this->fields = new Field($fields);

        return $this;
    }

    /**
     * Retrieves the array.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Retrieves a collected instance of the fields.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fields()
    {
        return $this->getFields();
    }
}

