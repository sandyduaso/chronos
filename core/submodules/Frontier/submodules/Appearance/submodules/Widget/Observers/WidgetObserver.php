<?php

namespace Widget\Observers;

use Widget\Models\Widget;

class WidgetObserver
{
    /**
     * Listen to the WidgetObserver created event.
     *
     * @param  \Widget\Models\Widget  $resource
     * @return void
     */
    public function created(Widget $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Widget successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the WidgetObserver updated event.
     *
     * @param  \Widget\Models\Widget  $resource
     * @return void
     */
    public function updated(Widget $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Widget successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the WidgetObserver deleted event.
     *
     * @param  \Widget\Models\Widget  $resource
     * @return void
     */
    public function deleted(Widget $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Widget successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the WidgetObserver restored event.
     *
     * @param  \Widget\Models\Widget  $resource
     * @return void
     */
    public function restored(Widget $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Widget successfully restored");
        session()->flash('type', 'success');
    }
}
