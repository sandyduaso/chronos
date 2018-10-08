<?php

namespace Role\Observers;

use Role\Models\Role;

class RoleObserver
{
    /**
     * Listen to the Role created event.
     *
     * @param  \Role\Models\Role  $resource
     * @return void
     */
    public function created(Role $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Role successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Role updated event.
     *
     * @param  \Role\Models\Role  $resource
     * @return void
     */
    public function updated(Role $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Role successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Role deleted event.
     *
     * @param  \Role\Models\Role  $resource
     * @return void
     */
    public function deleted(Role $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Role successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Role restored event.
     *
     * @param  \Role\Models\Role  $resource
     * @return void
     */
    public function restored(Role $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Role successfully restored");
        session()->flash('type', 'success');
    }
}
