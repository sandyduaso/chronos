<?php

namespace Pluma\Providers;

use Illuminate\Support\Facades\Route;
use Pluma\Support\Providers\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Array of modules.
     *
     * @var array
     */
    protected $modules = [];

    /**
     * The hint path of all static pages.
     *
     * @var string
     */
    protected $staticBasename = "Static";

    /**
     * Create a new service provider instance.
     *
     * @return void
     */
    public function __construct($app)
    {
        parent::__construct($app);

        $this->prepareModules();
    }

    /**
     * Prepares the modules.
     *
     */
    public function prepareModules()
    {
        $this->modules = get_modules_path();
    }

    /**
     * Prepares the providers.
     *
     * @return
     */
    public function prepareProviders()
    {
        foreach ($this->modules as $module) {
            $basename = basename($module);
            if (file_exists("$module/Providers/{$basename}ServiceProvider.php")) {
                $this->providers[] = "\\$basename\\Providers\\{$basename}ServiceProvider::class";
            }
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerModules();

        $this->registerStaticViews();
    }

    /**
     * Load views from static folder.
     *
     * @return void
     */
    protected function registerStaticViews()
    {
        if (is_dir(config("view.static", 'resources/views/static'))) {
            $this->staticBasename = config("view.static_basename", $this->staticBasename);

            $this->loadViewsFrom(
                config("view.static", 'resources/views/static'),
                $this->staticBasename
            );
        }
    }

    /**
     * Register the modules.
     *
     * @return void
     */
    public function registerModules()
    {
        $this->loadModules($this->modules);
    }

    /**
     * Load service providers from the specified modules.
     *
     * @return void
     */
    public function loadModules($modules = null)
    {
        $modules = array_reverse($modules, $preserveKeys = true);
        foreach ($modules as $key => $module) {
            if (is_array($module)) {
                // Load Modules again
                $this->loadModules($module);

                // Swap parent module
                $module = $key;
            }

            // Load Services
            $this->loadServiceProviders($module);

            // Load Views
            $this->loadViews($module);

            // Load Routes
            $this->loadRoutes($module);
        }
    }

    public function loadServiceProviders($module = null)
    {
        $basename = basename($module);
        if (file_exists("$module/Providers/{$basename}ServiceProvider.php")) {
            $serviceProvider = "$basename\\Providers\\{$basename}ServiceProvider";
            $this->app->register($serviceProvider);
        }
    }

    /**
     * Load views from specified modules.
     *
     * @var array $modules
     * @return void
     */
    public function loadViews($module = null)
    {
        $basename = basename($module);

        if (config('view.single-page-app', false) && is_dir("$module/presentations")) {
            $this->loadViewsFrom("$module/presentations", $basename);
        }

        if (is_dir("$module/views")) {
            $this->loadViewsFrom("$module/views", $basename);
        }
    }

    /**
     * Load each modules defined routes.
     *
     * @param  array $module
     * @return void
     */
    public function loadRoutes($module = null)
    {
        $basename = basename($module);

        // If module is disabled, skip.
        // TODO: check in database.
        if (in_array($basename, config('modules.disabled'))) {
            return;
        }

        // TODO: Scheduled for deprecation
        if (file_exists("$module/API/routes/api.php")) {
            Route::group([
                'middleware' => ['api'],
                'as' => 'api.',
                'prefix' => config('routes.api.slug', 'api'),
                'namespace' => "$basename\Controllers",
            ], function () use ($module) {
                include_file("$module/API/routes", "api.php");
            });
        }

        // API routes
        if (file_exists("$module/routes/api.php")) {
            Route::group([
                'middleware' => ['api', 'cors'],
                'as' => 'api.',
                'prefix' => config('routes.api.slug', 'api'),
                'namespace' => "$basename\Controllers",
            ], function () use ($module) {
                include_file("$module/routes", "api.php");
            });
        }

        // Admin routes
        if (file_exists("$module/routes/admin.php")) {
            Route::group([
                'middleware' => ['web'],
                'prefix' => config('path.admin', 'admin'),
                'suffix' => '{locale?}',
                'namespace' => "$basename\Controllers",
            ], function () use ($module) {
                include_file("$module/routes", "admin.php");
            });
        }

        // General purpose routes
        if (file_exists("$module/routes/web.php")) {
            Route::group([
                'middleware' => ['web'],
                'prefix' => config('routes.web.slug', ''),
                'namespace' => "$basename\Controllers",
            ], function () use ($module) {
                include_file("$module/routes", "web.php");
            });
        }
    }
}
