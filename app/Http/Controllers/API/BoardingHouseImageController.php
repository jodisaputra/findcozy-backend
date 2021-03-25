<?php

namespace App\Http\Controllers\API;

use App\BoardingHouseImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BoardingHouseImageController extends Controller
{
    public function index()
    {
        return BoardingHouseImage::paginate(10);
    }
}
