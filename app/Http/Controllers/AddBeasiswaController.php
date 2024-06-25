<?php

namespace App\Http\Controllers;

use App\Models\AddBeasiswa;
use Illuminate\Http\Request;

class AddBeasiswaController extends Controller
{
    public function index()
    {
        $beasiswas = AddBeasiswa::all(); // Mengambil semua data beasiswa

        return view('Admin.AddBeasiswa.AddBeasiswa', [
            'title' => 'Add Beasiswa',
            'beasiswas' => AddBeasiswa::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'periode' => 'required|string|max:50',
            'jenis_beasiswa' => 'required|string|max:100',
            'nama_beasiswa' => 'required|string|max:100',
            'asal_beasiswa' => 'required|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'jatuh_tempo' => 'nullable|date',
            'deskripsi' => 'nullable|string',
        ]);

        AddBeasiswa::create($request->all());

        return redirect()->route('beasiswa.index')->with('success', 'Beasiswa added successfully');
    }

    public function edit($id)
    {
        $beasiswas = AddBeasiswa::find($id);
        return view('Admin.AddBeasiswa.EditBeasiswa')->with([
            'title' => 'Edit User',
            'beasiswas' => $beasiswas
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'periode' => 'required|string|max:50',
            'jenis_beasiswa' => 'required|string|max:100',
            'nama_beasiswa' => 'required|string|max:100',
            'asal_beasiswa' => 'required|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'jatuh_tempo' => 'nullable|date',
            'deskripsi' => 'nullable|string',
        ]);



        $beasiswa = AddBeasiswa::findOrFail($id);
        $beasiswa->update($request->all());

        return redirect()->route('beasiswa.index')->with('success', 'Beasiswa updated successfully');
    }

    public function destroy($id)
    {
        $beasiswa = AddBeasiswa::findOrFail($id);
        $beasiswa->delete();

        return redirect()->route('beasiswa.index')->with('success', 'Beasiswa deleted successfully');
    }
}
