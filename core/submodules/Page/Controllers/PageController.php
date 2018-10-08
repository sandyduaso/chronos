<?php

namespace Page\Controllers;

use Frontier\Controllers\GeneralController;

class PageController extends GeneralController
{
    use Resources\PageResourceAdminTrait,
        Resources\PageResourceApiTrait,
        Resources\PageResourcePublicTrait,
        Resources\PageResourceSoftDeleteTrait;
}
