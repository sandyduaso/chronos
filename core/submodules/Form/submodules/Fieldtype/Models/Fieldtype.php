<?php

namespace Fieldtype\Models;

use Field\Support\Relations\HasManyFields;
use Fieldtype\Support\Relations\HasManyFieldtypes;
use Form\Support\Relations\BelongsToForm;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Pluma\Support\Database\Scopes\SlugOrFail;
use User\Support\Traits\BelongsToUser;

class Fieldtype extends Model
{
    use SoftDeletes, SlugOrFail, BelongsToForm, BelongsToUser, HasManyFieldtypes, HasManyFields;

    protected $fillable = ['id', 'name', 'code'];

    protected $appends = ['created', 'modified', 'removed'];

    protected $searchables = ['name', 'code', 'body', 'template', 'created_at', 'updated_at'];
}
