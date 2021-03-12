<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'roles',
        'phone_number',
        'profile_photo',
        'gender'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
