<?php

namespace Template\Observers;

use Template\Models\Template;

class TemplateObserver
{
    /**
     * Listen to the TemplateObserver created event.
     *
     * @param  \Template\Models\Template  $resource
     * @return void
     */
    public function created(Template $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Template successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the TemplateObserver updated event.
     *
     * @param  \Template\Models\Template  $resource
     * @return void
     */
    public function updated(Template $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Template successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the TemplateObserver deleted event.
     *
     * @param  \Template\Models\Template  $resource
     * @return void
     */
    public function deleted(Template $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Template successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the TemplateObserver restored event.
     *
     * @param  \Template\Models\Template  $resource
     * @return void
     */
    public function restored(Template $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Template successfully restored");
        session()->flash('type', 'success');
    }
}
