<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $title = "Users";
        $query = $request->input('search');
    
        $queryBuilder = User::query();
        
        if ($query) {
            $queryBuilder->where('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('phone', 'like', '%' . $query . '%');
        }
        $varusers = $queryBuilder->latest('created_at')->get();
    
        return view('users.index', ['listuser' => $varusers, 'listtitle' => $title]);
    }

    public function show(User $user)
    {
        $title = "Users";
        
        // Mengambil kendaraan yang hanya dimiliki oleh pengguna yang sedang dilihat
        $listvehicle = UserVehicle::where('user_id', $user->id)->get();
        
        return view('users.detail', ['listtitle' => $title, 'listvehicle' => $listvehicle, 'user' => $user]);
    }
    
    
    public function store(Request $request)
    {
        $validate =  $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone'=>'required',
            'role'=>'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ]);
    
        $photo = $request->file('photo');
        $photo->storeAs('public/image', $photo->hashName());
        
        $validate['password'] = bcrypt($request->password);
        $validate['photo'] = $photo->hashName();

        User::create($validate);
    
        return redirect('users/index');
    }

    public function create(User $user)
    {
        $title = "Users";
        return view('users.create', ['listtitle' => $title, 'user' => $user]);
    }

    public function edit(User $user)
    {
        $title = "Edit User";
        return view('users.edit', ['listtitle' => $title, 'user' => $user]);
    }

    public function update(Request $request, User $user)
{
    // Validate form data
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'phone' => 'required',
        'role' => 'required',
        'photo' => 'required|image',
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
            'role' => $request->role,
        ]);
    }

    // Redirect to index with success message
    return redirect('users/index');
}



    public function destroy(User $user)
    {
        $user->delete();

        return redirect('users/index');
    }



    public function register()
    {
        $title = "Register";
        return view('register', ['listtitle' => $title]);
    }

   public function register_action(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'captcha' => 'required|captcha',
    ]);

    // Proses registrasi jika CAPTCHA valid

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    $user->role = 'Pengunjung';
    $user->save();

    return redirect('/dashboard');
}

    public function login()
    {
        $title = "Login";
        return view('login', ['listtitle' => $title]);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            if(Auth::user()->role === 'Admin'){
            return redirect('/dashboard');
            }else{
                Auth::logout();
                return redirect()->route('login')->withErrors('Anda tidak memiliki izin untuk akses halaman ini');
            }
        } else {
            return redirect()->route('login')->withErrors('Username dan password tidak valid');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
    
}
