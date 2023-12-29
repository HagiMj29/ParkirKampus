<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        $results= [];

        foreach($users as $datauser){
            $result =[
                'id'=>$datauser->id,
                'name'=>$datauser->name,
                'email'=>$datauser->email,
                'password'=>$datauser->password,
                'phone'=>$datauser->phone,
                'role'=>$datauser->role,
                'photo'=>$datauser->photo_url,
            ];

            $results[] = $result;

        }

        $response = [
        
            "results" => $results,
        ];

        return response()->json($response,200);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required',
            'role' => 'required',
            'photo' => 'required'
        ]);

        $photo = $request->file('photo')->getClientOriginalName();
        $photoPath = $request->file('photo')->storeAs('public/image', $photo);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'],
            'role' => $validatedData['role'],
            'photo' => $photo,
        ]);
        

        return response()->json($user, Response::HTTP_CREATED);
    }
    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
{
    // Validate form data
    try {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            // 'photo' => 'required',
        ]);
    
        if ($request->hasFile('photo')) {
            $photoExtension = $request->file('photo')->getClientOriginalExtension();
            $photoHash = md5(time() . $request->file('photo')->getClientOriginalName()) . '.' . $photoExtension;
            $photoPath = $request->file('photo')->storeAs('public/image', $photoHash);
    
            // Update user data
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'role' => $request->role,
                'photo' => $photoHash,
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
            ]);
        }    
        $response = [
            'status' => 'success',
        ];
        return response()->json($response, 200);
    } catch (\Throwable $th) {
        $response = [
            'status' => 'failed',
            'data' => $th->getMessage()
        ];
        return response()->json($response, 200);
    }
    
}


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $user = ['id'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email,
            'password'=>$user->password,
            'phone'=>$user->phone,
            'role'=>$user->role,
            'photo'=>$user->photo_url,];
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                ], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            // 'phone' => 'required',
            // 'role' => 'required',
            // 'photo' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'phone' => $request->phone,
            // 'role' => $request->role,
            // 'photo' => $photo,
        ]);

        $user->role = 'Pengunjung';
        $user->save();

        return response()->json(['message' => 'User registered successfully'], 201);
    }
    


    
}
