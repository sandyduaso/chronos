<?php

namespace Pluma\Support\Policy;

use Pluma\Support\Auth\User;

class Policy
{
    /**
     * The authenticated user instance.
     *
     * @var \Pluma\Support\Auth\User
     */
    protected $user;

    /**
     * The keyword the permissions file used.
     *
     * @var string
     */
    protected $limitkey = 'unrestricted';

    /**
     * Run before any action in this class.
     *
     * @param  User\Models\User $user
     * @param  string $ability
     * @return mixed
     */
    public function before(User $user, $ability)
    {
        $this->user = $user;

        if ($this->user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Check if user is authorized via permission.
     *
     * @return boolean
     */
    protected function unrestricted($key)
    {
        return $this->user->can("$key.{$this->limitkey}");
    }
}
