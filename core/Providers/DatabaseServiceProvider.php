<?php

namespace Pluma\Providers;

// use Illuminate\Database\DatabaseServiceProvider as BaseDatabaseServiceProvider;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\EntityResolver;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\QueueEntityResolver;
use Illuminate\Events\Dispatcher;
use Pluma\Support\Providers\ServiceProvider as BaseDatabaseServiceProvider;

class DatabaseServiceProvider extends BaseDatabaseServiceProvider
{
    /**
     * The schema instance
     *
     * @var \Illuminate\Support\Facades\Schema
     */
    public $schema;

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        Model::setConnectionResolver($this->app['db']);

        Model::setEventDispatcher($this->app['events']);

        $this->bootCapsule();

        $this->bootSchema();

        parent::boot();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Model::clearBootedModels();

        $this->registerConnectionServices();

        $this->registerEloquentFactory();

        $this->registerQueueableEntityResolver();

        parent::register();
    }

    /**
     * Register the primary database bindings.
     *
     * @return void
     */
    protected function registerConnectionServices()
    {
        // The connection factory is used to create the actual connection instances on
        // the database. We will inject the factory into the manager so that it may
        // make the connections while they are actually needed and not of before.
        $this->app->singleton('db.factory', function ($app) {
            return new ConnectionFactory($app);
        });

        // The database manager is used to resolve various connections, since multiple
        // connections might be managed. It also implements the connection resolver
        // interface which may be used by other components requiring connections.
        $this->app->singleton('db', function ($app) {
            return new DatabaseManager($app, $app['db.factory']);
        });

        $this->app->bind('db.connection', function ($app) {
            return $app['db']->connection();
        });
    }

    /**
     * Register the Eloquent factory instance in the container.
     *
     * @return void
     */
    protected function registerEloquentFactory()
    {
        $this->app->singleton(FakerGenerator::class, function ($app) {
            return FakerFactory::create($app['config']->get('database.faker_locale', 'en_US'));
        });

        $this->app->singleton(EloquentFactory::class, function ($app) {
            return EloquentFactory::construct(
                $app->make(FakerGenerator::class), $this->app->databasePath('factories')
            );
        });
    }

    /**
     * Register the queueable entity resolver implementation.
     *
     * @return void
     */
    protected function registerQueueableEntityResolver()
    {
        $this->app->singleton(EntityResolver::class, function () {
            return new QueueEntityResolver;
        });
    }

    /**
     * Boot Eloquent.
     *
     * @return void
     */
    private function bootCapsule()
    {
        $connection = config('database.default');
        $driver = config("database.connections.$connection.driver", env('DB_CONNECTION', 'mysql'));
        $host = config("database.connections.$connection.host", env('DB_HOST', '127.0.0.1'));
        $port = config("database.connections.$connection.port", env('DB_PORT', '3306'));
        $database = config("database.connections.$connection.database", env('DB_DATABASE', 'pluma'));
        $username = config("database.connections.$connection.username", env('DB_USERNAME', 'pluma'));
        $password = config("database.connections.$connection.password", env('DB_PASSWORD', 'pluma'));

        $this->capsule = new Capsule();
        $this->capsule->addConnection([
            'driver' => $driver,
            'host' => $host,
            'database' => $database,
            'username' => $username,
            'password' => $password,
            'charset' => config("database.connections.$connection.charset", 'utf8'),
            'collation' => config("database.connections.$connection.collation", 'utf8_unicode_ci'),
            'prefix' => config("database.connections.$connection.prefix", ''),
            'strict' => config("database.connections.$connection.strict", true),
        ]);

        // Set the event dispatcher used by Eloquent models
        $this->capsule->setEventDispatcher($this->app['events']);

        // Set global, instance available globally via static methods
        $this->capsule->setAsGlobal();

        // Start
        $this->capsule->bootEloquent();

        $this->app->capsule = $this->capsule;
    }

    /**
     * Boot Schema.
     *
     * @return void
     */
    private function bootSchema()
    {
        $this->schema = $this->capsule->schema();
    }
}
