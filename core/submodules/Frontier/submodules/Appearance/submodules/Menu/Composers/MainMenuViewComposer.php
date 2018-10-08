<?php

namespace Menu\Composers;

use Crowfeather\Traverser\Traverser;
use Illuminate\View\View;
use Menu\Models\Menu;
use Pluma\Support\Composers\BaseViewComposer;

class MainMenuViewComposer extends BaseViewComposer
{
    /**
     * The view's variable.
     *
     * @var string
     */
    protected $name = 'menus';

    /**
     * The Traverser instance.
     * @var Crowfeather\Traverser\Traverser
     */
    protected $traverser;

    /**
     * The menu location.
     *
     * @var string
     */
    protected $location = 'main-menu';

    /**
     * The menus object.
     *
     * @var mixed
     */
    protected $menus;

    /**
     * Handles the view to compose.
     *
     * @return Object|StdClass
     */
    public function handle()
    {
        return json_decode(json_encode($this->menus()));
    }

    /**
     * Generate menus from database.
     *
     * @return array
     */
    private function menus()
    {
        try {
            $this->menus = Menu::menus($this->location);
            $this->menus = $this->setupRouting($this->menus);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return abort(500);
        }

        return $this->menus;
    }

    /**
     * Generate each menu's url.
     *
     * @param  array $menus
     * @return array
     */
    private function setupRouting($menus)
    {
        foreach ($menus as &$menu) {
            if (! is_null($menu['slug']) && ! empty($menu['slug'])) {
                $menu['url'] = $menu['slug'];
            } else {
                $menu['slug'] = "";
                $menu['url'] = '/';
            }

            $menu['url'] = isset($menu['is_absolute_slug']) && $menu['is_absolute_slug']
                         ? $menu['url']
                         : url($menu['url']);

            if ($this->getCurrentUrl() === $menu['slug']) {
                $menu['active'] = true;
            } else {
                $menu['active'] = false;
            }

            if (! empty($menu['children'])) {
                $menu['children'] = $this->setupRouting($menu['children']);

                if ($this->hasActiveChild($menu['children'])) {
                    $menu['active'] = true;
                }
            }
        }

        return $menus;
    }

    /**
     * Check if one of the children is active.
     *
     * @param  array  $children
     * @return boolean
     */
    public function hasActiveChild($children)
    {
        foreach ($children as $child) {
            if (isset($child['active']) && $child['active']) {
                return true;
            }
        }

        return false;
    }

    /**
     * Gets the menu.
     *
     * @return mixed
     */
    public function get()
    {
        return $this->menus;
    }
}
