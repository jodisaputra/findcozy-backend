<?php

namespace App\Http\Controllers;

use App\BoardingRoom;
use App\BoardingHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
class BoardingRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $house = BoardingHouse::findOrFail($id);
        $title = 'List of Rooms ' . $house->name;
        $boardinghouseroom = BoardingRoom::where('boarding_house_id', $id)->get();
        return view('pages.boarding_house_room.index')->with([
            'title' => $title,
            'boardinghouserooms' => $boardinghouseroom,
            'boardinghouse_id' => $id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $house = BoardingHouse::findOrFail($id);
        $title = 'Add new room ' . $house->name;
        return view('pages.boarding_house_room.form')->with([
            'type' => 'add',
            'url' => route('boardinghouseroom.store'),
            'title' => $title,
            'boardinghouse_id' => $id,
            'name' => old('name'),
            'status' => old('status'),
            'price' => old('price')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'status' => 'required',
            'price' => 'required|numeric',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $boardingroom = new BoardingRoom;

        $boardingroom->boarding_house_id = $request->boardinghouse_id;
        $boardingroom->name = $request->name;
        $boardingroom->status = $request->status;
        $boardingroom->price = $request->price;
        $boardingroom->save();

        Alert::toast('Data saved successfully !', 'success');
        return redirect()->route('boardinghouseroom.index', $request->boardinghouse_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BoardingRoom  $boardingRoom
     * @return \Illuminate\Http\Response
     */
    public function show(BoardingRoom $boardingRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BoardingRoom  $boardingRoom
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $boardinghouse_id)
    {
        $boardingroom = BoardingRoom::findOrFail($id);
        $title = 'Edit Boarding Room';
        return view('pages.boarding_house_room.form')->with([
            'type' => 'edit',
            'url' => route('boardinghouseroom.update', $boardingroom->id),
            'title' => $title,
            'boardinghouse_id' => $boardinghouse_id,
            'name' => old('name', $boardingroom->name),
            'status' => old('status', $boardingroom->status),
            'price' => old('price', $boardingroom->price)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BoardingRoom  $boardingRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'status' => 'required',
            'price' => 'required|numeric',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $boardingroom = BoardingRoom::find($id);

        $boardingroom->boarding_house_id = $request->boardinghouse_id;
        $boardingroom->name = $request->name;
        $boardingroom->status = $request->status;
        $boardingroom->price = $request->price;
        $boardingroom->save();

        Alert::toast('Data updated successfully !', 'success');
        return redirect()->route('boardinghouseroom.index', $request->boardinghouse_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BoardingRoom  $boardingRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $boardinghouse_id)
    {
        $boardingroom = BoardingRoom::findOrFail($id);

        $boardingroom->delete();
        Alert::toast('Data delete successfully !', 'success');
        return redirect()->route('boardinghouseroom.index', $boardinghouse_id);
    }
}
