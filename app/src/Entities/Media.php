<?php

namespace Minion\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename',
        'extension',
        'mimetype',
        'filesize',
        'filepath',
        'url',
        'thumb',
        'type',
        'disk',
        'publish',
        'album_id',
        'name',
        'description',
    ];


    // this is a recommended way to declare event handlers
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            if(Storage::disk($model->disk)->delete($model->filepath)){
                return true;
            }
            return false;
        });
    }
}
