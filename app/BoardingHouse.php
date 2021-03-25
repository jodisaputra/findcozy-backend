<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardingHouse extends Model
{
    protected $table = 'boarding_houses';

    protected $fillable = [
        'name',
        'address',
        'map_url',
        'city',
        'license',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
