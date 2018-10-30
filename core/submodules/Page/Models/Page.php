<?php

namespace Page\Models;

use Category\Support\Relations\BelongsToCategory;
use Frontier\Support\Breadcrumbs\Accessors\Breadcrumable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Page\Support\Accessors\PageAccessor;
use Page\Support\Relations\BelongsToPage;
use Page\Support\Relations\PageHasManyPages;
use Pluma\Models\Model;
use Pluma\Support\Database\Scopes\CodeOrFailScope;
use User\Support\Traits\BelongsToUser;

class Page extends Model
{
    use BelongsToCategory,
        BelongsToPage,
        BelongsToUser,
        Breadcrumable,
        PageHasManyPages,
        PageAccessor,
        CodeOrFailScope,
        SoftDeletes;

    /**
     * The key to use for the breadcrumb middleware.
     *
     * @var string
     */
    protected $crumb = 'title';

    protected $guarded = [];

    protected $searchables = [
        'title',
        'code',
        'body',
        'template',
        'created_at',
        'updated_at',
    ];
}
