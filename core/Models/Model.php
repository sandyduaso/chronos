<?php

namespace Pluma\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Facades\Request;
use Pluma\Scopes\ExceptScope;
use Pluma\Support\Cache\Scopes\CachedScope;
use Pluma\Support\Database\Scopes\ExceptableTrait;
use Pluma\Support\Database\Scopes\SearchableTrait;
use Pluma\Support\Database\Traits\BaseRelations;
use Pluma\Support\Mutators\BaseMutator;

class Model extends BaseModel
{
    use BaseMutator,
        BaseRelations,
        CachedScope,
        ExceptableTrait,
        SearchableTrait;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 15;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->perPage = (int) request()->get('per_page') > 0
            ? request()->get('per_page')
            : $this->perPage;

        $this->setPerPage(settings('items_per_page', $this->perPage));
    }

    /**
     * Boot the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // For observer events
        Model::setEventDispatcher(app('events'));
    }
}
