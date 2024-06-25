<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $periodes = Periode::all();
        return view('Fakultas.Periode', [
            'title' => 'periode',
            'periodes' => $periodes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_periode' => 'required|string|max:5',
            'nama_periode' => 'required|string|max:50'
        ]);

        
        Periode::create($request->all());
        return redirect()->route('periode.index')->with('success', 'Beasiswa added successfully');
    }

    public function edit($id)
    {
        $periodes = Periode::find($id);
        return view('Fakultas.Periode')->with([
            'title' => 'Edit User',
            'periodes' => $periodes
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'id_periode' => 'required|string|max:5',
            'nama_periode' => 'required|string|max:50'
        ]);

        $periode = Periode::findOrFail($id);
        $periode->update($request->all());

        return redirect()->route('periode.index')->with('success', 'Beasiswa updated successfully');
    }

    public function destroy($id)
    {
        $periode = Periode::findOrFail($id);
        $periode->delete();

        return redirect()->route('periode.index')->with('success', 'Beasiswa deleted successfully');
    }
}
