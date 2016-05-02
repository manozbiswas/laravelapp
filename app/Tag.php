<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected  $fillable=[
        'name',
    ];
//    public function posts()
//    {
//        return $this->morphedByMany('App\Post', 'taggable');
//    }
//
//    /**
//     * Get all of the videos that are assigned this tag.
//     */
//    public function videos()
//    {
//        return $this->morphedByMany('App\Video', 'taggable');
//    }
}
