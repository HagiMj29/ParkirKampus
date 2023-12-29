<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVehicle;
use Illuminate\Http\Request;

class UserVehicleController extends Controller
{
    public function index(Request $request)
    {
        $title = "Kendaraan yang terdaftar";
        $query = $request->input('search');
        $queryBuilder = UserVehicle::query();

        if ($query) {
            $queryBuilder->where('vehicle_number', 'like', '%' . $query . '%')
                ->orWhere('vehicle_brand', 'like', '%' . $query . '%');
        }

        $varvehicle = $queryBuilder->latest('created_at')->get();

        return view('vehicles.index', ['listvehicle' => $varvehicle, 'listtitle' => $title]);
    }


    public function store(Request $request)
    {
        $varvehicle = $request->validate([
            'user_id'=>'required',
            'vehicle_number' => 'required',
            'vehicle_brand' => 'required',
        ]);

        UserVehicle::create($varvehicle);

        return redirect('/vehicles/index'); 
    }

    public function create(UserVehicle $varvehicle)
    {
        $users = User::all();
        $title = "Tambah Data Kendaraan";
        return view('vehicles.create',['listvehicle'=>$varvehicle,'listtitle' => $title,'users'=>$users]);
    }

   


}
