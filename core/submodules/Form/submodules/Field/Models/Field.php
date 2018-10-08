<?php

namespace Field\Models;

use Field\Support\Relations\HasManyFields;
use Field\Support\Traits\FieldMutatorTrait;
use Field\Support\Traits\TemplateTrait;
use Fieldtype\Support\Relations\BelongsToFieldtype;
use Form\Support\Relations\BelongsToForm;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Pluma\Support\Database\Scopes\SlugOrFail;
use User\Support\Traits\BelongsToUser;

class Field extends Model
{
    use SoftDeletes, SlugOrFail, BelongsToUser, BelongsToFieldtype, BelongsToForm, HasManyFields, FieldMutatorTrait, TemplateTrait;

    protected $fillable = ['id', 'name', 'code', 'action', 'method', 'type', 'attributes', 'body', 'delta', 'success_message', 'error_message'];

    protected $appends = ['author', 'created', 'modified', 'removed'];

    protected $searchables = ['name', 'code', 'type', 'body', 'template', 'created_at', 'updated_at'];
}

