<?php

namespace Role\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Providers\ServiceProvider;
use Role\Models\Permission;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [\Role\Models\Role::class, '\Role\Observers\RoleObserver'],
        [\Role\Models\Permission::class, '\Role\Observers\PermissionObserver'],
    ];

    /**
     * Registered middlewares on the
     * Service Providers Level.
     *
     * @var mixed
     */
    protected $middlewares = [
        [
            'alias' => 'permissions',
            'class' => \Role\Middleware\AuthenticateUserPermission::class,
        ],
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->bootGate();

        $this->bootObservables();

        $this->bootRouterMiddlewares();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->registerEloquentFactories();
    }

    /**
     * Registers the Permissions as Gate policies.
     *
     * @return void
     */
    public function bootGate()
    {
        if (Schema::hasTable('permissions')) {
            Permission::chunk(100, function ($permissions) {
                foreach ($permissions as $permission) {
                    Gate::define($permission->code, function ($user) use ($permission) {
                        return $user->isPermittedTo($permission->code);
                    });

                    Gate::define($permission->name, function ($user) use ($permission) {
                        return $user->isPermittedTo($permission->name, 'name');
                    });
                }
            });
        }
    }

    /**
     * Register the Eloquent factory instance in the container.
     *
     * @return void
     */
    protected function registerEloquentFactories()
    {
        $factoryPath = get_module('role').'/'.basename($this->app->databasePath()).'/factories';

        $this->registerEloquentFactoriesFrom($factoryPath);
    }
}
