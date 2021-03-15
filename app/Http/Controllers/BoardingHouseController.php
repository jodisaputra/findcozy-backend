<?php

namespace App\Http\Controllers;

use App\BoardingHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BoardingHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Boarding House';
        $boardinghouses = BoardingHouse::where('user_id', Auth::user()->id)->get();
        return view('pages.boarding_house.index')->with([
            'title' => $title,
            'boardinghouses' => $boardinghouses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add New Boarding House';
        return view('pages.boarding_house.form')->with([
            'type' => 'add',
            'url' => route('boardinghouse.store'),
            'title' => $title,
            'name' => old('name'),
            'address' => old('address'),
            'city' => old('city'),
            'map_url' => old('map_url'),
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
            'address' => 'required',
            'map_url' => 'max:255',
            'license' => 'required|mimes:pdf',
            'city' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $boardinghouse = new BoardingHouse;

        $boardinghouse->name = $request->name;
        $boardinghouse->address = $request->address;
        $boardinghouse->map_url = $request->map_url;
        $boardinghouse->city = $request->city;
        $boardinghouse->user_id = Auth::user()->id;

        if($request->file('license'))
        {
            $file = $request->file('license')->store('license', 'public');
            $boardinghouse->license = $file;
        }

        $boardinghouse->save();

        Alert::toast('Data saved successfully !', 'success');
        return redirect()->route('boardinghouse.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BoardingHouse  $boardingHouse
     * @return \Illuminate\Http\Response
     */
    public function show(BoardingHouse $boardingHouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BoardingHouse  $boardingHouse
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $boardinghouse = BoardingHouse::findOrFail($id);
        $title = 'Edit Boarding House';
        return view('pages.boarding_house.form')->with([
            'type' => 'edit',
            'url' => route('boardinghouse.update', $boardinghouse->id),
            'title' => $title,
            'boardinghouse' => $boardinghouse,
            'name' => old('name', $boardinghouse->name),
            'address' => old('address', $boardinghouse->address),
            'city' => old('city', $boardinghouse->city),
            'map_url' => old('map_url', $boardinghouse->map_url),
            'license' => $boardinghouse->license
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BoardingHouse  $boardingHouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'address' => 'required',
            'map_url' => 'max:255',
            'license' => 'mimes:pdf',
            'city' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $boardinghouse = BoardingHouse::find($id);

        $boardinghouse->name = $request->name;
        $boardinghouse->address = $request->address;
        $boardinghouse->map_url = $request->map_url;
        $boardinghouse->city = $request->city;

        if($request->file('license'))
        {
            Storage::delete('public/' . $boardinghouse->license);
            $file = $request->file('license')->store('license', 'public');
            $boardinghouse->license = $file;
        }

        $boardinghouse->save();

        Alert::toast('Data update successfully !', 'success');
        return redirect()->route('boardinghouse.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BoardingHouse  $boardingHouse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $boardinghouse = BoardingHouse::findOrFail($id);
        Storage::delete('public/' . $boardinghouse->license);

        $boardinghouse->delete();

        Alert::toast('Data delete successfully !', 'success');
        return redirect()->route('boardinghouse.index');

    }
}
