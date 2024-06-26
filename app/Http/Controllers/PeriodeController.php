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

    public function edit($periode)
    {


        $periodes = Periode::find($periode);
        return view('Fakultas.EditPeriode')->with([
            'title' => 'Edit Periode',
            'periodes' => $periodes
        ]);
    }


    public function update(Request $request, $periode)
    {
        $request->validate([
            'id_periode' => 'required|string|max:5',
            'nama_periode' => 'required|string|max:50'
        ]);

        $periode = Periode::findOrFail($periode);
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
