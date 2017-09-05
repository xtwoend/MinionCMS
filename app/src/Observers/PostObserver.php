<?php

namespace Minion\Observers;

use Minion\Entities\Post;
use Minion\Events\PostCreated;
use Minion\Events\PostDeleted;
use Minion\Events\PostUpdated;


class PostObserver
{
    /**
     * Listen to the post created event.
     *
     * @param  Post  $user
     * @return void
     */
    public function created(Post $post)
    {
        event(new PostCreated($post));
    }

    /**
     * Listen to the post created event.
     *
     * @param  Post  $user
     * @return void
     */
    public function updated(Post $post)
    {
        event(new PostUpdated($post));
    }

    /**
     * Listen to the Post deleting event.
     *
     * @param  Post  $post
     * @return void
     */
    public function deleting(Post $post)
    {
        event(new PostDeleted($post));
    }
}