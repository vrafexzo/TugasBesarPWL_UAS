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
            margin: 100px 0px 0px 0px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        ">
            <div class="card-header pb-0">
                <h6 class="mb-0">Form Edit Fakultas untuk {{ $fakultas->id_fakultas }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('AddFakultas/' .$fakultas->id_fakultas) }}" method="POST">
                    {!!  csrf_field() !!}
                    @method("PATCH")
                    {{-- <div class="mb-3">
                        <label for="id" class="form-label">ID Fakultas</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{ $fakultas->id_fakultas }}">
                    </div> --}}
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ $fakultas->id_fakultas }}">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Fakultas</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $fakultas->nama_fakultas }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
