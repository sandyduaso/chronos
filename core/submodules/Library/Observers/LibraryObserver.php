<?php

namespace Library\Observers;

use Library\Models\Library;

class LibraryObserver
{
    /**
     * Listen to the LibraryObserver created event.
     *
     * @param  \Library\Models\Library  $resource
     * @return void
     */
    public function created(Library $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Library successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the LibraryObserver updated event.
     *
     * @param  \Library\Models\Library  $resource
     * @return void
     */
    public function updated(Library $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Library successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the LibraryObserver deleted event.
     *
     * @param  \Library\Models\Library  $resource
     * @return void
     */
    public function deleted(Library $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Library successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the LibraryObserver restored event.
     *
     * @param  \Library\Models\Library  $resource
     * @return void
     */
    public function restored(Library $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Library successfully restored");
        session()->flash('type', 'success');
    }
}
