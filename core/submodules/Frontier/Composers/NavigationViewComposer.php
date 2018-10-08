<?php

namespace Frontier\Composers;

use Crowfeather\Traverser\Traverser;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Menu\Models\Menu;
use Pluma\Support\Composers\BaseViewComposer;
use Pluma\Support\Modules\Traits\Module;
use Pluma\Support\Modules\Traits\ModulerTrait;

class NavigationViewComposer extends BaseViewComposer
{
    // use Module;
    use ModulerTrait;

    /**
     * The view's variable.
     *
     * @var string
     */
    protected $name = 'navigation';

    /**
     * Starting depth of the traversables.
     *
     * @var integer
     */
    protected $depth = 1;

    /**
     * The navigational menu.
     *
     * @var array|object|mixed
     */
    protected $menus;

    /**
     * The one dimensional navigation menu.
     *
     * @var mixed
     */
    protected $flatmenus;

    /**
     * The Traversable instance.
     *
     * @var \Crowfeather\Traverser\Traverser
     */
    protected $traverser;

    /**
     * Prefix for url.
     *
     * @var string
     */
    protected $urlPrefix;

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

        $this->setMenus($this->fileToArray($this->getFileFromModules('config/menus.php')));

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
        $navigation = json_decode(json_encode([
            'menu' => $this->menu(),
            'sidebar' => $this->sidebar(),
            'current' => $this->current(),
            'parent' => $this->parent(),
            'profile' => $this->profile(),
        ]));

        // Save to config
        config(['app.navigations' => $navigation]);

        // Finally, return
        return $navigation;
    }

    /**
     * Sets the menus.
     *
     * @param array|object|mixed $menus
     */
    public function setMenus($menus)
    {
        $this->traverser = new Traverser();
        $this->traverser->set($menus)->flatten();
        $this->traverser->prepare();


        $this->flatmenus = $this->traverser->get();
        $this->menus = $this->traverser->rechild('root');
        $this->menus = $this->traverser->reorder($this->menus);

        $this->menus = $this->traverser->update($this->menus, function ($key, &$menu, &$parent) {
            // Alias for slug
            $menu['url'] = $menu['slug'] ?? false;

            $menu['active'] = isset($menu['slug']) ? (url($this->getCurrentUrl()) === $menu['slug']) : false;
            if ($menu['active']) {
                $parent['active'] = $menu['active'];
            }

            $menu['can_be_accessed'] = false;
            if (user() && user()->isRoot() ||
                (isset($menu['always_viewable']) && $menu['always_viewable']) ||
                (isset($menu['is_header']) && $menu['is_header']) ||
                (user() && user()->isPermittedTo(isset($menu['code'])?$menu['code']:$menu['name'])) ||
                (isset($menu['permission']) && user()->isPermittedTo($menu['permission']))) {
                $menu['can_be_accessed'] = true;
            }

            $childRoutes = isset($menu['routes']['children']) ? $menu['routes']['children'] : [];
            $currentRouteName = $this->getCurrentRouteName();
            if ($menu['child']['active'] = in_array($currentRouteName, $childRoutes)) {
                $parent['active'] = $menu['child']['active'];
            }

            $menu['count'] = 100;
        });

        return $this;
    }

    /**
     * Retrieves the current menu via route name.
     *
     * @return mixed
     */
    public function current()
    {
        return $this->traverser->find($this->getCurrentRouteName(), 'route')
            ?? $this->traverser->find(url($this->getCurrentRouteName()), 'slug')
            ?? null;
    }

    /**
     * Retrieves the current menu's parent.
     *
     * @return mixed
     */
    public function parent()
    {
        $current = $this->current();

        return $current
                ? $this->traverser->find($current['parent'])
                : null;
    }

    /**
     * Generates menus.
     *
     * @return array
     */
    private function menu()
    {
        return Menu::all();
    }

    /**
     * Generates sidebar menus.
     *
     * @return array
     */
    private function sidebar()
    {
        $this->menus = $this->unsetForbiddenRoutes($this->menus);

        foreach (($this->menus ?? []) as $i => &$current) {
            // This will remove all parent where the only child is a header/divider.
            if (count($current['children']) == 1) {
                $firstChild = reset($current['children']);
                if ((isset($firstChild['is_header']) && $firstChild['is_header']) ||
                    (isset($firstChild['is_divider']) && $firstChild['is_divider'])
                ) {
                    unset($this->menus[$i]);
                }
            }

            $next = next($this->menus);
            if (isset($current['is_header'])) {
                if (! $next) {
                    unset($this->menus[$i]);
                }

                if ($next && isset($next['is_header'])) {
                    unset($this->menus[$i]);
                }
            }
        }

        return json_decode(json_encode([
            'collect' => collect(json_decode(json_encode($this->menus))),
            'flat' => collect(json_decode(json_encode($this->flatmenus))),
        ]));
    }

    /**
     * Generate sidebar.
     *
     * @param  object $menus
     * @return html|string
     */
    private function generateSidebar($menus)
    {
        $depth = $this->depth;

        return view("Frontier::templates.navigations.sidebar")->with(compact('menus', 'depth'))->render();
    }

    /**
     * Remove all routes the user is
     * restricted access.
     *
     * @param  array $menus
     * @return void
     */
    public function unsetForbiddenRoutes(&$menus = null)
    {
        if (user() && user()->isRoot()) {
            return $menus;
        }

        $menus = is_null($menus) ? $this->menus : $menus;

        foreach ($menus as $i => &$menu) {
            if (isset($menu['children']) && ! empty($menu['children'])) {
                $menu['children'] = $this->unsetForbiddenRoutes($menu['children']);
            }

            if ((! $menu['can_be_accessed'] && ! $menu['is_parent']) ||
                (! $menu['can_be_accessed'] && $menu['is_parent'] && empty($menu['children']))) {
                unset($menus[$i]);
            }
        }

        return $menus;
    }

    /**
     * Try to get the column `code` from the database.
     *
     * @param  int $segment
     * @param  string $url
     * @return string
     */
    public function guessStringFromNumeric($segment, $url)
    {
        try {
            $action = request()->route()->getAction();
            $controller = class_basename($action['controller']);
            $table = strtolower(str_plural(explode("Controller", $controller)[0]));
            $result = \Illuminate\Support\Facades\DB::table($table)->find($segment);

            if (isset($result->title)) {
                $segment = $result->title;
            } elseif (isset($result->name)) {
                $segment = $result->title;
            } elseif (isset($result->code)) {
                $segment = $result->code;
            } else {
                $segment = $segment;
            }
        } catch (\Exception $e) {
            return $segment;
        }

        return $segment;
    }

    /**
     * Performs a string transformation to
     * huma-readable word(s).
     *
     * @param  string $string
     * @return string
     */
    public function transformStringToHumanPresentable($string)
    {
        $string = str_replace('-', " ", $string);
        $string = str_replace('.', " ", $string);
        $string = str_replace('_', " ", $string);

        return $c ?? ucwords($string);
    }

    /**
     * Gets the profile menus.
     *
     * @return array
     */
    protected function profile()
    {
        $profile = get_module('profile') . '/config/menus.php';
        if (file_exists($profile)) {
            $profile = require $profile;
        }

        return $profile['avatar'] ?? [];
    }

    /**
     * Utility to convert config files to array.
     *
     * @param array $files
     * @return array
     */
    protected function fileToArray(array $files): Array
    {
        $items = [];
        foreach ($files as $path) {
            if (file_exists($path)) {
                $items += (array) require $path;
            }
        }

        return $items;
    }
}
