<?php

namespace Webkul\Member\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Member\Contracts\Member as MemberContract;

class Member extends Model implements MemberContract
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'user_id',
        'address',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
