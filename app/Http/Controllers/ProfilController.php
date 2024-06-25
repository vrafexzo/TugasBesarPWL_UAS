<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AddProdi;
use PhpParser\Node\Stmt\Return_;

class ProfilController extends Controller
{
    public function index()
    {   
        $mahasiswa = Mahasiswa::find(auth()->user()->nrp);

        $users = User::all();
        $prodis = AddProdi::all();
        return view('Dashboard.profil', [
            'title' => 'Profil',
            'mahasiswa' => $mahasiswa,
            'users' => $users,
            'prodis' => $prodis
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nrp' => 'required|string|max:50',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'date',
            'telepon' => 'string|max:255',
            'agama' => 'string|max:255',
            'id_prodi' => 'string|max:255',
            'ipk' => 'string'
        ]);

        $data['nrp'] = $request->nrp;
        $data['nama'] = $request->nama;
        $data['tanggal_lahir'] = $request->tanggal_lahir;
        $data['telepon'] = $request->telepon;
        $data['agama'] = $request->agama;
        $data['id_prodi'] = $request->id_prodi;
        $data['IPK'] = (double) ($request->ipk);

        $mahasiswa = Mahasiswa::where('nrp', $request->nrp)->first();

        if ($mahasiswa) {
            // Update existing record
            $mahasiswa->update($data);
        } else {
            // Create new record
            $data['nrp'] = $request->nrp;
            $mahasiswa = Mahasiswa::create($data);
        }

        
        if (!$mahasiswa) {
            return redirect()->route('profil.index')->with("error", "Registration failed, try again.");
        }
        return redirect()->route('profil.index')->with('success', 'User added successfully');
    }

    public function edit($nrp)
    {
        $mahasiswa = Mahasiswa::find($nrp);
        return view('Dashboard.editprofil')->with([
            'title' => 'Edit User',
            'user' => $mahasiswa
        ]);
    }

    public function update(Request $request, $nrp)
    {

        $mahasiswas = Mahasiswa::find($nrp);

        $validated = $request->validate([
            'nrp' => 'required|unique:users,nrp,'  . $mahasiswas->nrp . ',nrp',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $mahasiswas->nrp . ',nrp',
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

        $mahasiswas->update($validated);

        return redirect()->route('AddUser.index')->with('success', 'User edited successfully');
        // return response()->json(['success' => $validated]);
    }



    public function destroy($nrp)
    {
        $mahasiswas = Mahasiswa::findOrFail($nrp);
        $mahasiswas->delete();
        return redirect()->route('AddUser.index')->with('success', 'User deleted successfully');
    }

    public function ipkMethod()
    {
        $randomIPK = mt_rand(275, 400) / 100; // Generate a random number between 275 and 400 and divide by 100

        return view('profil.index', [
            'randomIPK' => $randomIPK,
        ]);
    }
}
