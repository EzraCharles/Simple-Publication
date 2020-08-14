<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'content', 'publication_id',
    ];

    /**
     * Get the Publication which belongs
     */
    public function publication()
    {
        return $this->belongsTo('App\Publication');
    }

    /**
     * Get the User which belongs
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
