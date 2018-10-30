<?php

use Widget\Models\Widget;

if (! function_exists('get_widgets')) {
    /**
     * Gets all the available widgets.
     *
     * @param  string $value
     * @param  string $column
     * @return array
     */
    function get_widgets($value = null, $column = "code")
    {
        $widgets = get_raw_widgets($asArray = true);

        foreach ($widgets as $i => &$fileBased) {
            $dataBased = Widget::where("code", $fileBased['code'])->exists()
                          ? Widget::where("code", $fileBased['code'])->first()->toArray()
                          : [];

            $fileBased = array_merge((array) $fileBased, (array) $dataBased);
        }

        $widgets = collect(json_decode(json_encode($widgets)));

        if (! is_null($value)) {
            $widgets = $widgets->where($column, $value);
            if ($column === "code") {
                return isset($widgets->first()->id)
                        ? Widget::find($widgets->first()->id)
                        : $widgets->first();
            }

            return $widgets;
        }

        return json_decode(json_encode($widgets));
    }
}

if (! function_exists('widgets')) {
    /**
     * Get the specified widget.
     *
     * @param  string $code
     * @param  string $column
     * @return  \Illuminate\Database\Eloquent\Model
     */
    function widgets($code = null, $column = "code")
    {
        if (is_null($code)) {
            return get_widgets();
        }

        return get_widgets($code, $column);
    }
}

if (! function_exists('get_raw_widgets')) {
    /**
     * Get all widgets from file.
     *
     * @param  boolean $asArray
     * @return  \Illuminate\Database\Eloquent\Model
     */
    function get_raw_widgets($asArray = false)
    {
        $widgets = [];
        foreach (get_modules_path() as $module) {
            if (file_exists("$module/config/widgets.php")) {
                $widget = require "$module/config/widgets.php";

                $widgets = array_merge(
                    (array) $widgets,
                    (array) ($widget['enabled'] ?? [])
                );
            }
        }

        return $asArray ? $widgets : json_decode(json_encode($widgets));
    }
}
