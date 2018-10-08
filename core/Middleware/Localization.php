<?php

namespace Pluma\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Session;

class Localization
{
    /**
     * Supported languages.
     *
     * @var array
     */
    protected $languages;

    /**
     * Subdomain string.
     *
     * @var string
     */
    protected $subdomain;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $this->languages = config()->get('language.supported', $this->languages);

        app()->setLocale(config()->get('language.locale', 'en'));

        if ($this->isSubdomain()) {
            $this->setSubdomainLocale();
        }

        return $next($request);
    }

    /**
     * Check if the application is a subdomain.
     *
     * @return boolean
     */
    protected function isSubdomain()
    {
        return config('environment.subdomain', false);
    }

    /**
     * Set the locale of the subdomain.
     *
     * @return  void
     */
    protected function setSubdomainLocale()
    {
        $url = explode('.', parse_url($request->url(), PHP_URL_HOST));

        if (count($url) >= 2) {
            $this->subdomain = $url[0];
            app()->setLocale($this->subdomain);
        }
    }
}
