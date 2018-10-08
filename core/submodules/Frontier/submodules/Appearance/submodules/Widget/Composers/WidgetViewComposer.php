<?php

namespace Widget\Composers;

use Pluma\Support\Composers\BaseViewComposer;
use Widget\Models\Widget;

class WidgetViewComposer extends BaseViewComposer
{
    /**
     * The view's variable.
     *
     * @var string
     */
    protected $name = 'widgets';

    /**
     * The array of widgets.
     *
     * @var array
     */
    protected $widgets = [];

    /**
     * Handles the view to compose.
     *
     * @return Object|StdClass
     */
    public function handle()
    {
        return $this->widgets();
    }

    /**
     * Get all widgets.
     *
     * @return array
     */
    protected function widgets()
    {
        return Widget::get();
    }
}
