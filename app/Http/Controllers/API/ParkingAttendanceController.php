<?php

namespace App\Http\Controllers\API;
use App\Models\ParkingAttendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ParkingAttendanceController extends Controller
{
    public function index()
    {
        $varparkinAttendances = ParkingAttendance::all();

        $results = [];
        foreach ($varparkinAttendances as $attendance) {
            $result = [
                "id" => $attendance->id,
                "name" => $attendance->name,
                "photo" => $attendance->photo_url,
                // Tambahkan atribut lain yang diperlukan di sini
            ];
    
            $results[] = $result;
        }
    
        $response = [
        
            "results" => $results,
        ];
    
        return response()->json($response);
        }


    

}
