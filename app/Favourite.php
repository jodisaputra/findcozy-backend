<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\BoardingHouse;

class Favourite extends Model
{
    protected $fillable = [
        'boarding_house_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function boardinghouse()
    {
        return $this->belongsTo(BoardingHouse::class, 'id');
    }
}
