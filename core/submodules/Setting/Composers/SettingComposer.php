<?php

namespace Setting\Composers;

use Frontier\Support\Sidebar\Sidebar;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Pluma\Support\Composers\BaseViewComposer;

class SettingComposer extends BaseViewComposer
{
    /**
     * The view's variable.
     *
     * @var string
     */
    protected $name = 'settingsmenu';

    /**
     * Main function to tie everything together.
     *
     * @param  Illuminate\View\View   $view
     * @return void
     */
    public function compose(View $view)
    {
        parent::compose($view);

        $view->with($this->name(), $this->handle());
    }

    /**
     * Handles the view to compose.
     *
     * @return Object|StdClass
     */
    public function handle()
    {
        $sidebar = new Sidebar();

        return $sidebar->parent();
    }
}
