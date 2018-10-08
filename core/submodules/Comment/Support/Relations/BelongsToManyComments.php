<?php

namespace Comment\Support\Relations;

use Comment\Models\Comment;

trait BelongsToManyComments
{
    public function comments()
    {
        return $this->belongsToMany(Comment::class);
    }
}
