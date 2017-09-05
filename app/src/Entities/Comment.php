<?php

namespace Minion\Entities;

use Illuminate\Database\Eloquent\Model;
use Minion\Entities\Post;

class Comment extends Model
{
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'comment_author',
        'comment_email',
        'comment_website',
        'comment_ip',
        'content',
        'approved',
        'parent_id',
        'user_id'
    ];

    /**
     * [post description]
     * @return [type] [description]
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    /**
     * Get children to specific node (if exist)
     *
     * @return static
     */
    public function replies()
    {
        return $this->hasMany(get_class($this), 'parent_id', $this->getKeyName());
    }

    /**
     * filter by approved comment
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeApproved($query)
    {
        return $query->where('approved', 1);
    }

    // this is a recommended way to declare event handlers
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if($model->post()->increment('comment_count')){
                return true;
            }
            return false;
        });
    }
}
