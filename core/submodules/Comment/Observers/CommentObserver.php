<?php

namespace Comment\Observers;

use Comment\Models\Comment;

class CommentObserver
{
    /**
     * Listen to the CommentObserver created event.
     *
     * @param  \Comment\Models\Comment  $resource
     * @return void
     */
    public function created(Comment $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Comment successfully posted");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the CommentObserver updated event.
     *
     * @param  \Comment\Models\Comment  $resource
     * @return void
     */
    public function updated(Comment $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Comment successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the CommentObserver deleted event.
     *
     * @param  \Comment\Models\Comment  $resource
     * @return void
     */
    public function deleted(Comment $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Comment successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the CommentObserver restored event.
     *
     * @param  \Comment\Models\Comment  $resource
     * @return void
     */
    public function restored(Comment $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Comment successfully restored");
        session()->flash('type', 'success');
    }
}
