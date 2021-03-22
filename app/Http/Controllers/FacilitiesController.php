<?php

namespace App\Http\Controllers;

use App\Facilities;
use App\BoardingHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class FacilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $house = BoardingHouse::findOrFail($id);
        $title = 'List of Facilities ' . $house->name;
        $facilities = Facilities::where('boarding_house_id', $id)->get();
        return view('pages.facilities.index')->with([
            'title' => $title,
            'facilities' => $facilities,
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
        $title = 'Add new Facilities ' . $house->name;
        return view('pages.facilities.form')->with([
            'type' => 'add',
            'url' => route('facilities.store'),
            'title' => $title,
            'facility_name' => old('facility_name'),
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
            'facility_name' => 'required|max:255',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $facilities = new Facilities;

        $facilities->facility_name = $request->facility_name;
        $facilities->boarding_house_id = $request->boardinghouse_id;

        $facilities->save();

        Alert::toast('Data saved successfully !', 'success');
        return redirect()->route('facilities.index', $request->boardinghouse_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Facilities  $facilities
     * @return \Illuminate\Http\Response
     */
    public function show(Facilities $facilities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Facilities  $facilities
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $boardinghouse_id)
    {
        $facilities = Facilities::findOrFail($id);
        $title = 'Edit Facility';
        return view('pages.facilities.form')->with([
            'type' => 'edit',
            'url' => route('facilities.update', $facilities->id),
            'title' => $title,
            'boardinghouse_id' => $boardinghouse_id,
            'facility_name' => old('facility_name', $facilities->facility_name),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Facilities  $facilities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'facility_name' => 'required|max:255',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $facilities = Facilities::find($id);

        $facilities->boarding_house_id = $request->boardinghouse_id;
        $facilities->facility_name = $request->facility_name;
        $facilities->save();

        Alert::toast('Data updated successfully !', 'success');
        return redirect()->route('facilities.index', $request->boardinghouse_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facilities  $facilities
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $boardinghouse_id)
    {
        $facilities = Facilities::findOrFail($id);

        $facilities->delete();
        Alert::toast('Data delete successfully !', 'success');
        return redirect()->route('facilities.index', $boardinghouse_id);
    }
}
