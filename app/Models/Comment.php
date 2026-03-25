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
        'parent_id',

    ];

    public function user()
    {return $this->belongsTo(User::class);}

    public function commentable():MorphTo
    {
        return $this->morphTo();
    }

    public function replies()
    {return $this->hasMany(Comment::class,'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class,'parent_id');
    }
}
