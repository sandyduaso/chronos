<?php

namespace Frontier\Composers;

use Pluma\Support\Composers\BaseViewComposer;

class ClientSideVariableViewComposer extends BaseViewComposer
{
    /**
     * The view's variable.
     *
     * @var string
     */
    protected $name = 'clientVariables';

    /**
     * Handles the view to compose.
     *
     * @return Object|StdClass
     */
    public function handle()
    {
        return collect([
            'debug' => config('debugging.debug'),
        ]);
    }
}
