<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class Blog extends Model
{
    // use HasActiveScope,HasFactory;
    protected $fillable=[
        'user_id',
        'content',
        'image',
        'video'
    ];
    public function user()
    { return $this->belongsTo(User::class);}

    public function comments():MorphMany
    {
        return $this->morphMany(Comment::class,'commentable')   ;
    }

}
