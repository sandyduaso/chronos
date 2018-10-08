<?php

namespace Menu\Observers;

use Menu\Models\Menu;

class MenuObserver
{
    /**
     * Listen to the MenuObserver created event.
     *
     * @param  \Menu\Models\Menu  $resource
     * @return void
     */
    public function created(Menu $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Menu successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the MenuObserver updated event.
     *
     * @param  \Menu\Models\Menu  $resource
     * @return void
     */
    public function updated(Menu $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Menu successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the MenuObserver deleted event.
     *
     * @param  \Menu\Models\Menu  $resource
     * @return void
     */
    public function deleted(Menu $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Menu successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the MenuObserver restored event.
     *
     * @param  \Menu\Models\Menu  $resource
     * @return void
     */
    public function restored(Menu $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Menu successfully restored");
        session()->flash('type', 'success');
    }
}
