<?php

namespace Setting\Support\Traits;

trait Keyable
{
    /**
     * Turns a column's value into a key.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  string $key
     * @param  string $value
     * @return Object
     */
    public function scopeKey($builder, $key = 'key', $value = 'value')
    {
        $resources = $builder->get();
        $d = [];
        foreach ($resources as $resource) {
            $d[$resource->{$key}] = $resource->{$value};
        }

        return json_decode(json_encode($d));
    }

    /**
     * Get's the row's value via key.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  string $key
     * @param  string $column
     * @param  strinf $comlumn_value
     * @return string
     */
    public function scopeValueFromKey($builder, $key, $column = 'key', $column_value = 'value')
    {
        $setting = $builder->where($column, $key)->first();
        return is_null($setting) ? false : $setting->{$column_value};
    }
}
