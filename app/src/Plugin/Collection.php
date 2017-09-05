<?php

namespace Minion\Plugin;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection as BaseCollection;

class Collection extends BaseCollection
{
    /**
     * Get items collections.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Get the collection of items as a plain array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_map(function ($value) {
            if ($value instanceof Plugin) {
                return $value->json()->getAttributes();
            }

            return $value instanceof Arrayable ? $value->toArray() : $value;

        }, $this->items);
    }
}
