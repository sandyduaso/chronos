<?php

namespace Pluma\Support\Broadcasting;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastRouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ['middleware' => ['auth:api']]
        Broadcast::routes();

        # load channel routes from modules
        $this->bootModuleRoutes();

        # load channel routes from active theme.
        $this->bootThemeRoutes();
    }

    /**
     * Require channel routes from all modules.
     *
     * @return void
     */
    protected function bootModuleRoutes()
    {
        foreach (get_modules_path() as $module) {
            if (file_exists("$module/routes/channels.php")) {
                require "$module/routes/channels.php";
            }
        }
    }

    /**
     * Require channel routes from current active theme.
     *
     * @return void
     */
    protected function bootThemeRoutes()
    {
        $activeTheme = settings('active_theme', 'default');

        if (file_exists(themes_path("$activeTheme/routes/channels.php"))) {
            require themes_path("$activeTheme/routes/channels.php");
        }
    }
}
