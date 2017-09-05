<?php

namespace Minion\Entities;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{   
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'settings';
    
    /**
     * [$timestamps description]
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'value'
    ];

    
}
