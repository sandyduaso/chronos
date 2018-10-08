<?php

namespace User\Support\Traits;

use User\Notifications\ResetPasswordNotification;

trait CanResetPasswordTrait
{
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
