<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BoardingRoom;
use App\Http\Resources\BoardingRoomCollection;

class BoardingRoomController extends Controller
{
    public function index()
    {
        return new BoardingRoomCollection(BoardingRoom::where('status', 'available')->paginate(10));
    }
}
