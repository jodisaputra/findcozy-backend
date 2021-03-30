<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BoardingHouse;
use App\BoardingRoom;
use App\Http\Resources\BoardingHouse as ResourcesBoardingHouse;
use App\Http\Resources\BoardingHouseCollection;
use App\Http\Resources\BoardingRoom as ResourcesBoardingRoom;

class BoardingHouseController extends Controller
{
    public function index()
    {
        return new BoardingHouseCollection(BoardingHouse::paginate(10));
    }

    public function all(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $address = $request->input('address');
        $limit = $request->input('limit', 6);

        if($id)
        {
            $boardinghouse = BoardingHouse::find($id);

            if($boardinghouse)
            {
                return new ResourcesBoardingHouse(BoardingHouse::find($id));
            }
            else
            {
                return response([
                    'data' => null,
                    'message' => 'Data tidak ada',
                ], 422);
            }
        }

        $boardinghouse = BoardingHouse::query();

        if($name)
        {
            // echo 'nama';
            $boardinghouse->where('name', 'like', '%' . $name . '%');
        }

        if($address)
        {
            $boardinghouse->where('address', 'like', '%' . $address . '%');
        }
        return response([
            'data' => $boardinghouse->paginate($limit),
            'message' => 'Data berhasil diambil',
        ], 200);
        // return new BoardingHouseCollection(BoardingHouse::paginate($limit));

    }
}
