<?php

namespace Minion\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'count'
    ];

    /**
     * [posts description]
     * @return [type] [description]
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_category', 'category_id', 'post_id');
    }

    /**
     * Get children to specific node (if exist)
     *
     * @return static
     */
    public function children()
    {
        return $this->hasMany(get_class($this), 'parent_id', $this->getKeyName());
    }
}
