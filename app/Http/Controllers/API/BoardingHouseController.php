<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BoardingHouse;
use App\Http\Resources\BoardingHouseCollection;

class BoardingHouseController extends Controller
{
    public function index()
    {
        return new BoardingHouseCollection(BoardingHouse::paginate(10));
    }
}
