<?php

namespace Fieldtype\Observers;

use Fieldtype\Models\Fieldtype;

class FieldtypeObserver
{
    /**
     * Listen to the FieldtypeObserver created event.
     *
     * @param  \Fieldtype\Models\Fieldtype  $resource
     * @return void
     */
    public function created(Fieldtype $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Fieldtype successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the FieldtypeObserver updated event.
     *
     * @param  \Fieldtype\Models\Fieldtype  $resource
     * @return void
     */
    public function updated(Fieldtype $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Fieldtype successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the FieldtypeObserver deleted event.
     *
     * @param  \Fieldtype\Models\Fieldtype  $resource
     * @return void
     */
    public function deleted(Fieldtype $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Fieldtype successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the FieldtypeObserver restored event.
     *
     * @param  \Fieldtype\Models\Fieldtype  $resource
     * @return void
     */
    public function restored(Fieldtype $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Fieldtype successfully restored");
        session()->flash('type', 'success');
    }
}
