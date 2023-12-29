<?php

namespace App\Http\Controllers;

use App\Models\ParkingSlot;
use Illuminate\Http\Request;

class ParkingSlotController extends Controller
{
    public function index()
    {
        $varparkingslot = ParkingSlot::all();
        $title = "Parking Slots";
        return view('parkingslots.index', ['listslot' => $varparkingslot, 'listtitle' => $title]);
        
    }

    public function store(Request $request)
    {
        $varparkingslot = $request->validate([
            'slot' => 'required',
            'status' => 'required',
        ]);

        ParkingSlot::create($varparkingslot);

        return redirect('/parkingslots/index'); 
    }
    public function create(ParkingSlot $varparkingslot)
    {
        $title = "Parking Slots";
        return view('parkingslots.create',['listslot'=>$varparkingslot,'listtitle' => $title]);
    }

    public function edit(ParkingSlot $parkingslot)
    {
        $title = "Parking Slots";
        return view('parkingslots.edit',['listtitle' => $title, 'parkingslot' => $parkingslot]);
    }

    public function update(Request $request, ParkingSlot $parkingslot)
    {
        //validate form
        $this->validate($request, [
            'slot' => 'required',
            'status' => 'required'
        ]);

            //update post without image
            $parkingslot->update([
                'slot' => $request->slot,
                'status' => $request->status
            ]);


        //redirect to index
        return redirect('parkingslots/index');
    }

    public function destroy(ParkingSlot $parkingslot)
    {
        $parkingslot->delete();

        return redirect('parkingslots/index');
    }
}
