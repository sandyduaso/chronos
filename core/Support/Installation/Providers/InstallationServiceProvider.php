<?php

namespace Pluma\Support\Installation\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Pluma\Providers\DatabaseServiceProvider;

class InstallationServiceProvider extends ServiceProvider
{
    /**
     * Initial value if app is installed.
     *
     * @var boolean
     */
    protected $installed = true;

    /**
     * Boot the service.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        if (! $this->appIsInstalled()) {
            // Routes
            Route::group([
                'middleware' => ['web'],
            ], function () {
                include_file(core_path('routes'), 'fuzzy.php');
                include_file(core_path('Support/Installation/routes'), 'install.routes.php');
            });

            // Views
            $this->loadViewsFrom(core_path('Support/Installation/views'), "Install");
        }
    }

    /**
     * Performs tests to check if app is installed.
     *
     * @return bool
     */
    public function appIsInstalled()
    {
        try {
            DB::connection()->getPdo();
        } catch (\PDOException $e) {
            $this->installed = false;
        } catch (\Illuminate\Database\QueryException $e) {
            $this->installed = false;
        } catch (\Exception $e) {
            $this->installed = false;
        }

        return $this->installed;
    }
}
