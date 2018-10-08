<?php

namespace Frontier\Composers;

use Crowfeather\Traverser\Traverser;
use Illuminate\View\View;
use Pluma\Support\Composers\BaseViewComposer;
use Pluma\Support\Modules\Traits\ModulerTrait;

class SidebarComposer extends BaseViewComposer
{
    use ModulerTrait;

    /**
     * The view's variable.
     *
     * @var string
     */
    protected $name = 'sidebar';

    /**
     * Array of menus.
     *
     * @var array
     */
    protected $menus = [];

    /**
     * Main function to tie everything together.
     *
     * @param  Illuminate\View\View   $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with($this->name, $this->handle());
    }

    /**
     * Generates the sidebar instance.
     *
     * @return array
     */
    public function handle()
    {
        $modules = $this->getFileFromModules('config/menus.php');
        $this->generateMenusFromModules($modules);
        $this->buildMenus(new Traverser());

        return $this->menus;
    }

    /**
     * Retrieves the menus from files on each modules.
     *
     * @param array $modules
     * @return void
     */
    protected function generateMenusFromModules($modules)
    {
        foreach ($modules as $module) {
            $module = require $module;
            $this->menus = array_merge($this->menus, $module);
        }
    }

    /**
     * Builds the menus array.
     *
     * @return array
     */
    protected function buildMenus(Traverser $traverser)
    {
        $traverser->set($this->menus)->flatten();
        $traverser->prepare();
        $this->menus = $traverser->get();
        $this->menus = $traverser->rechild('root');
        $this->menus = $traverser->reorder($this->menus);
        $this->menus = $traverser->update($this->menus, function ($key, &$menu, &$parent, &$all) {
            // Set URL
            $menu['url'] = $menu['slug'] ?? false;

            // Set Active Status
            $menu['routeractive'] = false;
            $menu['active'] = url($this->getCurrentUrl()) == $menu['url'];
            if ($menu['active']) {
                $parent['active'] = $menu['active'];
            }

            // Header
            $menu['is_header'] = $menu['is_header'] ?? false;
            $menu['is_divider'] = $menu['is_divider'] ?? false;

            // Misc
            $menu['exclude_from_root'] = $menu['exclude_from_root'] ?? false;

            // Set User Visibility
            $menu['can_be_accessed'] = $menu['can_be_accessed'] ?? $this->userIsRoot();

            $menu['always_viewable'] = $menu['always_viewable']
                ?? $menu['name'] === 'root'
                ?? false;

            if (($this->userIsNotRoot()
                    && $this->user->can($menu['permission'] ?? $menu['code'] ?? false)
                )
                || ($menu['always_viewable'])
                || ($menu['is_header'])
                || ($menu['name'] === 'root')
            ) {
                $menu['can_be_accessed'] = true;
            }

            if ($menu['exclude_from_root']) {
                if ($this->user && $this->user->cannot($menu['permission'] ?? $menu['code'] ?? false)) {
                    $menu['can_be_accessed'] = false;
                }
            }

            // Set route name
            if (isset($menu['code'])) {
                // $menu['routename'] = $menu['code'];
            }

            if (isset($menu['routename'])) {
                $menu['active'] = false;
                $parent['active'] = $menu['active'];
            }

            // Menu accessibility
            if (! $menu['can_be_accessed']) {
                if (! $menu['is_parent'] && $menu['name'] !== 'root') {
                    unset($parent['children'][$menu['name']]);
                }

                // Remove any top level menu with `hidden` attribute
                if (isset($menu['hidden']) && $menu['hidden'] && is_null($parent)) {
                    unset($all[$menu['name']]);
                }
            }

            /**
             * Child hidden routes
             * ['routes']['children'] are routes not present in the sidebar menus
             * but is still under a parent sidebar menu.
             * E.g.
             * User (user)
             * -- All Users (users.index)
             * ---- Show User (users.show)  <------- This is not part of the sidebar menu.
             * -- Create User (users.create)
             * -- Trashed Users (users.trashed)
             * =======
             * The above example shows `users.show` to be under `users.index`, therefore
             * we need to put an `active` flag on `users.index` and `user` when we are in the
             * `users.show` page.
             */
            $childRoutes = isset($menu['routes']['children']) ? $menu['routes']['children'] : [];
            $currentRouteName = $this->getCurrentRouteName();
            if ($menu['child']['active'] = in_array($currentRouteName, $childRoutes)) {
                // This is the main sidebar menu
                $parent['active'] = $menu['child']['active'];
                // This is the main sidebar menu's submenu
                $menu['active'] = $menu['child']['active'];
            }
        });
        $this->menus = $traverser->update($this->menus, function ($key, &$menu, &$parent, &$all) {
            if ($menu['is_parent'] && $menu['parent'] == 'root' && empty($menu['children'])) {
                unset($all[$key]);
            }
            if (count($menu['children']) == 1) {
                $firstChild = collect($menu['children'])->first();
                if ($firstChild['is_header'] || $firstChild['is_divider']) {
                    unset($all[$key]);
                }
            }
        });
        $this->menus = $traverser->update($this->menus, function ($key, &$menu, &$parent, &$all) {
            if ($menu['is_header']) {
                $nextMenu = current(array_slice($all, array_search($key, array_keys($all)) + 1, 1));
                if ($nextMenu && $nextMenu['is_header']) {
                    unset($all[$key]);
                }
            }
        });
    }

    /**
     * Shorthand for checking user belongs to root.
     *
     * @return boolean
     */
    protected function userIsRoot()
    {
        return $this->user && $this->user->isRoot();
    }

    /**
     * Shorthand for checking user does not belong to root.
     *
     * @return boolean
     */
    protected function userIsNotRoot()
    {
        return $this->user && ! $this->user->isRoot();
    }
}
