<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Blog extends Model
{
    protected $fillable=[
        'user_id',
        'content',
        'image',
        'video'
    ];
    public function user()
    { return $this->belongsTo(User::class);}

}
