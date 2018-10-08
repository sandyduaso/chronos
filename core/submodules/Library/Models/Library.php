<?php

namespace Library\Models;

use Catalogue\Support\Scopes\OfCatalogue;
use Catalogue\Support\Traits\BelongsToCatalogue;
use Frontier\Support\Traits\TypeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Library\Support\Accessors\LibraryAccessor;
use Pluma\Models\Model;

class Library extends Model
{
    use BelongsToCatalogue,
        LibraryAccessor,
        OfCatalogue,
        SoftDeletes,
        TypeTrait;

    protected $table = 'library';

    protected $appends = [
        'created',
        'filesize',
        'icon',
        'modified',
        'thumbnail',
    ];

    protected $searchables = [
        'created_at',
        'mimetype',
        'name',
        'originalname',
        'size',
        'thumbnail',
        'type',
        'updated_at',
        'url',
    ];
}
