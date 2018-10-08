<?php

namespace User\Observers;

use User\Models\Detail;

class DetailObserver
{
    /**
     * Listen to the DetailObserver created event.
     *
     * @param  \User\Models\Detail  $resource
     * @return void
     */
    public function created(Detail $resource)
    {
        // save fields
        session()->flash('title', $resource->user->fullname ?? "");
        session()->flash('message', "User successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the DetailObserver updated event.
     *
     * @param  \User\Models\Detail  $resource
     * @return void
     */
    public function updated(Detail $resource)
    {
        session()->flash('title', $resource->user->fullname ?? "");
        session()->flash('message', "User successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the DetailObserver deleted event.
     *
     * @param  \User\Models\Detail  $resource
     * @return void
     */
    public function deleted(Detail $resource)
    {
        session()->flash('title', $resource->user->fullname ?? "");
        session()->flash('message', "User successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the DetailObserver restored event.
     *
     * @param  \User\Models\Detail  $resource
     * @return void
     */
    public function restored(Detail $resource)
    {
        session()->flash('title', $resource->user->fullname ?? "");
        session()->flash('message', "User successfully restored");
        session()->flash('type', 'success');
    }
}
