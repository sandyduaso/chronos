<?php

namespace Setting\Providers;

use Illuminate\Support\Facades\Blade;
use Pluma\Support\Providers\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        // []
    ];

    /**
     * Registered middlewares on the
     * Service Providers Level.
     *
     * @var mixed
     */
    protected $middlewares = [
        //
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->bootBladeDirectives();
    }

    /**
     * Registers additional Blade Directives in the context of this module.
     *
     * @return void
     */
    public function bootBladeDirectives()
    {
        Blade::directive('setting', function ($expression) {
            preg_match("/(?:(?:\"(?:\\\\\"|[^\"])+\")|(?:'(?:\\\'|[^'])+'))/is", $expression, $match);
            $key = $match[0];
            $expression = str_replace($key, "", $expression);
            str_replace('"', "", $key);
            str_replace("'", "", $key);
            return "<?php if (settings($key) $expression) : ?>";
        });

        Blade::directive('endsetting', function ($expression) {
            return "<?php endif; ?>";
        });
    }

    /**
     * Boot the view composers.
     *
     * @return void
     */
    public function bootViewComposers()
    {
        $composers = require __DIR__.'/../config/composers.php';

        foreach ($composers as $composer) {
            view()->composer($composer['appears'], $composer['class']);
        }
    }
}
