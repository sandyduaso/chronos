<?php

namespace Setting\Support\Traits;

trait WhereSettingTrait
{
    /**
     * Retrieve the value of a resource's setting via given key.
     *
     * @param  string $key
     * @param  string $value
     * @return string
     */
    public function whereSetting($key, $value = "")
    {
        $query = $this->settings()->where('key', $key)->first();

        return $query->value ?? $value;
    }

    /**
     * Alias for the whereSetting method.
     *
     * @param  string $key
     * @param  string $default
     * @return string
     */
    public function setting($key, $default = "")
    {
        return $this->whereSetting($key, $default);
    }
}
