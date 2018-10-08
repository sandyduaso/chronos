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
        return Theme::theme(settings('active_theme', settings('default_theme', 'default')));
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
    function get_themes($path = null, $identifier = 'index.html')
    {
        $themePath = is_null($path) ? themes_path() : $path;
        $directories = glob("$themePath/*/$identifier");
        $themes = [];

        foreach ($directories as $i => $directory) {
            $themes[$i]['theme'] = [];
            if (file_exists(dirname($directory).'/theme.json')) {
                $json = json_decode(file_get_contents(dirname($directory).'/theme.json'));
                $themes[$i] = [
                    'name' => isset($json->name) ? $json->name : '',
                    'hintpath' => isset($json->name) ? ucfirst($json->name) : 'Theme',
                    'description' => isset($json->description) ? $json->description : '',
                    'timestamp' => filectime($directory),
                    'code' => isset($json->code) ? $json->code : strtolower(str_slug($json->name)),
                    'author' => [
                        'name' => isset($json->author->name) ? $json->author->name : '',
                        'email' => isset($json->author->email) ? $json->author->email : '',
                    ],
                ];
            }

            $themes[$i]['path'] = dirname($directory);

            if (file_exists(dirname($directory)."/preview.jpg")) {
                $themes[$i]['preview'] = url('anytheme/'.basename(dirname($directory)).'/preview.jpg');
            } else {
                $themes[$i]['preview'] = url('anytheme/'.basename(dirname($directory)).'/preview.png');
            }
        }

        return json_decode(json_encode($themes));
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
