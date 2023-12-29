<?php

namespace App\Http\Controllers;

use App\Models\User;

use Barryvdh\DomPDF\PDF;
use App\Models\ParkingSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ParkingActivitie;
use App\Http\Controllers\Controller;
use App\Models\UserVehicle;

class ParkingActivitieController extends Controller
{
    public function index(Request $request)
    {
        $title = "Parking Activities";
        $query = $request->input('search');
    
        $varparkingActivity = ParkingActivitie::with('user')
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->whereHas('user', function ($q) use ($query) {
                    $q->where('name', 'LIKE', '%' . $query . '%');
                });
            })
            ->whereDate('in_datetime', Carbon::today()) 
            ->latest()
            ->get();

            $varparkingActivity1 = ParkingActivitie::with('user')
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->whereHas('user', function ($q) use ($query) {
                    $q->where('name', 'LIKE', '%' . $query . '%');
                })
                ->orWhere('vehicle_number', 'LIKE', '%' . $query . '%');
            })
        
            ->latest()
            ->get();
    
        return view('parkingactivities.index', ['listactivities' => $varparkingActivity, 'listtitle' => $title,'varparkingActivity1'=>$varparkingActivity1]);
    }

    public function index1(Request $request){
        $title = "Parking Activities";
        $query = $request->input('search');

        $varparkingActivity1 = ParkingActivitie::with('user')
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->whereHas('user', function ($q) use ($query) {
                    $q->where('name', 'LIKE', '%' . $query . '%');
                })
                ->orWhere('vehicle_number', 'LIKE', '%' . $query . '%');
            })
        
            ->latest()
            ->get();
            return view('parkingactivities.index1', ['listtitle' => $title,'varparkingActivity1'=>$varparkingActivity1]);
    }


    public function cetak_pdf()
    {
        $varparkingActivity = ParkingActivitie::all();
        $title = "Parking Activities";
        
   
        $pdf = app()->make('dompdf.wrapper');
        

        $pdf->loadView('parkingactivities.pdf_parkingactivitie', ['varparkingActivity' => $varparkingActivity,'listtitle'=>$title]);
        

        return $pdf->stream('parkingactivitie.pdf');
    }
    


    public function store(Request $request)
{
    $varparkingActivity = $request->validate([
        'user_id' => 'required',
        'slot_id' => ['required',
        function ($attribute, $value, $fail) {
            $slot = ParkingSlot::find($value);
            if (!$slot) {
                $fail("The selected slot is invalid.");
            } elseif ($slot->status === 'Berisi') {
                $fail("The selected slot is already occupied.");
            }
        },],
        'vehicle_number' => 'required',
        'vehicle_brand' => 'required',
        'in_datetime' => 'required',
        'status' => [
            'required',
            function ($attribute, $value, $fail) use ($request) {
                if ($value === 'Masuk') {
                    $existingEntry = ParkingActivitie::where('user_id', $request->user_id)
                        ->where('status', 'Masuk')
                        ->first();
    
                    if ($existingEntry) {
                        $fail("You can't create a new entry while you're already inside.");
                    }
                } elseif ($value === 'Keluar') {
                    $lastEntry = ParkingActivitie::where('user_id', $request->user_id)
                        ->orderByDesc('created_at')
                        ->first();
    
                    if (!$lastEntry || $lastEntry->status === 'Keluar') {
                        $fail("You can't create an exit entry without a corresponding entry.");
                    }
                }
            },
        ],
    ]);

    $slot = ParkingSlot::find($request->slot_id);
    if ($slot) {
        $slot->status = 'Berisi';
        $slot->save();
    }
        
    $varparkingActivity['status'] = 'Masuk';
    ParkingActivitie::create($varparkingActivity);
   
    return redirect('/parkingactivities/index'); 
}

 
    public function create(ParkingActivitie $varparkingActivity)
    {
        $title = "Parking Activities";
        $users = User::all();
        $slots = ParkingSlot::all();
        $vehicle = UserVehicle::all();
        return view('parkingactivities.create',['listactivities'=>$varparkingActivity,'listtitle' => $title, 'users' => $users,
        'slots' => $slots,'vehicles'=>$vehicle,]);
    }


    public function edit(ParkingActivitie $parkingactivity)
    {
        $title = "Edit Parking Activity";
        $users = User::all();
        $slots = ParkingSlot::all();
        $vehicles = UserVehicle::all();
        return view('parkingactivities.edit', ['parkingactivity'=>$parkingactivity,'listtitle' => $title, 'users' => $users,
        'slots' => $slots,'vehicles'=>$vehicles,]);
    }

    public function update(Request $request, ParkingActivitie $parkingactivity)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'slot_id' => 'required',
            'vehicle_number' => 'required',
            'vehicle_brand' => 'required',
            'in_datetime' => 'required',
            'out_datetime' => 'nullable',
            'status' => 'required'
        ]);
        
        $parkingactivity->update([
            'user_id' => $request->user_id,
            'slot_id' => $request->slot_id,
            'vehicle_number' =>$request->vehicle_number,
            'vehicle_brand' =>$request->vehicle_brand,
            'in_datetime' =>$request->in_datetime,
            'out_datetime'=>$request->out_datetime,
            'status'=>$request->status
        ]);

        if ($request->has('out_datetime')) {
        $parkingactivity->status = 'Keluar';
        $parkingactivity->out_datetime = $request->out_datetime;
        $parkingactivity->save();

    
        $slot = ParkingSlot::find($request->slot_id);
        if ($slot) {
            $slot->status = 'Kosong';
            $slot->save();
        }
    }

        return redirect('/parkingactivities/index');
    }

    public function destroy(ParkingActivitie $parkingactivity)
    {
        
        $parkingactivity->delete();

        return redirect('/parkingactivities/index');
    }


    
}
