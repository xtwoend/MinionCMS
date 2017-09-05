<?php

namespace Minion\Entities;

use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    /**
     * [$timestamps description]
     * @var boolean
     */
    public $timestamps = false;

    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'meta_key',
        'meta_value',
        'post_id',
    ];

    /**
     * Post relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Override newCollection() to return a custom collection
     *
     * @param array $models
     * @return \PostMetaCollection
     */
    public function newCollection(array $models = array())
    {
        return new PostMetaCollection($models);
    }
}
