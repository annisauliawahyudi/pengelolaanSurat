<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\letter_type;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = $request->only(['email', 'password']);
        if (Auth::attempt($user)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('failed', 'Proses login gagal, silahkan coba kembali dengan data yang benar!');
        }
    }

    public function logout()
    {
        
        Auth::logout();
        return redirect()->route('login-auth')->with('logout', 'Anda telah logout!');
       
    }
    
    // Staff
  public function index(Request $request)
    {
        $search = $request->input('search');
        $staffs = User::where('role', 'staff')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->simplePaginate(2);
        return view('staff.index', compact('staffs'));
    }


    public function create()
    {
        return view('staff.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:3',
        ]);

      
        $email = substr($request->email, 0, 3);
        $name = substr($request->name, 0, 3);
        $hashedPassword = Hash::make($name . $email);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
            'role' => 'staff',
        ]);

        return redirect()->route('staff.index')->with('success', 'Berhasil menambahkan data pengguna!');

       
    }
    
    // public function edit( string $id)
    // {
       
    // }

    public function edit($id)
    {
        $staff = User::find($id);
        return view('staff.edit', compact('staff'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'name' => 'required|min:3',
        'email' => 'required',
        'password' => 'nullable|min:6', // Tambahkan aturan validasi untuk password baru jika dibutuhkan
    ]);

    $staffData = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    // Update password hanya jika ada password baru yang dimasukkan
    if ($request->filled('password')) {
        $staffData['password'] = Hash::make($request->password);
    }

    User::where('id', $id)->update($staffData);

    return redirect()->route('staff.index')->with('success', 'Berhasil mengubah data!');
}

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    // Guru
    public function indexGuru(Request $request)
    {
        $search = $request->input('search');
        $guru = User::where('role', 'guru')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->simplePaginate(2);
        return view('guru.index', compact('guru'));
    }
    public function createGuru()
    {
        return view('guru.create');
    }
    public function storeGuru(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:3',
        ]);

        try {
        $email = substr($request->email, 0, 3);
        $name = substr($request->name, 0, 3);
        $hashedPassword = Hash::make($name . $email);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
            'role' => 'guru',
        ]);

        return redirect()->route('guru.index')->with('success', 'Berhasil menambahkan data pengguna!');

        } catch (QueryException $e) {
        $errorCode = $e->errorInfo[1];

        if ($errorCode == 1062) {
            // Error code 1062 adalah MySQL untuk "duplicate entry"
            return redirect()->back()->with('error', 'Email sudah terdaftar. Silakan gunakan email lain.');
        }

        // Jika error bukan duplikasi, Anda dapat menangani sesuai kebutuhan aplikasi Anda
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data pengguna.');
    }
    }
    // public function edit( string $id)
    // {
       
    // }

    public function editGuru($id)
    {
        $guru = User::find($id);
        return view('guru.edit', compact('guru'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function updateGuru(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'password' => 'nullable|min:6', // Tambahkan aturan validasi untuk password baru jika dibutuhkan
    ]);

    $guruData = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    // Update password hanya jika ada password baru yang dimasukkan
    if ($request->filled('password')) {
        $guruData['password'] = Hash::make($request->password);
    }

    User::where('id', $id)->update($guruData);

    return redirect()->route('guru.index')->with('success', 'Berhasil mengubah data guru!');
    }

    public function destroyGuru($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function dashboard()
    {
        $tampilan = User::Where('role', 'guru')->count();
        $data = User::where('role', 'staff')->count();
        $dataLetter = letter_type::count();
        return view('dashboard', compact('tampilan', 'data', 'dataLetter'));
    }
}