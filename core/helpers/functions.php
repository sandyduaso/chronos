<?php

use Illuminate\Support\Str;

require_once __DIR__ . '/filters.php';
require_once __DIR__ . '/fonts.php';
require_once __DIR__ . '/navigations.php';
require_once __DIR__ . '/optimizations.php';
require_once __DIR__ . '/site.php';
require_once __DIR__ . '/system.php';
require_once __DIR__ . '/themes.php';
require_once __DIR__ . '/url.php';
require_once __DIR__ . '/widgets.php';

if (! function_exists('core_path')) {
    function core_path($path = '')
    {
        $corePath = config('settings.core_path', 'core');
        return app()->basePath().DIRECTORY_SEPARATOR.$corePath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('modules_path')) {
    /**
     * Gets the path of modules.
     *
     * @param  string  $path
     * @return array
     */
    function modules_path($path = '')
    {
        $path = ltrim($path, '/');
        if (! function_exists('config')) {
            $modulePath = json_decode(json_encode(require __DIR__.'/../../config/path.php'));
            $modulePath = $modulePath->modules;
        } else {
            $modulePath = config('path.modules') ? config('path.modules') : base_path("modules");
        }

        return app()->basePath().DIRECTORY_SEPARATOR.$modulePath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('migrations_path')) {
    /**
     * Gets an array of migrations_path for a given module.
     *
     * @param  string  $moduleName The module
     * @return array
     */
    function migrations_path($moduleName = "Pluma")
    {
        $modules = array_merge(app('config')->get('modules.enabled'), submodules("Pluma", true, true));

        return ;
    }
}

if (! function_exists('submodules')) {
    /**
     * Gets an array of submodules for a given module.
     *
     * @param  string  $moduleName The module
     * @param  boolean $lookInCore If we are looking inside the core folder
     * @param  boolean $basenameOnly omits the realpath.
     * @return array
     */
    function submodules($moduleName = "Pluma", $lookInCore = false)
    {
        $submodulePath = $lookInCore ? core_path("submodules") : base_path("modules/$moduleName/submodules");
        $submodules = file_exists($submodulePath) ? glob("$submodulePath/*", GLOB_ONLYDIR) : [];

        return $submodules;
    }
}

if (! function_exists('modules')) {
    /**
     * Gets an array of recursive modules for a given module.
     * This is the code equivalent of manually writing to config/modules.php
     *
     * @param  boolean $includeCoreModules includes the core modules and submodules.
     * @param  string  $modulesPath The module
     * @return array
     */
    function modules($includeCoreModules = false, $modulesPath = null, $basenameOnly = true)
    {
        $modules = is_null($modulesPath) ? glob(modules_path()."/*", GLOB_ONLYDIR) : $p = glob("$modulesPath/*", GLOB_ONLYDIR);

        if ($includeCoreModules) {
            $coreModules = is_null($modulesPath) ? glob(core_path()."/submodules/*", GLOB_ONLYDIR) : glob("$modulesPath/*", GLOB_ONLYDIR);
            $modules = array_merge($modules, $coreModules);
        }

        $m = [];
        foreach ($modules as $k => $module) {
            if (! in_array(basename($module), config('modules.disabled'))) {
                if (is_dir("$module/submodules") && ! empty(glob("$module/submodules/*", GLOB_ONLYDIR))) {
                    $m[($basenameOnly ? basename($module) : $module)] = modules(false, "$module/submodules", $basenameOnly);
                } else {
                    $m[$k] = ($basenameOnly ? basename($module) : $module);
                }
            }
        }

        return $m;
    }
}

if (! function_exists('get_module')) {
    /**
     * Gets the pathname of the module specified
     *
     * @param  string $retrieve
     * @return mixed
     */
    function get_module($retrieve, $modules = null)
    {
        $mm = false;
        $modules = is_null($modules) ? get_modules_path() : $modules;

        foreach ($modules as $name => $module) {
            if (! is_array($module)) {
                if (strtolower(basename($module)) == strtolower($retrieve)) {
                    return realpath($module);
                }
            } else {
                $mm = get_module($retrieve, $module);
                if (basename($mm) == $retrieve) {
                    return realpath($name);
                }
            }
        }

        return empty($mm) ? null : realpath($mm);
    }
}

if (! function_exists('get_modules_path')) {
    /**
     * Gets the all migrations path.
     *
     * @param  boolean $basenameOnly
     * @param  boolean $includeCoreModules
     * @param  string  $modulesPath
     * @return array
     */
    function get_modules_path($basenameOnly = false, $includeCoreModules = true, $modulesPath = null)
    {
        $modules = is_null($modulesPath) ? glob(__DIR__."/../../modules/*", GLOB_ONLYDIR) : glob("$modulesPath/*", GLOB_ONLYDIR);

        if ($includeCoreModules) {
            $coreModules = is_null($modulesPath) ? glob(__DIR__."/../../core/submodules/*", GLOB_ONLYDIR) : glob("$modulesPath/*", GLOB_ONLYDIR);
            $modules = array_merge($modules, $coreModules);
        }

        $m = [];
        foreach ($modules as $k => $module) {
            if (! in_array(basename($module), config('modules.disabled'))) {
                if (is_dir("$module/submodules")) {
                    $m[] = $basenameOnly ? basename($module) : realpath($module);
                    $mmm = get_modules_path($basenameOnly, false, "$module/submodules");
                    foreach ($mmm as $mm) {
                        $m[] = $basenameOnly ? basename($mm) : realpath($mm);
                    }
                } else {
                    $m[] = $basenameOnly ? basename($module) : realpath($module);
                }
            }
        }

        return $m;
    }
}

if (! function_exists('module_path')) {
    /**
     * Gets the all migrations path.
     *
     * @param  boolean $path
     * @param  boolean $includeCoreModules
     * @param  string  $modulesPath
     * @return array
     */
    function module_path($path)
    {
        $array = explode('/', $path);
        $module = array_shift($array);
        return get_module($module) . "/" . implode("/", $array);
    }
}

if (! function_exists('guess_module')) {
    /**
     * Gets the pathname of the module specified
     *
     * @param  string $retrieve
     * @param  string $delimiter
     * @return mixed
     */
    function guess_module($retrieve, $delimiter = ".")
    {
        $retrieve = explode($delimiter, $retrieve);
        foreach ($retrieve as $r) {
            if (is_dir(get_module(str_singular($r)))) {
                return basename(get_module(str_singular($r)));
            }
        }

        return false;
    }
}

if (! function_exists('get_migrations')) {
    /**
     * Gets the all migrations path.
     *
     * @param  array  $modules
     * @param  string $path
     * @return array
     */
    function get_migrations($modules = [], $path = "")
    {
        if (empty($modules)) {
            $modules = modules(true, null, false);
        }
        $migrationsPath = [];

        foreach ($modules as $key => $module) {
            if (is_array($module)) {
                if (is_dir("$key/$path")) {
                    $migrationsPath["$key/$path"] = get_migrations($module, $path);
                }
            } else {
                if (is_dir("$module/$path")) {
                    $migrationsPath[] = "$module/$path";
                }
            }
        }

        return $migrationsPath;
    }
}

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        if (strlen($value) > 1 && Str::startsWith($value, '"') && Str::endsWith($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (! function_exists("include_files")) {
    /**
     * Include the file specified foreach item
     * in array.
     *
     * @param  array $filePaths Array of file paths
     * @param  string $file      File to include
     * @return void
     */
    function include_files($filePaths, $file = "")
    {
        foreach ($filePaths as $filePath) {
            if (file_exists("$filePath/$file")) {
                include_once "$filePath/$file";
            }
        }
    }
}

if (! function_exists("include_file")) {
    /**
     * Include the file specified
     *
     * @param  string $filePaths file path
     * @param  string $file      File to include
     * @return void
     */
    function include_file($filePath, $file = "")
    {
        if (file_exists("$filePath/$file")) {
            include_once "$filePath/$file";
        }
    }
}

if (! function_exists('require_config')) {
    /**
     * Shortcut to requiring a config file.
     *
     * @param  string $file
     * @param  string $path
     * @return void
     */
    function require_config($file, $path = __DIR__.'/../config')
    {
        require_once "$path/$file";
    }
}

if (! function_exists("settings")) {
    /**
     * Helper function to get values from the settings table.
     *
     * @param  string  $key
     * @param  string  $default
     * @param  boolean $serialized
     * @return mixed
     */
    function settings($key = null, $default = null, $serialized = false)
    {
        try {
            $settings = \Illuminate\Support\Facades\DB::table('settings');
            $settings = $settings->where('key', $key)->first();
            if ($settings) {
                if ($serialized) {
                    $array = [];

                    foreach (unserialize($settings->value) as $key => $value) {
                        array_set($array, $key, $value);
                    }
                    $array = array_dot($array);

                    return $array[$serialized];
                }

                return $settings->value;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return config("settings.$key", $default);
    }
}

if (! function_exists('is_installed')) {
    function is_installed()
    {
        return ! file_exists(storage_path('.install'));
    }
}

if (! function_exists('write_to_env')) {
    function write_to_env($data)
    {
        if (! count($data)) {
            return;
        }

        $pattern = '/([^\=]*)\=[^\n]*/';

        $envFile = base_path('.env');

        $lines = file($envFile);
        $newLines = [];
        foreach ($lines as $line) {
            preg_match($pattern, $line, $matches);

            if (! count($matches)) {
                $newLines[] = $line;
                continue;
            }

            if (! key_exists(trim($matches[1]), $data)) {
                $newLines[] = $line;
                continue;
            }

            if (strpos(trim($matches[1]), ' ') !== false) {
                $line = trim($matches[1]) . "={$data[trim($matches[1])]}\n";
            } else {
                $value = preg_match('/\s/', $data[trim($matches[1])])
                         ? "\"{$data[trim($matches[1])]}\""
                         : $data[trim($matches[1])];
                $line = trim($matches[1]) . "={$value}\n";
            }
            $newLines[] = $line;
        }

        $newContent = implode('', $newLines);
        file_put_contents($envFile, $newContent);

        return true;
    }
}

if (! function_exists('generate_random_key')) {
    /**
     * Generate random key.
     *
     * @return string
     */
    function generate_random_key()
    {
        return 'base64:'.base64_encode(random_bytes(
            config('encryption.cipher') == 'AES-128-CBC' ? 16 : 32
        ));
    }
}

if (! function_exists('assets')) {
    /**
     * Gets assets files from specified path
     *
     * @param  string $file
     * @return Illuminate\Http\Response
     */
    function assets($file)
    {
        return url("assets/$file");
    }
}

if (! function_exists('present')) {
    /**
     * Gets presentations files from specified path
     *
     * @param  string $file
     * @return Illuminate\Http\Response
     */
    function present($file)
    {
        return url("~p/$file");
    }
}

if (! function_exists('user')) {
    /**
     * Shorthand for auth()->user().
     *
     * @return User\Models\User
     */
    function user()
    {
        return auth()->user() ?? false;
    }
}

if (! function_exists('loop_modules')) {
    /**
     * DB Migrate function.
     *
     * @param  function $callback
     * @param  array $modules
     * @return void
     */
    function loop_modules($callback = null, $modules = null)
    {
        $modules = is_null($modules) ? modules(true, null, false) : $modules;

        foreach ($modules as $name => $module) {
            if (is_array($module)) {
                loop_modules($module, $callback);

                $module = $name;
            }

            $callback($name, $module);
        }
    }
}

if (! function_exists('get_permissions')) {
    /**
     * Gets the permissions files from modules.
     *
     * @param  array $modules
     * @return array
     */
    function get_permissions($modules = null)
    {
        $permissions = [];
        $modules = is_null($modules) ? get_modules_path() : $modules;

        foreach ($modules as $name => $module) {
            if (is_array($module)) {
                $permissions = get_permissions($module);
                $module = $name;
            }

            if (file_exists("$module/config/permissions.php")) {
                $permissions[] = "$module/config/permissions.php";
            }
        }

        return $permissions;
    }
}

if (! function_exists('get_sidebars')) {
    /**
     * Get all menus from modules.
     *
     * @param  array $modules
     * @return array|object|mixed
     */
    function get_sidebars($modules = null)
    {
        $menus = [];
        $modules = is_null($modules) ? get_modules_path() : $modules;

        foreach ($modules as $name => $module) {
            if (is_array($module)) {
                $menus = (array) get_sidebars($module);
                $module = $name;
            }

            if (file_exists("$module/config/menus.php")) {
                $menus[] = "$module/config/menus.php";
            }
        }

        return $menus;
    }
}

if (! function_exists('get_sidebar')) {
    /**
     * Get the specified menu from the menus files of every module.
     *
     * @param  string $name
     * @param  string $key
     * @return array|object|mixed
     */
    function get_sidebar($name, $key = 'slug')
    {
        $menus = get_sidebars();

        foreach ($menus as $menu) {
            $menu = require_once $menu;

            if (isset($menu[$key]) && $menu[$key] == $name) {
                return json_decode(json_encode($menu));
            }
        }

        return null;
    }
}

if (! function_exists('v')) {
    /**
     * Render a Vue.js "{{  }}" marks inside
     * Blade's own "{{  }}".
     *
     * @param  string $string
     * @param  boolean $isEscapedVariable
     * @return string
     */
    function v($string, $isEscapedVariable = false)
    {
        if ($isEscapedVariable) {
            return '${' . $string . '}';
        }

        return json_encode('{{' . $string . '}}');
    }
}

if (! function_exists('get_menu')) {
    /**
     * Get all menu items from location.
     *
     * @param  string $location
     * @return array|object|mixed
     */
    function get_menu($location)
    {
        $menus = \Menu\Models\Menu::menus($location);

        return json_decode(json_encode($menus));
    }
}
