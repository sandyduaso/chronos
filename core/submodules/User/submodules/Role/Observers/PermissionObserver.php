<?php

namespace Role\Observers;

use Role\Models\Permission;

class PermissionObserver
{
    /**
     * Listen to the Permission created event.
     *
     * @param  \Permission\Models\Permission  $resource
     * @return void
     */
    public function created(Permission $resource)
    {
        // save fields
        session()->flash('message', "Permission successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Permission updated event.
     *
     * @param  \Permission\Models\Permission  $resource
     * @return void
     */
    public function updated(Permission $resource)
    {
        session()->flash('message', 'Permission successfully refreshed');
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Permission deleted event.
     *
     * @param  \Permission\Models\Permission  $resource
     * @return void
     */
    public function deleted(Permission $resource)
    {
        session()->flash('message', "Permission successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Permission restored event.
     *
     * @param  \Permission\Models\Permission  $resource
     * @return void
     */
    public function restored(Permission $resource)
    {
        session()->flash('message', "Permission successfully restored");
        session()->flash('type', 'success');
    }
}
