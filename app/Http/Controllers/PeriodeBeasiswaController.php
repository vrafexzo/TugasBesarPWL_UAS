<?php

namespace App\Http\Controllers;

use App\Models\PeriodeBeasiswa;
use App\Models\ViewPeriodeBeasiswa;
use Illuminate\Http\Request;

class PeriodeBeasiswaController extends Controller
{
    public function index()
    {
        $beasiswas = ViewPeriodeBeasiswa::all();

        return view('Fakultas.AddBeasiswa', [
            'title' => 'Add Beasiswa',
            'beasiswas' => $beasiswas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_periode' => 'required|string|max:5',
            'id_beasiswa' => 'required|string|max:5',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'jatuh_tempo' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|string',
        ]);
        
        $data = $request->except('status');

        
        if ($data['tanggal_berakhir'] < now()) {
            $data['status'] = 'Expired'; // Replace 'default_status_value' with your default value
        } else {
            $data['status'] = "Active";
        }
        
        
        PeriodeBeasiswa::create($data);


        return redirect()->route('periode_beasiswa.index')->with('success', 'Beasiswa added successfully');
    }

    public function edit($id_periode, $id_beasiswa)
    {
        $beasiswa = PeriodeBeasiswa::where('id_periode', $id_periode)
                                    ->where('id_beasiswa', $id_beasiswa)
                                    ->firstOrFail();

        return view('Fakultas.EditBeasiswa')->with([
            'title' => 'Edit Beasiswa',
            'beasiswa' => $beasiswa
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|string',
        ]);
        $data = [
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ];
    

        $data = $request->except('status');

        
        if ($data['tanggal_berakhir'] < now()) {
            $data['status'] = 'Expired'; // Replace 'default_status_value' with your default value
        } else {
            $data['status'] = "Active";
        }
        
        
        // Find the PeriodeBeasiswa model and update it with the validated data
        PeriodeBeasiswa::where('id_periode', $request->id_periode)
        ->where('id_beasiswa', $request->id_beasiswa)
        ->firstOrFail()->update($data);
    
        // Redirect with success message
        return redirect()->route('periode_beasiswa.index')
                         ->with('success', 'Beasiswa updated successfully');
    
    
    }

    public function destroy($id_periode, $id_beasiswa)
    {
        $beasiswa = PeriodeBeasiswa::where('id_periode', $id_periode)
            ->where('id_beasiswa', $id_beasiswa)
            ->firstOrFail();
        $beasiswa->delete();

        return redirect()->route('periode_beasiswa.index')->with('success', 'Beasiswa deleted successfully');
    }
}
