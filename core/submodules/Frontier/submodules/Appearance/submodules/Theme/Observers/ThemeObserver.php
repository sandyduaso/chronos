<?php

namespace Theme\Observers;

use Theme\Models\Theme;

class ThemeObserver
{
    /**
     * Listen to the ThemeObserver created event.
     *
     * @param  \Theme\Models\Theme  $resource
     * @return void
     */
    public function created(Theme $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Theme successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the ThemeObserver updated event.
     *
     * @param  \Theme\Models\Theme  $resource
     * @return void
     */
    public function updated(Theme $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Theme successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the ThemeObserver deleted event.
     *
     * @param  \Theme\Models\Theme  $resource
     * @return void
     */
    public function deleted(Theme $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Theme successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the ThemeObserver restored event.
     *
     * @param  \Theme\Models\Theme  $resource
     * @return void
     */
    public function restored(Theme $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Theme successfully restored");
        session()->flash('type', 'success');
    }
}
