<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardingRoom extends Model
{
    protected $fillable = [
        'name',
        'status',
        'price'
    ];
}
