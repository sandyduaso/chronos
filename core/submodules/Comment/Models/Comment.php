<?php

namespace Comment\Models;

use Comment\Support\Relations\HasManyChildComments;
use Comment\Support\Relations\MorphToCommentable;
use Comment\Support\Scopes\ApprovedScope;
use Comment\Support\Scopes\ParentCommentsTrait;
use Comment\Support\Traits\CanBeVotedTrait;
use Comment\Support\Traits\HasOneParentComment;
use Frontier\Support\Traits\Ownable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Course;
use Pluma\Models\Model;
use Pluma\Models\User;
use User\Support\Traits\BelongsToUser;

class Comment extends Model
{
    use CanBeVotedTrait,
        HasManyChildComments,
        HasOneParentComment,
        Ownable,
        ParentCommentsTrait,
        MorphToCommentable,
        SoftDeletes,
        BelongsToUser;

    protected $with = ['user'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // Only get all 'approved' comments.
        static::addGlobalScope(new ApprovedScope);
    }
}
