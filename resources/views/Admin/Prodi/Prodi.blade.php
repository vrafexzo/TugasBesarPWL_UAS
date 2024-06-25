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
            width: 80%;
            padding: 10px;
            margin: 90px 0px 0px 0px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        ">
            <div class="card-header pb-0">
                <h6 class="mb-0">Form Input Prodi</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('AddProdi.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id" class="form-label">ID Prodi</label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="Masukkan ID Prodi" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Prodi</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Prodi" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_fakultas" class="form-label">Id Fakultas</label>
                        <input type="text" class="form-control" id="id_fakultas" name="id_fakultas" placeholder="Masukkan Id Fakultas" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>

        <div class="card" style="
            width: 80%;
            padding: 10px;
            margin: 25px 0px 80px 0px; 
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        ">
            <div class="card-header pb-0">
                <h6 class="mb-0">List of Prodi</h6>
            </div>
            <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID Prodi</th>
                            <th scope="col">Nama Prodi</th>
                            <th scope="col">ID Fakultas</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prodi as $f)
                            <tr id="prodiRow{{ $f->id_prodi }}">
                                <td id="idCell{{ $f->id_prodi }}">{{ $f->id_prodi }}</td>
                                <td id="namaCell{{ $f->id_prodi }}">{{ $f->nama_prodi }}</td>
                                <td id="idFakultasCell{{ $f->id_prodi }}">{{ $f->id_fakultas }}</td>
                                <td>
                                    <a href="{{ url('/AddProdi/' . $f->id_prodi . '/edit') }}" title="Edit Student">
                                        <button class="btn btn-info" style="width: 60px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">Edit</button>
                                    </a>
                                    <form action="{{ route('AddProdi.destroy', ['AddProdi' => $f->id_prodi]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-info bg-warning" type="submit" style="width: 60px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
