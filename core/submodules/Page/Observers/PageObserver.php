<?php

namespace Page\Observers;

use Page\Models\Page;

class PageObserver
{
    /**
     * Listen to the PageObserver created event.
     *
     * @param  Page\Models\Page  $page
     * @return void
     */
    public function created(Page $page)
    {
        // save fields
        session()->flash('title', $page->title);
        session()->flash('message', "Page successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the PageObserver updated event.
     *
     * @param  Page\Models\Page  $page
     * @return void
     */
    public function updated(Page $page)
    {
        session()->flash('title', $page->title);
        session()->flash('message', "Page successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the PageObserver deleted event.
     *
     * @param  Page\Models\Page  $page
     * @return void
     */
    public function deleted(Page $page)
    {
        session()->flash('title', $page->title);
        session()->flash('message', "Page successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the PageObserver restored event.
     *
     * @param  Page\Models\Page  $page
     * @return void
     */
    public function restored(Page $page)
    {
        session()->flash('title', $page->title);
        session()->flash('message', "Page successfully restored");
        session()->flash('type', 'success');
    }
}
