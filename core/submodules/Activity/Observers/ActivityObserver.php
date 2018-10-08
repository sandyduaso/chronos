<?php

namespace Activity\Observers;

use Activity\Models\Activity;

class ActivityObserver
{
    /**
     * Listen to the ActivityObserver created event.
     *
     * @param  \Activity\Models\Activity  $resource
     * @return void
     */
    public function created(Activity $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Activity successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the ActivityObserver updated event.
     *
     * @param  \Activity\Models\Activity  $resource
     * @return void
     */
    public function updated(Activity $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Activity successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the ActivityObserver deleted event.
     *
     * @param  \Activity\Models\Activity  $resource
     * @return void
     */
    public function deleted(Activity $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Activity successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the ActivityObserver restored event.
     *
     * @param  \Activity\Models\Activity  $resource
     * @return void
     */
    public function restored(Activity $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Activity successfully restored");
        session()->flash('type', 'success');
    }
}
