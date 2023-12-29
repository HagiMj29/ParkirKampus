<?php

namespace App\Http\Controllers;

use App\Models\ParkingActivitie;
use App\Models\ParkingComplaint;
use App\Models\ParkingSlot;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getTotal()
    {
        $title = "Dashboard";
        $totalVisitorUsers = User::where('role', 'Pengunjung')->count();
        $totalVisitorActivities = ParkingActivitie::where('status', 'Masuk')->count();
        $totalParkingSlot = ParkingSlot::where('status', 'Berisi')->count();
        $totalVisitorComplaints = ParkingComplaint::where('status', 'Diproses')->get();
        $totalVisitorComplaints2 = ParkingComplaint::where('status', 'Diproses')->count();
    
        return view('dashboard', [
            'totalVisitorUsers' => $totalVisitorUsers,
            'totalVisitorActivities' => $totalVisitorActivities,
            'totalParkingSlot' => $totalParkingSlot,
            'totalVisitorComplaints' => $totalVisitorComplaints,
            'totalVisitorComplaints2'=>$totalVisitorComplaints2,
            'listtitle' => $title,
        ]);
    }
}
    
