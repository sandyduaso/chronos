<?php

namespace Template\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Template\Support\Traits\TemplateFileMetadata;

class Template extends Model
{
    use SoftDeletes, TemplateFileMetadata;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
