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
    <div class="container" style="margin-bottom: 50px;">
        <div class="table-container" style="overflow-y: auto; max-height: 80vh;">
            <div class="table-responsive"
            style="
                margin-top: 80px;
                width: 100%;
                padding: 20px;
            ">
                
                <table class="tableData table table-white table-bordered"
                style="
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                    border: 4px solid rgba(255, 255, 255, 0.8);
                ">
                    <thead>
                        <tr style="background-color: #FB6340; color: black;">
                            <th>Periode</th>
                            <th>Jenis Beasiswa</th>
                            <th>nrp</th>
                            <th>IPK</th>
                            <th>Poin Portofolio</th>
                            @if (Auth::user()->role != 'Mahasiswa')
                                <th>Status prodi</th>
                                <th>Status fakultas</th>
                            @endif
                            <th>Status</th>
                            @if (Auth::user()->role != 'Mahasiswa')
                                <th>Action</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($details as $detail)
                        <tr style="text-align: center; color: black; background-color:#FAF7FF">
                            <td>{{ $detail->id_periode }}</td>
                            <td>{{ $detail->id_beasiswa }}</td>
                            <td>{{ $detail->nrp }}</td>
                            <td>{{ $detail->IPK }}</td>
                            <td>{{ $detail->poin_portfolio }}</td>
                            @if (Auth::user()->role != 'Mahasiswa')
                                <td>
                                    @if ($detail->status_1 ==1)
                                        <span style="color: green; font-weight: bold;">Disetujui</span>
                                    @elseif ($detail->status_1 == 0)
                                        <span style="color: orange; font-weight: bold;">Pending</span>
                                    @else
                                        <span style="color: red; font-weight: bold;">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($detail->status_2 ==1)
                                        <span style="color: green; font-weight: bold;">Disetujui</span>
                                    @elseif ($detail->status_2 == 0)
                                        <span style="color: orange; font-weight: bold;">Pending</span>
                                    @else
                                        <span style="color: red; font-weight: bold;">Ditolak</span>
                                    @endif
                                </td>
                            @endif
                            <td>
                                @if ($detail->status_1 ==1 && $detail->status_2 ==1)
                                    <span style="color: green; font-weight: bold;">Disetujui</span>
                                
                                @elseif (($detail->status_1 == 0 || $detail->status_2 == 0) && !($detail->status_1 == -1 || $detail->status_2 == -1))
                                    <span style="color: orange; font-weight: bold;">Pending</span>
                                @else
                                    <span style="color: red; font-weight: bold;">Ditolak</span>
                                @endif
                            </td>
                            @if (Auth::user()->role != 'Mahasiswa')
                                <td>
                                    <form action="{{ route('fakultas.approve.store', ['id_periode' => $detail->id_periode, 'id_beasiswa' => $detail->id_beasiswa,'nrp' => $detail->nrp, 'role' => Auth::user()->role, 'condition' => 1]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button class="btn btn-info bg-warning" type="submit" style="width: 60px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">Apply</button>
                                    </form>
                                    <form action="{{ route('fakultas.approve.store', ['id_periode' => $detail->id_periode, 'id_beasiswa' => $detail->id_beasiswa,'nrp' => $detail->nrp, 'role' => Auth::user()->role, 'condition' => 0]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button class="btn btn-info bg-warning" type="submit" style="width: 60px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">Tolak</button>
                                    </form>
                                </td>
                            @endif
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
