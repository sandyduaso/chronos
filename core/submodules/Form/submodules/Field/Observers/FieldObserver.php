<?php

namespace Field\Observers;

use Field\Models\Field;

class FieldObserver
{
    /**
     * Listen to the FieldObserver created event.
     *
     * @param  \Field\Models\Field  $resource
     * @return void
     */
    public function created(Field $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Field successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the FieldObserver updated event.
     *
     * @param  \Field\Models\Field  $resource
     * @return void
     */
    public function updated(Field $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Field successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the FieldObserver deleted event.
     *
     * @param  \Field\Models\Field  $resource
     * @return void
     */
    public function deleted(Field $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Field successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the FieldObserver restored event.
     *
     * @param  \Field\Models\Field  $resource
     * @return void
     */
    public function restored(Field $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Field successfully restored");
        session()->flash('type', 'success');
    }
}
