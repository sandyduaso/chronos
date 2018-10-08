<?php

namespace User\Support\Traits;

trait WhereDetailTrait
{
    /**
     * Retrieve the value of a resource's detail via given key.
     *
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function whereDetail($key, $value = null)
    {
        $query = $this->details()->where('key', $key)->first();

        return $query->value ?? $value;
    }

    /**
     * Alias for whereDetail
     *
     * @param  string  $key
     * @param  string  $default
     * @return string
     */
    public function detail($key, $default = null)
    {
        return $this->whereDetail($key, $default);
    }
}
