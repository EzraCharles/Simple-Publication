<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'user_id',
    ];

    /**
     * Get the Comments of the Publication
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get the User who wrote the Publication
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
