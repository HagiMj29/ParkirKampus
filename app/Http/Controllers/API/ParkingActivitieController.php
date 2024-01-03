<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\ParkingSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ParkingActivitie;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ParkingActivitieController extends Controller
{
    public function index()
    {
        $varparkingActivity = ParkingActivitie::latest()->get();

        $results = [];
        foreach($varparkingActivity as $varactivity){
            $result = [
                'id'=>$varactivity->id,
                'user_id'=>$varactivity->user_id,
                'slot_id'=>$varactivity->slot_id,
                'vehicle_number'=>$varactivity->vehicle_number,
                'vehicle_brand'=>$varactivity->vehicle_brand,
                'in_datetime'=>$varactivity->in_datetime,
                'out_datetime'=>$varactivity->out_datetime,
                'status'=>$varactivity->status,
            ];

            $results[] = $result;

        }
        $response = [
        
            "results" => $results,
        ];

        return response()->json($response);
   
    }
  
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'slot_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    $slot = ParkingSlot::find($value);
                    if (!$slot) {
                        $fail("The selected slot is invalid.");
                    } elseif ($slot->status === 'Berisi') {
                        $fail("The selected slot is already occupied.");
                    }
                },
            ],
            'vehicle_number' => 'required',
            'vehicle_brand' => 'required',
            'in_datetime' => 'required',
            'out_datetime' => 'nullable',
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
        ], [
            'user_id.required' => 'The user_id field is required.',
            'slot_id.required' => 'The slot_id field is required.',
            'slot_id.*' => 'Custom error message for slot_id validation.',
            'in_datetime.date_format' => 'The in_datetime field must be in the format dd/mm/yyyy HH.mm.',
        ]);
    
        $slot = ParkingSlot::find($request->slot_id);
        if ($slot) {
            $slot->status = 'Berisi';
            $slot->save();
        }
    
        $validatedData['status'] = 'Masuk';
    
    
        $activity = ParkingActivitie::create($validatedData);
    
        return response()->json(['message' => 'Parking activity created successfully', 'activity' => $activity], 201);
    }
    
    public function create(ParkingActivitie $varparkingActivity)
    {
        $title = "Parking Activities";
        $users = User::all();
        $slots = ParkingSlot::all();
        return view('parkingactivities.create',['listactivities'=>$varparkingActivity,'listtitle' => $title, 'users' => $users,
        'slots' => $slots,]);
    }


    public function edit(ParkingActivitie $parkingactivity)
    {
        $title = "Edit Parking Activity";
        $users = User::all();
        $slots = ParkingSlot::all();
        return view('parkingactivities.edit', ['parkingactivity'=>$parkingactivity,'listtitle' => $title, 'users' => $users,
        'slots' => $slots,]);
    }

    public function update(Request $request, ParkingActivitie $parkingactivity)
    {
        
        $parkingactivity->update($request->all());
    
        if ($request->has('out_datetime')) {
            $parkingactivity->status = 'Keluar';
            $parkingactivity->out_datetime = $request->out_datetime;
            $parkingactivity->save();
    
            // Update status slot kembali menjadi "Kosong"
            $slot = ParkingSlot::find($request->slot_id);
            if ($slot) {
                $slot->status = 'Kosong';
                $slot->save();
            }
        }
    
        return response()->json(['message' => 'Parking activity updated successfully', 'parkingactivity' => $parkingactivity], 200);
    }

    public function destroy(ParkingActivitie $parkingactivity)
    {
        
        $parkingactivity->delete();

        return redirect('/parkingactivities/index');
    }

    // public function getTotalActivities()
    // {
    //     $title = "Dashboard";
    //     $totalActivities = ParkingActivitie::where('status', 'Masuk')->count();
    //     return view('/dashboard', ['totalActivities' => $totalActivities,'listtitle'=>$title]);
    // }
    
}
