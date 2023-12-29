<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkingAttendance;
use Illuminate\Support\Facades\Storage;

class ParkingAttendanceController extends Controller
{
    public function index(Request $request)
    {
        
        $varparkingattendances = ParkingAttendance::all();
        $title = "Parking Attendances";
        return view('parkingattendances.index', ['listattendances' => $varparkingattendances, 'listtitle' => $title]);
    }

    public function store(Request $request)
{   
    $varparkingattendances = $request->validate([
        'name' => 'required',
        'photo' => 'required'
    ]);
    $photo = $request->file('photo')->getClientOriginalName();
    $photoPath = $request->file('photo')->storeAs('public/image', $photo);

    ParkingAttendance::create([
        'name' => $varparkingattendances['name'],
        'photo' => $photo,
    ]);

    return redirect('parkingattendances/index');
}

    public function create(ParkingAttendance $varparkingattendances)
    {
        $title = "Parking Attendances";
        return view('parkingattendances.create',['listattendances'=>$varparkingattendances,'listtitle' => $title]);
    }

    public function edit(ParkingAttendance $parkingattendance)
    {
        $title = "Parking Attendances";
        return view('parkingattendances.edit',['listtitle' => $title, 'parkingattendance' => $parkingattendance]);
    }



    public function update(Request $request, ParkingAttendance $parkingattendance)
{
    $this->validate($request, [
        'name' => 'required',
        'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    
    $parkingattendance->update([
        'name' => $request->name,
    ]);

    if ($request->hasFile('photo')) {
    
        Storage::delete('public/image/' . $parkingattendance->photo);

        $photo = $request->file('photo')->getClientOriginalName();
        $photoPath = $request->file('photo')->storeAs('public/image', $photo);

        $parkingattendance->update([
            'photo' => $photo,
        ]);
    }

    return redirect('/parkingattendances/index');
}

    public function destroy(ParkingAttendance $parkingattendance)
{
    $parkingattendance->delete();

    return redirect('parkingattendances/index')->with('success', 'Parking attendance has been deleted.');
}


}
