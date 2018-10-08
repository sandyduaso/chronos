<?php

namespace Comment\Support\Traits;

use Comment\Models\Comment;

trait HasOneParentComment
{
    /**
     * Gets the parent of the comment.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function parent()
    {
        return $this->hasOne(Comment::class, 'id', 'parent_id');
    }
}
