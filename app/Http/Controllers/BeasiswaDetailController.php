<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\BeasiswaDetail;

use Illuminate\Http\Request;

class BeasiswaDetailController extends Controller
{
    public function index()
    {
        return view('Fakultas.ApproveBeasiswa', [
            'title' => 'Prodi',
            'details' => BeasiswaDetail::all()
        ]);
    }

    public function indexStudent()
    {
        $details = BeasiswaDetail::where('nrp', auth()->user()->nrp, true)
                                    ->get();
        // return $mahasiswa;
        if ($details->isEmpty()) {
            return 'Terjadi kesalahan';
        } else {
            return view('Fakultas.ApproveBeasiswa', [
                'title' => 'Prodi',
                'details' => $details
            ]);
        }
    }

    public function storee($id_periode, $id_beasiswa, $nrp, $role, $condition)
    {
        // Retrieve the BeasiswaDetail instance based on given criteria
        $detail = BeasiswaDetail::where('id_periode', $id_periode)
                                ->where('id_beasiswa', $id_beasiswa)
                                ->where('nrp', $nrp)
                                ->firstOrFail();
        
        if ($role == 'Prodi') {
            if($condition == 1) {
                $detail->status_1 = 1;
            } else {
                $detail->status_1 = -1;
            }
        } elseif ($role == 'Fakultas') {
            if($condition == 1) {
                $detail->status_2 = 1;
            } else {
                $detail->status_2 = -1;
            }
        }
        $detail->save();
        

        return redirect()->route('fakultas.approve.index')->with('success', 'BeasiswaDetail updated successfully');
    }

    public function update(Request $request, $id_periode, $id_beasiswa, $nrp)
    {
        $detail = BeasiswaDetail::where('id_periode', $id_periode)
                                    ->where('id_beasiswa', $id_beasiswa)
                                    ->where('nrp', $nrp)
                                    ->firstOrFail();
        return $detail->status_1;

        return redirect()->route('BeasiswaDetail.index')->with('success', 'Prodi updated successfully');
    }

    public function edit($id) {
        $prodi = BeasiswaDetail::findOrFail($id);
        return view('Admin.Prodi.EditProdi', [
            'title' => 'EditFakultas',
            'prodi' => $prodi
        ]);
    }

    public function destroy($id)
    {
        $prodi = BeasiswaDetail::findOrFail($id);
        $prodi->delete();

        return redirect()->route('BeasiswaDetail.index')->with('success', 'Prodi deleted successfully');
    }

    // public function getStatus()
    // {
    //     if ($this->status_1 == 1 && $this->status_2 == 1) {
    //         return 'Disetujui';
    //     } elseif ($this->status_1 == -1 || $this->status_2 == -1) {
    //         return 'Ditolak';
    //     } else {
    //         return 'Pending';
    //     }
    // }
}
