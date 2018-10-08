<?php

namespace Frontier\Support\Breadcrumbs\Composers;

use Frontier\Composers\NavigationViewComposer;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Pluma\Support\Modules\Traits\ModulerTrait;

class BreadcrumbComposer extends NavigationViewComposer
{
    use ModulerTrait;

    /**
     * The view's variable.
     *
     * @var string
     */
    protected $name = 'breadcrumbs';

    /**
     * Main function to tie everything together.
     *
     * @param  Illuminate\View\View   $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->setCurrentUrl(Request::path());
        $this->setCurrentRouteName(Route::currentRouteName());

        $this->setBreadcrumbs($this->getCurrentUrl());
        $this->setName($this->name);

        $view->with($this->name(), $this->handle());
    }

    /**
     * Handles the view to compose.
     *
     * @return Object|StdClass
     */
    public function handle()
    {
        return $this->breadcrumbs();
    }

    /**
     * Generates breadcrumbs.
     *
     * @return array
     */
    private function breadcrumbs()
    {
        return collect(json_decode(json_encode($this->breadcrumbs)));
    }

    /**
     * Sets the breadcrumbs.
     *
     * @param string $currentUrl
     */
    public function setBreadcrumbs($currentUrl)
    {
        $currentUrl = ltrim($currentUrl, '/');
        $url = explode('/', $currentUrl);
        $old = "";
        $end = end($url);

        foreach ($url as &$segment) {
            if (! empty($segment)) {
                if (is_numeric($segment)) {
                    $original = $this->guessStringFromNumeric($segment, $old);
                    $segment = request()->route('breadcrumb') ?? config('breadcrumb:leaf') ?? $original;
                }
                $old .= '/'.($original ?? $segment);
                $segment = $this->swapWord($segment);

                $segment = [
                    'last' => $end === $segment,
                    'active' => $this->hasRouteNameFromUrl(strtolower(url($old))),
                    'label' => $this->transformStringToHumanPresentable($segment),
                    'name' => $segment,
                    'slug' => $old,
                    'url' => $this->hasRouteNameFromUrl(strtolower(url($old)))
                                ? strtolower(url($old))
                                : '',
                ];
            }
        }

        $this->breadcrumbs = $url;
    }
}
