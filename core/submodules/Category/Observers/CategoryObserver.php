<?php

namespace Category\Observers;

use Category\Models\Category;

class CategoryObserver
{
    /**
     * Listen to the CategoryObserver created event.
     *
     * @param  \Category\Models\Category  $resource
     * @return void
     */
    public function created(Category $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Category successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the CategoryObserver updated event.
     *
     * @param  \Category\Models\Category  $resource
     * @return void
     */
    public function updated(Category $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Category successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the CategoryObserver deleted event.
     *
     * @param  \Category\Models\Category  $resource
     * @return void
     */
    public function deleted(Category $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Category successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the CategoryObserver restored event.
     *
     * @param  \Category\Models\Category  $resource
     * @return void
     */
    public function restored(Category $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Category successfully restored");
        session()->flash('type', 'success');
    }
}
