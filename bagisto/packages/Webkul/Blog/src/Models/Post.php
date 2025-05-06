<?php

namespace Webkul\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Blog\Contracts\Post as PostContract;

class Post extends Model implements PostContract
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'status',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
