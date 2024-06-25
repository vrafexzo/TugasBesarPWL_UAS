<!DOCTYPE html>
<html lang="en">

{{-- HEAD --}}
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
    <div class="container" style="display: flex; flex-direction: column; align-items: center;">
        <div class="card" style="
        width: 90%;
        padding: 10px;
        margin: 90px 0px 0px 0px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        ">
            <div class="card-header pb-0">  
                <h6 class="mb-0">Form Add Jenis Beasiswa</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('AddBeasiswa.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_beasiswa" class="form-label">id Beasiswa</label>
                        <input type="text" class="form-control" id="id_beasiswa" name="id_beasiswa" placeholder="Masukkan Periode" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_beasiswa" class="form-label">jenis_beasiswa</label>
                        <input type="text" class="form-control" id="jenis_beasiswa" name="jenis_beasiswa" placeholder="Masukkan Jenis Beasiswa" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>

        @if(isset($beasiswas))
        <div class="table-responsive card" style="
            width: 90%;
            padding: 10px;
            margin: 25px 0px 80px 0px; 
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        ">
            <div class="card-header pb-0">
                <h6 class="mb-0">List of Beasiswa</h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id Beasiswa</th>
                            <th scope="col">Jenis Beasiswa</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($beasiswas as $beasiswa)
                            <td>{{ $beasiswa->id_beasiswa }}</td>
                            <td>{{ $beasiswa->jenis_beasiswa }}</td>
                            {{-- <td id="namaBeasiswaCell{{ $beasiswa->id }}">{{ $beasiswa->nama_beasiswa }}</td>  --}}
                            <td>
                                <a href="{{ route('AddBeasiswa.edit', $beasiswa->id_beasiswa) }}" title="Edit Beasiswa">
                                    <button class="btn btn-info" style="width: 60px; display: inline-flex; align-items: center; justify-content: center;">Edit</button>
                                </a>
                                <form action="{{ route('AddBeasiswa.destroy', $beasiswa->id_beasiswa) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-info bg-warning" style="width: 60px; height: 40px; display: inline-flex; align-items: center; justify-content: center;" onclick="return confirm('Are you sure you want to delete this beasiswa?')">Delete</button> 
                                </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
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
