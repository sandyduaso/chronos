<?php

namespace Menu\Support\Traits;

use Crowfeather\Traverser\Traverser;
use Illuminate\Support\Facades\Request;
use Page\Models\Page;
use Pluma\Support\Modules\Traits\ModulerTrait;

trait MenuBuilderTrait
{
    use ModulerTrait;

    /**
     * Stores the menu locations.
     *
     * @var array
     */
    protected $locations = [];

    /**
     * Gets the specified location.
     *
     * @return mixed
     */
    public static function location($code)
    {
        foreach (self::locations() as $location) {
            if ($location['code'] === $code) {
                return json_decode(json_encode($location));
            }
        }

        return null;
    }

    /**
     * Gets the menu locations from all the modules.
     *
     * @return array
     */
    public static function locations()
    {
        $instance = new static;
        $locations = [];

        $modules = $instance->modulePaths();
        $activeThemePath = themes_path(settings('active_theme', 'default'));
        $modules = array_merge($modules, [$activeThemePath]);

        foreach ($modules as $key => $module) {
            if (file_exists("$module/config/locations.php")) {
                $configs = (array) require "$module/config/locations.php";
                foreach ($configs as $name => $location) {
                    $locations[$name] = collect(array_merge($location, [
                        // 'items' => $instance::menus($name),
                        // 'count' => $i->count(),
                        'code' => $name,
                        'module' => basename($module)
                    ]))->recurse();
                }
            }
        }

        return collect($locations)->recurse();
    }

    /**
     * Initialize the builder.
     *
     * @param string $location
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function menus($location)
    {
        $instance = new static;

        $instance = $instance->where('location', $location)->orderBy('sort', 'ASC')->get();
        $menus = $instance;

        $traverser = new Traverser($menus->toArray(), ['root' => ['key' => 'root']], ['name' => 'key', 'parent' => 'parent', 'children' => 'children']);

        $menus = $traverser->reorderViaChildKnowsParent('parent');
        if (isset($menus['root'])) {
            unset($menus['root']);
        }

        $menus = $traverser->update($menus, function ($key, &$menu, &$parent) use ($traverser) {
            $menu['active'] = false;

            if (is_null($menu['type'])) {
                $menu['is_absolute_slug'] = true;
                $menu['url'] = $menu['slug'];
            } else {
                if (url(Request::path()) === url($menu['slug']) || Request::path() === $menu['slug']) {
                    $menu['active'] = true;
                }
                $menu['url'] = url($menu['slug']);
            }
        });

        return Traverser::recursiveArrayValues($menus, 'children');
    }

    /**
     * Gets the menus in the location `main-menu`.
     *
     * @return array
     */
    public static function pages()
    {
        $instance = new static;

        $pages = Page::select(['title', 'code', 'id'])->get();
        $traverser = new Traverser($pages->toArray(), ['root' => ['code' => 'root']], ['name' => 'code']);

        $menus = $traverser->reorderViaChildKnowsParent('parent');

        if (isset($menus['root'])) {
            unset($menus['root']);
        }

        foreach ($menus as &$menu) {
            $menu['is_home'] = false;
            $menu['page_id'] = $menu['id'];
        }

        return Traverser::recursiveArrayValues($menus, 'children');
    }

    /**
     * Gets the menus in the location `social-menu`.
     *
     * @return array
     */
    public static function social()
    {
        $instance = new static;

        $menus = unserialize(settings('social_links', ''));

        if (empty($menus)) {
            return [];
        }

        foreach ($menus as $key => $menu) {
            $menus[$key] = [
                'name' => $key,
                'title' => $menu['name'],
                'slug' => $menu['url'],
                'code' => $menu['url'],
                'url' => $menu['url'],
                'icon' => $menu['icon'],
                'is_absolute_slug' => true,
            ];
        }

        $traverser = new Traverser((array) $menus, ['root' => ['name' => 'root']], ['name' => 'name', 'parent' => 'parent']);

        $menus = $traverser->reorderViaChildKnowsParent();

        if (isset($menus['root'])) {
            unset($menus['root']);
        }

        return json_decode(json_encode(Traverser::recursiveArrayValues($menus, 'children')));
    }
}
