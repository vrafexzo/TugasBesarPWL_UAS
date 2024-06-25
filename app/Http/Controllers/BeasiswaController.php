<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Beasiswa;
class BeasiswaController extends Controller
{
    public function index()
    {
        $beasiswas = Beasiswa::all(); // Mengambil semua data beasiswa

        return view('Admin.AddBeasiswa.AddBeasiswa', [
            'title' => 'Add Beasiswa',
            'beasiswas' => $beasiswas
        ]);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'id_beasiswa' => 'required|string|max:5',
            'jenis_beasiswa' => 'required|string|max:50',
        ]);

        Beasiswa::create($request->all());

        return redirect()->route('AddBeasiswa.index')->with('success', 'Beasiswa added successfully');
    }

    public function edit($id)
    {
        $beasiswas = Beasiswa::find($id);
        return view('Admin.AddBeasiswa.EditBeasiswa')->with([
            'title' => 'Edit User',
            'beasiswas' => $beasiswas
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'id_beasiswa' => 'required|string|max:5',
            'jenis_beasiswa' => 'required|string|max:50'
        ]);



        $beasiswa = Beasiswa::findOrFail($id);
        $beasiswa->update($request->all());

        return redirect()->route('AddBeasiswa.index')->with('success', 'Beasiswa updated successfully');
    }

    public function destroy($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        $beasiswa->delete();

        return redirect()->route('AddBeasiswa.index')->with('success', 'Beasiswa deleted successfully');
    }
}
