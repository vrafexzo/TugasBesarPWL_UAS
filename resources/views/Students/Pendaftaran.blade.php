<!DOCTYPE html>
<html lang="en"> 

    {{-- HEAD  --}}
    @include('layouts.headers')

<body class="g-sidenav-show bg-gray-100">

    {{-- SIDEBAR --}}
    <div class="min-height-300 bg-primary position-fixed w-100"></div>
    @include('layouts.sidebar');

{{-- MAIN  --}}
<main class="main-content position-relative border-radius-lg" style="min-height: 100vh;">

    <!-- Navbar -->
    @include('layouts.navbar')
    <!-- End Navbar -->

    {{-- CONTENT  --}}
    <div class="container mb-5" style="display: flex; flex-direction: column; align-items: center;">
        <div class="card" style="
            width: 80%;
            padding: 20px;
            margin: 90px 0px 0px 0px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        ">  
            <div class="card-body">
                <div class="form-group mb-5" style="
                    background-color: #FB6340; 
                    border-radius:10px;
                    width: 100%;
                    height: 50px;
                    text-align: center;
                    padding: 7px;
                    margin: 5px 0px 0px 0px;
                ">
                    <div>
                        <h4 class="heading" style="color:#FFFFFF;">Registrasi</h4>
                    </div>
                </div>
                <form action="{{ route("daftar.store", ['id_periode' => $daftar->id_periode, 'id_beasiswa' => $daftar->id_beasiswa, 'nrp' => Auth::User()->nrp]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-lg-12">
                        <div class="control-label">NRP :</div>
                        <input type="text" class="form-control" name="nrp" value="{{ Auth::User()->nrp }}" readonly="readonly">
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="control-label">Tanggal Lahir :</div>
                        <input type="text" class="form-control" id="ttl" value="{{ $mahasiswa->tanggal_lahir }}" readonly="readonly">
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="control-label">Nama :</div>
                        <input type="text" class="form-control" id="nama" value="{{ $mahasiswa->nama }}" readonly="readonly">
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="control-label" style="width:100%;">No Telepon :</div>
                        <input type="text" class="form-control" onkeypress="return angka(event)" id="notelepon" value="{{ $mahasiswa->telepon }}" readonly="readonly" >
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="control-label">Email :</div>
                        <input type="text" class="form-control" id="email" value="{{ $User->email }}" readonly="readonly">
                    </div> 
                    <div class="form-group col-lg-12">
                        <div class="control-label">IPK :</div>
                        <input type="text" class="form-control" name="ipk" value="{{ $mahasiswa->IPK }}" readonly="readonly">
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="control-label">Fakultas :</div>
                        <input type="text" class="form-control" id="facultytext" data-facultyid="" value="{{ $Prodi->id_fakultas }}" readonly="readonly">
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="control-label">Program Studi :</div>
                        <input type="text" class="form-control" id="programtext" data-programid="" value="{{ $mahasiswa->id_prodi }}" readonly="readonly">
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="control-label">Jenis beasiswa :</div>
                        <input type="text" class="form-control" id="jenis_beasiswa" data-programid="" value="{{ $daftar->jenis_beasiswa }}" readonly="readonly">
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="control-label">Priode :</div>
                        <input type="text" class="form-control" id="periode_beasiswa" data-programid="" value="{{ $daftar->nama_periode }}" readonly="readonly">
                    </div>

                    <div class="form-beasiswa">
                        <p>File form PKM</p>
                        <input type="file"  name="pkm" accept=".pdf">
                        
                        <p>File sedang tidak menerima beasiswa lain</p>
                        <input type="file"  name="beasiswa_lain" accept=".pdf">


                        <p>File surat rekomendasi dosen wali</p>
                        <input type="file"  name="dosen_wali" accept=".pdf">

                        @if ($daftar->jenis_beasiswa == 'AKADEMIK') 

                            <p>File bukti sertifikat</p>
                            <input type="file"  name="sertifikat" accept=".pdf">

                            <p>File aktif organisasi</p>
                            <input type="file"  name="organisasi" accept=".pdf">

                        @elseif ($daftar->jenis_beasiswa == 'NON-AKADEMIK') 
                            <p>File Prestasi di bidang seni dan budaya</p>
                            <input type="file"  name="prestasi" accept=".pdf">

                        @elseif ($daftar->jenis_beasiswa == 'EKONOMI LEMAH') 
                            <p>File SKTM</p>
                            <input type="file"  name="sktm" accept=".pdf">
                            
                            <p>File tagihan listrik</p>
                            <input type="file"  name="listrik" accept=".pdf">
                            
                            <p>File tagihan Air</p>
                            <input type="file"  name="air" accept=".pdf">

                            <p>File PBB 3 bulan terakhir</p>
                            <input type="file"  name="pbb" accept=".pdf">
                        @else
                            <h1>TERJADI ERROR</h1>
                        @endif
                    </div>
                    <br>
                    <div class="bt mt-2">
                        <button class="btn btn-warning">Apply</button>                
                    </div>
                </form>
            </div>
        </div>
    </div>    
</main>

<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3 ">
            <div class="float-start">
                <h5 class="mt-3 mb-0">Argon Configurator</h5>
                <p>See our dashboard options.</p>
            </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0 overflow-auto">
            <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
                </div>
                    <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="d-flex my-3">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
                <div class="mt-2 mb-5 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    @include('layouts.script')
</body>
</html>