<?php

namespace App\Http\Controllers;

use App\BoardingHouseImage;
use App\BoardingHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class BoardingHouseImageController extends Controller
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
        $boardinghouseimage = BoardingHouseImage::where('boarding_house_id', $id)->get();
        return view('pages.boarding_house_image.index')->with([
            'title' => $title,
            'boardinghouseimages' => $boardinghouseimage,
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
        $title = 'Add new image ' . $house->name;
        return view('pages.boarding_house_image.form')->with([
            'type' => 'add',
            'url' => route('boardinghouseimage.store'),
            'title' => $title,
            'boardinghouse_id' => $id
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
            'image' => 'required|image|mimes:jpg,jpeg',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $boardinghouseimage = new BoardingHouseImage;
        $boardinghouseimage->boarding_house_id = $request->boardinghouse_id;

        if($request->file('image'))
        {
            $file = $request->file('image')->store('house_image', 'public');
            $boardinghouseimage->image = $file;
        }

        $boardinghouseimage->save();

        Alert::toast('Data saved successfully !', 'success');
        return redirect()->route('boardinghouseimage.index', $request->boardinghouse_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BoardingHouseImage  $boardingHouseImage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BoardingHouseImage  $boardingHouseImage
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $boardinghouse_id)
    {
        $boardinghouseimage = BoardingHouseImage::findOrFail($id);
        $title = 'Edit Boarding House';
        return view('pages.boarding_house_image.form')->with([
            'type' => 'edit',
            'url' => route('boardinghouseimage.update', $boardinghouseimage->id),
            'title' => $title,
            'image' => $boardinghouseimage->image,
            'boardinghouse_id' => $boardinghouse_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BoardingHouseImage  $boardingHouseImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'image' => 'required|image|mimes:jpg,jpeg',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $boardinghouseimage = BoardingHouseImage::find($id);

        if($request->file('image'))
        {
            Storage::delete('public/' . $boardinghouseimage->image);
            $file = $request->file('image')->store('house_image', 'public');
            $boardinghouseimage->image = $file;
        }

        $boardinghouseimage->save();

        Alert::toast('Data update successfully !', 'success');
        return redirect()->route('boardinghouseimage.index', $request->boardinghouse_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BoardingHouseImage  $boardingHouseImage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$boardinghouse_id)
    {
        $boardinghouseimage = BoardingHouseImage::findOrFail($id);
        Storage::delete('public/' . $boardinghouseimage->image);

        $boardinghouseimage->delete();

        Alert::toast('Data delete successfully !', 'success');
        return redirect()->route('boardinghouseimage.index', $boardinghouse_id);
    }
}
