<?php

namespace App\Models\Hoosh;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $guarded = [];

    protected $table = 'hoosh_users';

    public function answers()
    {
        return $this->hasMany(Answer::class, 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }
}
