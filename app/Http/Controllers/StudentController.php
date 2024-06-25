<?php

namespace App\Http\Controllers;

use App\Models\AddBeasiswa;
use App\Models\AddProdi;
use App\Models\ViewPeriodeBeasiswa;
use App\Models\BeasiswaDetail;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\prodi;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function timeline(){
        $tabBeasiswa = ViewPeriodeBeasiswa::all();
        return view('Students.TimelineBeasiswa',[
            'title' => 'Students',
            'beasiswas' => $tabBeasiswa,
        ]);

        // return ('LARAVEL KONTROLLER');
    }

    public function indexPendaftaran($id_periode, $id_beasiswa, $nrp) {
        $daftar = ViewPeriodeBeasiswa::where('id_periode', $id_periode)
                                    ->where('id_beasiswa', $id_beasiswa)
                                    ->firstOrFail();

                                    $mahasiswa = Mahasiswa::where('nrp', auth()->user()->nrp, true)
                                    ->get();
        
        $User = User::where('nrp', $nrp)->firstOrFail();
        $Prodi = AddProdi::where('id_prodi', $mahasiswa[0]->id_prodi)->firstOrFail();
        // return $mahasiswa;
        return view('Students.Pendaftaran',[
            'title' => 'Students',
            'daftar' => $daftar,
            'mahasiswa' => $mahasiswa[0],
            'User' => $User,
            'Prodi' => $Prodi
        ]);
    }

    public function storePendaftaran(Request $request, $id_periode, $id_beasiswa, $nrp)
    {
        $mahasiswa = Mahasiswa::where('nrp', $nrp )->firstOrFail();
        $data['nrp'] = $nrp;
        $data['id_periode'] = $id_periode;
        $data['id_beasiswa'] = $id_beasiswa;
        $data['IPK'] = (double) ($mahasiswa->IPK);
        $data['poin_portfolio'] = NULL;
        $data['status_1'] = 0;
        $data['status_2'] = 0;

        // $originalName = $request->file('file_field')->getClientOriginalName();

        // // Generate a unique filename for the uploaded file
        // $fileName = pathinfo($originalName, PATHINFO_FILENAME); // Get the filename without extension
        // $extension = $request->file('file_field')->getClientOriginalExtension(); // Get the file extension
        // $customFileName = $fileName . '_' . time() . '.' . $extension; // Customize the filename as needed



        $id_file = $id_periode .'|'. $id_beasiswa .'|'. $nrp;
        if ($request->sertifikat) {
            $request->validate([
                'pkm' => 'required|mimes:pdf|max:8888',
                'beasiswa_lain' => 'required|mimes:pdf|max:8888',
                'dosen_wali' => 'required|mimes:pdf|max:8888',
                
                'sertifikat' => 'required|mimes:pdf|max:8888',
                'organisasi' => 'required|mimes:pdf|max:8888',
            ]);

        $request->file('sertifikat')->storeAs('uploads','sertifikatFF', 'public');
        $request->file('organisasi')->storeAs('uploads','organisasiFF', 'public');

        } elseif ($request->hasFile('prestasi')) {
            $request->validate([
                'pkm' => 'required|mimes:pdf|max:8888',
                'beasiswa_lain' => 'required|mimes:pdf|max:8888',
                'dosen_wali' => 'required|mimes:pdf|max:8888',

                'prestasi' => 'required|mimes:pdf|max:8888',
            ]);
        $request->file('prestasi')->storeAs('uploads', 'prestasiFF', 'public');

        } elseif ($request->hasFile('sktm')) {
            
            $request->validate([
                'pkm' => 'required|mimes:pdf|max:8888',
                'beasiswa_lain' => 'required|mimes:pdf|max:8888',
                'dosen_wali' => 'required|mimes:pdf|max:8888',

                'sktm' => 'required|mimes:pdf|max:8888',
                'listrik' => 'required|mimes:pdf|max:8888',
                'air' => 'required|mimes:pdf|max:8888',
                'pbb' => 'required|mimes:pdf|max:8888',
            ]);
        $request->file('sktm')->storeAs('uploads', 'sktmFF', 'public');
        $request->file('listrik')->storeAs('uploads', 'listrikFF', 'public');
        $request->file('air')->storeAs('uploads', 'airFF', 'public');
        $request->file('pbb')->storeAs('uploads', 'pbbFF', 'public');
        } else {
            return "TERJADI KESALAHAN";
        }
        $request->file('pkm')->storeAs('uploads', 'pkmFF', 'public');
        $request->file('beasiswa_lain')->storeAs('uploads', 'beasiswa_lainFF', 'public');
        $request->file('dosen_wali')->storeAs('uploads', 'dosen_waliFF', 'public');

        BeasiswaDetail::create($data);

        return redirect()->route('student.timeline')->with('success', 'Beasiswa added successfully');
    }

    public function indexHistory(){
        
        return view('Students.History',[
            'title' => 'Students'
        ]);
    }
}

