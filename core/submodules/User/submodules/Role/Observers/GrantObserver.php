<?php

namespace Role\Observers;

use Role\Models\Grant;

class GrantObserver
{
    /**
     * Listen to the Grant created event.
     *
     * @param  \Role\Models\Grant  $resource
     * @return void
     */
    public function created(Grant $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Grant successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Grant updated event.
     *
     * @param  \Role\Models\Grant  $resource
     * @return void
     */
    public function updated(Grant $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Grant successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Grant deleted event.
     *
     * @param  \Role\Models\Grant  $resource
     * @return void
     */
    public function deleted(Grant $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Grant successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Grant restored event.
     *
     * @param  \Role\Models\Grant  $resource
     * @return void
     */
    public function restored(Grant $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Grant successfully restored");
        session()->flash('type', 'success');
    }
}
