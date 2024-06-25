<!DOCTYPE html>
<html lang="en">

{{-- HEAD  --}}
@include('layouts.headers')

<body class="g-sidenav-show bg-gray-100">

{{-- SIDEBAR  --}}
<div class="min-height-300 bg-primary position-fixed w-100"></div>
@include('layouts.sidebar')

{{-- MAIN  --}}
<main class="main-content position-relative border-radius-lg" style="min-height: 100vh;">

    <!-- Navbar -->
    @include('layouts.navbar')

    {{-- CONTENT  --}}
    <div class="container" style="display: flex; flex-direction: column; align-items: center;">
        <div class="card" style="
        width: 90%;
        padding: 10px;
        margin: 100px 0px 0px 0px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        ">
            <div class="card-header pb-0">  
                <h6 class="mb-0">Form Add Profil Beasiswa</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('profil.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nrp" class="form-label">NRP</label>
                        <input type="text" class="form-control" id="nrp" name="nrp" value="{{ Auth::User()->nrp }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ Auth::User()->name }}" placeholder="Masukkan Jenis Beasiswa">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">No Telepon</label>
                        <input class="form-control" id="telepon" name="telepon" placeholder="Masukkan No Telepon"></input>
                    </div> 
                    <div class="mb-3">
                        <label for="agama" class="form-label">Agama</label>
                        <select class="form-control" id="agama" name="agama">
                            <option value="">Pilih Agama</option>
                            <option value="Syiah">Syiah</option>
                            <option value="Sunni">Sunni</option>
                            <option value="Protestan">Protestan</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Orthodox">Orthodox</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>                     
                    <div class="mb-3">
                        <label for="id_prodi" class="form-label">Prodi</label>
                        <select class="form-control" id="id_prodi" name="id_prodi">
                            <option value="">Pilih Prodi</option>
                            @foreach($prodis as $prodi)
                                <option value="{{ $prodi->id_prodi }}">{{ $prodi->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                    @php
                        $randomDouble = round(2.0 + mt_rand() / mt_getrandmax() * (4.0 - 2.0), 2);
                    @endphp
                    <div class="mb-3">
                        <label for="ipk" class="form-label">IPK (random)</label>
                        <input type="text" class="form-control" id="ipk" name="ipk" value="{{ $randomDouble }}" placeholder="Masukkan IPK">
                    </div>                                    
                        <button type="submit" class="btn btn-primary">Simpan/Update</button>
                </form>
            </div>
        </div>

        @if(isset($mahasiswa))
        <div class="table-responsive card" style="
            width: 90%;
            padding: 10px;
            margin: 25px 0px 50px 0px; 
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        ">
            <div class="card-header pb-0">
                <h6 class="mb-0">Profil Anda</h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">NRP</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">No Telepon</th>
                            <th scope="col">Agama</th> 
                            <th scope="col">Prodi</th>
                            <th scope="col">IPK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $mahasiswa->nrp }}</td>
                            <td>{{ $mahasiswa->nama}}</td>
                            <td>{{ $mahasiswa->tanggal_lahir }}</td>
                            <td>{{ $mahasiswa->telepon }}</td>
                            <td>{{ $mahasiswa->agama }}</td>
                            <td>{{ $mahasiswa->id_prodi }}</td>
                            <td>{{ $mahasiswa->IPK }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @else
            <span>Anda belum memiliki profil</span>
        @endif
    </div>
</main>

    
    @include('layouts.script')
</body>
</html>
