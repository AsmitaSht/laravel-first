<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Comment extends Model
{
    protected $fillable=[
        'commentable_id',
        'commentable_type',
        'user_id',
        'content',

    ];

    public function user()
    {return $this->belongsTo(User::class);}

    public function commentable():MorphTo
    {
        return $this->morphTo();
    }
}
