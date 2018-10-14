<?php

namespace Employee\Models;

use Category\Models\Category;
use Pluma\Models\Model;

class Department extends Category
{
    protected $table = 'categories';

    protected $searchables = ['created_at', 'updated_at'];
}
