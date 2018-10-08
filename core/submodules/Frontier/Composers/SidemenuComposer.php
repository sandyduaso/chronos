<?php

namespace Frontier\Composers;

use Crowfeather\Traverser\Traverser;
use Frontier\Composers\SidebarComposer;
use Illuminate\View\View;
use Pluma\Support\Modules\Traits\ModulerTrait;

class SidemenuComposer extends SidebarComposer
{
    use ModulerTrait;

    /**
     * The view's variable.
     *
     * @var string
     */
    protected $name = 'sidemenus';

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
        $modules = $this->getFileFromModules('config/sidemenus.php');
        $this->generateMenusFromModules($modules);
        $this->buildMenus(new Traverser());

        return $this->menus;
    }
}
