<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('Admin.AddUser.AddUser', [
            'title' => 'Add User',
            'users' => $users
        ]);
    }

    function getUsers() {
        $users = User::all();
        return view('Dashboard.dashboard', compact('users'));
    }

    public function edit($nrp)
    {
        $user = User::find($nrp);
        return view('Admin.AddUser.EditUser')->with([
            'title' => 'Edit User',
            'user' => $user
        ]);
    }

    public function update(Request $request, $nrp)
    {

        $user = User::find($nrp);

        $validated = $request->validate([
            'nrp' => 'required|unique:users,nrp,'  . $user->nrp . ',nrp',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->nrp . ',nrp',
            'password' => 'nullable|string|min:8|max:255',
            'role' => 'required|string|max:255',
        ]);

        $validated['name'] = $validated['nama'];
        unset($validated['nama']);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']); // Remove password from validated data if it's empty
        }

        $user->update($validated);

        return redirect()->route('AddUser.index')->with('success', 'User edited successfully');
        // return response()->json(['success' => $validated]);
    }



    public function destroy($nrp)
    {
        $user = User::findOrFail($nrp);
        $user->delete();
        return redirect()->route('AddUser.index')->with('success', 'User deleted successfully');
    }
    
    function login()
    {
        if (Auth::check()) {
            return redirect(route('dashboardadmin'));
        }
        return view('login.login', ['title' => 'Login']);
    }


    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('dashboardadmin'))->with("success", "LOGIN BERHASIL");
        }
        return redirect()->route('login')->with("error", "Login details are not valid");
    }

    function store(Request $request)
    {
        $request->validate([
            'nrp' => 'required|max:50',
            'name' => 'required|max:30',
            'email' => 'required|email|max:30|unique:users',
            'password' => 'required|max:100',
            'role' => 'required|string|max:10',
        ]);
        $data['nrp'] = $request->nrp;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['role'] = $request->role;

        $user = User::create($data);

        // if ($data['role'] == 'Mahasiswa') {
        //     Mahasiswa::create([
        //         'nrp' => $data['nrp'],
        //         'nama' => $data['name']
        //     ]);
        // }

        if (!$user) {
            return redirect()->route('AddUser.index')->with("error", "Registration failed, try again.");
        }
        return redirect()->route('AddUser.index')->with("success", "Register success");
    }

    function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }

    function hapus(user $user) {
        try {
            $user->delete();
            return redirect()->route('register');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data'], 500);
        }
    }
}