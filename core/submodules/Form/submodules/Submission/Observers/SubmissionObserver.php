<?php

namespace Submission\Observers;

use Submission\Models\Submission;

class SubmissionObserver
{
    /**
     * Listen to the SubmissionObserver created event.
     *
     * @param  \Submission\Models\Submission  $resource
     * @return void
     */
    public function created(Submission $resource)
    {
        $resource->score = $resource->compute();
        $resource->save();

        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Submission successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the SubmissionObserver updated event.
     *
     * @param  \Submission\Models\Submission  $resource
     * @return void
     */
    public function updated(Submission $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Submission successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the SubmissionObserver deleted event.
     *
     * @param  \Submission\Models\Submission  $resource
     * @return void
     */
    public function deleted(Submission $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Submission successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the SubmissionObserver restored event.
     *
     * @param  \Submission\Models\Submission  $resource
     * @return void
     */
    public function restored(Submission $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Submission successfully restored");
        session()->flash('type', 'success');
    }
}
