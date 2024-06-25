<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddProdi;

class AddProdiController extends Controller
{
    public function index()
    {
        return view('Admin.Prodi.Prodi', [
            'title' => 'Prodi',
            'prodi' => AddProdi::all()
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:prodi,id_prodi|max:5',
            'nama' => 'required|string|max:255',
            'id_fakultas' => 'required|string|max:5'
        ]);

        AddProdi::create([
            'id_prodi' => $request->id,
            'nama_prodi' => $request->nama,
            'id_fakultas' => $request->id_fakultas
        ]);

        return redirect()->route('AddProdi.index')->with('success', 'Prodi added successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id' => 'required|max:5|unique:fakultas,id_fakultas,' . $id . ',id_fakultas',
            'nama' => 'required|string|max:255',
            'id_fakultas' => 'required|string|max:5'
        ]);

        $prodi = AddProdi::findOrFail($id);
        $prodi->update([
            'id_fakultas' => $request->id,
            'nama_prodi' => $request->nama,
            'id_fakultas' => $request->id_fakultas
        ]);

        return redirect()->route('AddProdi.index')->with('success', 'Prodi updated successfully');
    }

    public function edit($id) {
        $prodi = AddProdi::findOrFail($id);
        return view('Admin.Prodi.EditProdi', [
            'title' => 'EditFakultas',
            'prodi' => $prodi
        ]);
    }

    public function destroy($id)
    {
        $prodi = AddProdi::findOrFail($id);
        $prodi->delete();

        return redirect()->route('AddProdi.index')->with('success', 'Prodi deleted successfully');
    }
}
