<?php

namespace App\Http\Controllers\API;
use App\Models\ParkingSlot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Symfony\Component\HttpFoundation\Response;

class ParkingSlotController extends Controller
{
    public function index()
    {
        $varparkingslot = ParkingSlot::all();

    $results = [];
    foreach ($varparkingslot as $slot) {
        $result = [
            "id" => $slot->id,
            "slot" => $slot->slot,
            "status" => $slot->status,
            // Tambahkan atribut lain yang diperlukan di sini
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
        $validated = $request->validate([
            'slot' => 'required',
            'status' => 'required',
        ]);

        $parkingslot = ParkingSlot::create($validated);

        return response()->json($parkingslot, Response::HTTP_CREATED);
    }

    public function apiShow($id)
    {
        $parkingSlot = ParkingSlot::find($id);

        if (!$parkingSlot) {
            return response()->json(['message' => 'Parking slot not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($parkingSlot);
    }

    public function update(Request $request, ParkingSlot $parkingslot)
    {
        $validated = $request->validate([
            'slot' => 'required',
            'status' => 'required',
        ]);

        $parkingslot->update($validated);

        return response()->json($parkingslot, Response::HTTP_OK);
    }

    public function destroy(ParkingSlot $parkingslot)
    {
        $parkingslot->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    
}
