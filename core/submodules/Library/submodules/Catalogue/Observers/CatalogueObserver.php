<?php

namespace Catalogue\Observers;

use Catalogue\Models\Catalogue;

class CatalogueObserver
{
    /**
     * Listen to the CatalogueObserver created event.
     *
     * @param  \Catalogue\Models\Catalogue  $resource
     * @return void
     */
    public function created(Catalogue $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Catalogue successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the CatalogueObserver updated event.
     *
     * @param  \Catalogue\Models\Catalogue  $resource
     * @return void
     */
    public function updated(Catalogue $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Catalogue successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the CatalogueObserver deleted event.
     *
     * @param  \Catalogue\Models\Catalogue  $resource
     * @return void
     */
    public function deleted(Catalogue $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Catalogue successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the CatalogueObserver restored event.
     *
     * @param  \Catalogue\Models\Catalogue  $resource
     * @return void
     */
    public function restored(Catalogue $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Catalogue successfully restored");
        session()->flash('type', 'success');
    }
}
