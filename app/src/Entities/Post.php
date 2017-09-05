<?php

namespace Minion\Entities;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Minion\Events\PostCreated;
use Minion\Events\PostDeleted;
use Minion\Events\PostUpdated;

class Post extends Model
{
    use Sluggable;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'published_at'];

    /**
     * [$translatable description]
     * @var [type]
     */
    public $translatable = [
        'title',
        'slug',
        'content',
        'source',
        'excerpt',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'author',
        'publish',
        'published_at',
        'parent_id',
        'order',
        'comment_status',
        'comment_count',
        'layout',
        'pinned',
        // translate this field
        'title',
        'slug',
        'content',
        'source',
        'excerpt',
    ];

    /**
     * [author description]
     *  @return Minion\Entities\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }

    /**
     * Meta data relationship
     *
     * @return Minion\Entities\PostMetaCollection
     */
    public function meta()
    {
        return $this->hasMany(PostMeta::class, 'post_id');
    }

    /**
     * [categories description]
     * @return [type] [description]
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }

    /**
     * [comments description]
     * @return [type] [description]
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    /**
     * same of meta
     * @return [type] [description]
     */
    public function fields()
    {
        return $this->meta();
    }

    /**
     * Get parent to specific node (if exist)
     *
     * @return static
     */
    public function parent()
    {
        return $this->belongsTo(get_class($this), 'parent_id', $this->getKeyName());
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

    /**
     * [scopeMenus description]
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeMenus($query)
    {
        return $query->whereNull('parent_id')->where('published_at', '<=', Carbon::now()->format('Y-m-d H:i:s'))->wherePublish(1)->orderBy('order');
    }

    /**
     * [scopeType description]
     * @param  Builder $query [description]
     * @param  [type]  $type  [description]
     * @return [type]         [description]
     */
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * [scopeTypeIn description]
     * @param  Builder $query [description]
     * @param  array   $type  [description]
     * @return [type]         [description]
     */
    public function scopeTypeIn($query, array $type)
    {
        return $query->whereIn('type', $type);
    }

    /**
     * [scopePublish description]
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopePublish($query)
    {
        return $query->where('publish', 1);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
