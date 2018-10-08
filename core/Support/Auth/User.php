<?php

namespace Pluma\Support\Auth;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Pluma\Support\Auth\Accessors\UserAccessor;
use Pluma\Support\Auth\Traits\Authorizable;
use Pluma\Support\Cache\Scopes\CachedScope;
use Pluma\Support\Database\Scopes\ExceptableTrait;
use Pluma\Support\Database\Scopes\SearchableTrait;
use Pluma\Support\Database\Traits\BaseRelations;
use Pluma\Support\Mutators\BaseMutator;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable,
        Authorizable,
        BaseMutator,
        BaseRelations,
        CachedScope,
        CanResetPassword,
        ExceptableTrait,
        Notifiable,
        SearchableTrait,
        SoftDeletes,
        UserAccessor;

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

        $this->perPage = Request::get('per_page') ?? $this->perPage;
        $this->setPerPage(settings('items_per_page', $this->perPage));
    }

    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // For observer events
        // User::setEventDispatcher(app('events'));
    }
}
