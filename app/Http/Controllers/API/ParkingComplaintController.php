<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParkingComplaint;

use Symfony\Component\HttpFoundation\Response;

class ParkingComplaintController extends Controller
{

    public function index()
    {
        $varparkingComplaint = ParkingComplaint::all();

        $results = [];
        foreach($varparkingComplaint as $complaints){
            $result = [
                'user_id'=>$complaints->user_id,
                'slot_id'=>$complaints->slot_id,
                'description'=>$complaints->description,
                'reply'=>$complaints->reply,
                'status'=>$complaints->status,
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
            'slot_id' => 'required',
            'description' => 'required',
            // 'reply' => 'required',
            'status' => 'required',
        ]);

        $parkingComplaint = ParkingComplaint::create($validatedData);

        return response()->json([
            'message' => 'Parking complaint created successfully',
            'parkingComplaint' => $parkingComplaint,
        ], 201);
    }
}