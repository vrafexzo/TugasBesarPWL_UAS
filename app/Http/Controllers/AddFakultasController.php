<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddFakultas;

class AddFakultasController extends Controller
{
    public function index()
    {


        return view('Admin.Fakultas.AddFakultas', [
            'title' => 'AddFakultas',
            'fakultas' => AddFakultas::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:fakultas,id_fakultas|max:5',
            'nama' => 'required|string|max:255'
        ]);

        AddFakultas::create([
            'id_fakultas' => $request->id,
            'nama_fakultas' => $request->nama
        ]);

        return redirect()->route('AddFakultas.index')->with('success', 'Fakultas added successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id' => 'required|max:5|unique:fakultas,id_fakultas,' . $id . ',id_fakultas',
            'nama' => 'required|string|max:255'
        ]);

        $fakultas = AddFakultas::findOrFail($id);
        $fakultas->update([
            'id_fakultas' => $request->id,
            'nama_fakultas' => $request->nama
        ]);

        return redirect()->route('AddFakultas.index')->with('success', 'Fakultas updated successfully');
    }

    public function edit($id) {
        $fakultas = AddFakultas::findOrFail($id);
        return view('Admin.Fakultas.EditFakultas', [
            'title' => 'EditFakultas',
            'fakultas' => $fakultas
        ]);
    }

    public function destroy($id)
    {
        $fakultas = AddFakultas::findOrFail($id);
        $fakultas->delete();

        return redirect()->route('AddFakultas.index')->with('success', 'Fakultas deleted successfully');
    }
}
