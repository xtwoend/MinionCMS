<?php

namespace Minion\Observers;

use Minion\Entities\User;
use Minion\Events\UserCreated;
use Minion\Events\UserDeleted;
use Minion\Events\UserUpdated;


class UserObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(User $user)
    {
        event(new UserCreated($user));
    }

    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function updated(User $user)
    {
        event(new UserUpdated($user));
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        event(new UserDeleted($user));
    }
}