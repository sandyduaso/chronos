<?php

use Theme\Models\Theme;

if (! function_exists('themes_path')) {
    /**
     * Gets the path of modules.
     *
     * @param  string  $path
     * @return array
     */
    function themes_path($path = '')
    {
        $path = ltrim($path, '/');
        if (! function_exists('config')) {
            $themesPath = json_decode(json_encode(require __DIR__.'/../../config/path.php'));
            $themesPath = $themesPath->themes;
        } else {
            $themesPath = config('path.themes') ? config('path.themes') : base_path("themes");
        }

        return app()->basePath().DIRECTORY_SEPARATOR.$themesPath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('get_active_theme')) {
    /**
     * Gets the active theme.
     *
     * @return mixed
     */
    function get_active_theme()
    {
        return get_themes()['active'];
    }
}

if (! function_exists('get_themes')) {
    /**
     * Gets themes.
     *
     * @param  string  $path
     * @param  string  $identifier
     * @return array
     */
    function get_themes($path = null, $identifier = 'theme.json')
    {
        $themePath = is_null($path) ? themes_path() : $path;
        $coreThemePath = core_path('theme');
        $defaultThemePath = glob("$coreThemePath/$identifier");
        $directories = glob("$themePath/*/$identifier");
        $directories = array_merge($defaultThemePath, $directories);

        $themes = [];
        foreach ($directories as $i => $directory) {
            $json = json_decode(
                file_get_contents(dirname($directory).'/'.$identifier)
            );

            $code = $json->code ?? $json->name ?? $i;

            $themes[$code] = new \StdClass();
            $themes[$code]->name = $json->name ?? 'Unnamed Theme';
            $themes[$code]->hintpath = $json->hintname ?? ucfirst($code) ?? ucfirst(current(explode(' ', $json->name)));
            $themes[$code]->description = $json->description ?? '';
            $themes[$code]->timestamp = filectime($directory);
            $themes[$code]->code = $json->code ?? $json->name ?? date('Ymdhis');
            $themes[$code]->slug = strtolower(str_slug($json->code ?? $json->name ?? date('Ymdhis')));
            $themes[$code]->author = $json->author ?? null;

            $themes[$code]->path = dirname($directory);
            $theme = basename($themes[$code]->path);
            $theme = $theme === 'theme' ? 'default' : $theme;
            $themes[$code]->thumbnail = @str_contains($json->preview->img, ['data:image/png;base64'])
                ? $json->preview->img
                : @url('anytheme/'.$theme.'/'.$json->preview->img);
            $themes[$code]->preview = $json->preview;
            $themes[$code]->colors = $json->colors ?? [];
            $themes[$code]->active = settings('active_theme', 'default') === $code;
        }

        $themes['active'] = isset($themes[settings('active_theme', 'default')])
            ? $themes[settings('active_theme', 'default')]
            : $themes['default'];

        return collect($themes ?? []);
    }
}

if (! function_exists('theme')) {
    /**
     * Gets theme files from specified path
     *
     * @param  string $file
     * @param  string $any
     * @return Illuminate\Http\Response
     */
    function theme($file, $any = false)
    {
        if ($any) {
            return url("anytheme/$file");
        }

        return url("themes/$file");
    }
}
