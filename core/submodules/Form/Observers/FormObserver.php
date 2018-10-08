<?php

namespace Form\Observers;

use Form\Models\Form;

class FormObserver
{
    /**
     * Listen to the FormObserver created event.
     *
     * @param  \Form\Models\Form  $resource
     * @return void
     */
    public function created(Form $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Form successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the FormObserver updated event.
     *
     * @param  \Form\Models\Form  $resource
     * @return void
     */
    public function updated(Form $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Form successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the FormObserver deleted event.
     *
     * @param  \Form\Models\Form  $resource
     * @return void
     */
    public function deleted(Form $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Form successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the FormObserver restored event.
     *
     * @param  \Form\Models\Form  $resource
     * @return void
     */
    public function restored(Form $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Form successfully restored");
        session()->flash('type', 'success');
    }
}
