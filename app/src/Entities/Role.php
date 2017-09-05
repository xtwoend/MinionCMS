<?php

namespace Minion\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Minion\Entities\User;

class Role extends Model
{
    use Sluggable;

    /**
     * [$table description]
     * @var string
     */
    protected $table = 'roles';

    /**
     * [$casts description]
     * @var [type]
     */
    protected $casts = [
        'permissions' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'permissions'
    ];

    /**
     * [users description]
     * @return [type] [description]
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }

    /**
     * [hasAccess description]
     * @param  array   $permissions [description]
     * @return boolean              [description]
     */
    public function hasAccess(array $permissions) : bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission))
                return true;
        }
        return false;
    }

    /**
     * [hasPermission description]
     * @param  string  $permission [description]
     * @return boolean             [description]
     */
    private function hasPermission(string $permission) : bool
    {
        return $this->permissions[$permission] ?? false;
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
                'source' => 'name'
            ]
        ];
    }
}
