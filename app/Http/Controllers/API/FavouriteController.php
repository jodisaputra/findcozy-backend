<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavouriteCollection;
use Illuminate\Http\Request;
use App\Favourite;
use App\Http\Resources\Favourite as ResourcesFavourite;
use Illuminate\Support\Facades\Validator;

class FavouriteController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        return new FavouriteCollection($user->favourites);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'boarding_house_id' => 'required|numeric',
        ]);

        if($validator->fails())
        {
            return response(['errors' => $validator->errors()], 422);
        }

        $favourite = Favourite::create([
            'user_id' => $request->user_id,
            'boarding_house_id' => $request->boarding_house_id
        ]);

        return response([
            'message' => 'Data berhasil disimpan',
            'data' => $favourite
        ], 200);
    }

    public function destroy($id)
    {
        $favourite = Favourite::findOrFail($id);
        $favourite->delete();

        return response([
            'message' => 'Data berhasil dihapus',
        ], 200);

    }


}
