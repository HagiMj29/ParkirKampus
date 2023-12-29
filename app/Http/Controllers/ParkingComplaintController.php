<?php

namespace App\Http\Controllers;

use App\Models\ParkingAttendance;
use App\Models\User;
use App\Models\ParkingSlot;
use Illuminate\Http\Request;
use App\Models\ParkingComplaint;

class ParkingComplaintController extends Controller
{
    public function index(Request $request)
    {
        $title = "Parking Complaints";
        $query = $request->input('search');
    
        $varparkingComplaint = ParkingComplaint::with('user')
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->whereHas('user', function ($q) use ($query) {
                    $q->where('name', 'LIKE', '%' . $query . '%');
                });
            })
            ->latest()
            ->get();
    
        return view('parkingcomplaints.index', ['listcomplaints' => $varparkingComplaint, 'listtitle' => $title]);
    }

    public function store(Request $request)
{
    $varparkingComplaint = $request->validate([
        'user_id' => 'required',
        'slot_id' => 'required',
        'description' => 'required',
        'reply' => 'required',
        'status' => 'required',
    ]);

    ParkingComplaint::create($varparkingComplaint);

    return redirect('/parkingcomplaints/index');
    }

    public function create(ParkingComplaint $varparkingComplaint)
    {
        $title = "Parking Complaints";
        $users = User::all();
        $slots = ParkingSlot::all();
        $attendances = ParkingAttendance::all();
        return view('parkingcomplaints.create',['listcomplaints'=>$varparkingComplaint,'listtitle' => $title, 'users' => $users,
        'slots' => $slots, 'attendances'=>$attendances]);
    }

    public function edit(ParkingComplaint $parkingcomplaint)
    {
        $title = "Edit Parking Complaints";
        $users = User::all();
        $slots = ParkingSlot::all();
        $attendances = ParkingAttendance::all();
        return view('parkingcomplaints.edit',['parkingcomplaint'=>$parkingcomplaint,'listtitle' => $title, 'users' => $users,
        'slots' => $slots, 'attendances'=>$attendances]);
    }

    public function update(Request $request, ParkingComplaint $parkingcomplaint)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'slot_id' => 'required',
            'description' => 'required',
            'reply' => 'required',
            'status' => 'required',
        ]);

        // $parkingactivitie->update($validatedData);
        // ParkingActivitie->where('id', $id)->update($validated);

        $parkingcomplaint->update([
            'user_id' => $request->user_id,
            'slot_id' => $request->slot_id,
            'description' =>$request->description,
            'reply' =>$request->reply,
            'status'=>$request->status,
        ]);

        return redirect('/parkingcomplaints/index');
    }

    public function destroy(ParkingComplaint $parkingcomplaint)
    {
        
        $parkingcomplaint->delete();

        return redirect('/parkingcomplaints/index');
    }
}
