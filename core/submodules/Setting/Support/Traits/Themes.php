<?php

namespace Setting\Support\Traits;

trait Themes
{
    /**
     * Gets the registered themes.
     *
     * @param boolean $withActive
     * @return array
     */
    public static function themes($withActive = true)
    {
        $themes = get_themes();

        if (! $withActive) {
            foreach ($themes as $i => $item) {
                if (strtolower($item->name) === strtolower(settings('active_theme', 'default'))) {
                    unset($themes[$i]);
                }
            }
        }

        return collect($themes)->sortBy('timestamp')->reverse();
    }

    /**
     * Gets the specified theme.
     *
     * @param  string $theme
     * @return mixed
     */
    public static function theme($theme)
    {
        foreach (self::themes() as $item) {
            if (strtolower($item->name) === strtolower($theme) && is_dir($item->path)) {
                return $item;
            }
        }

        return self::theme('default', false);
    }
}
