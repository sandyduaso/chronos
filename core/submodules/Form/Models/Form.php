<?php

namespace Form\Models;

use Field\Support\Relations\HasManyFields;
use Form\Support\Relations\BelongsToForm;
use Form\Support\Accessors\FormAccessor;
use Frontier\Support\Traits\TypeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Pluma\Support\Database\Scopes\SlugOrFail;
use Submission\Support\Relations\HasManySubmissions;
use User\Support\Traits\BelongsToUser;

class Form extends Model
{
    use BelongsToForm,
        BelongsToUser,
        FormAccessor,
        TypeTrait,
        HasManyFields,
        HasManySubmissions,
        SlugOrFail,
        SoftDeletes;

    protected $with = ['fields'];

    protected $fillable = [
        'id',
        'name',
        'code',
        'action',
        'method',
        'type',
        'attributes',
        'body',
        'delta',
        'success_message',
        'error_message',
    ];

    protected $appends = ['author', 'created', 'modified', 'removed'];

    protected $searchables = [
        'name',
        'code',
        'body',
        'template',
        'created_at',
        'updated_at',
    ];
}
