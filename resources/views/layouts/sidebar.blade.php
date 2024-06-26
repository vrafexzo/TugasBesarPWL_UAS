<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="#" target="_blank">
        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Beasiswa Maranatha</span>
    </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="/dashboard">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @Auth
                @if (Auth::user()->role == 'Prodi')
                    <li class="nav-item dropdown" style="height: 50px; border-radius:5px;">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left:16px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
                                <path class="beasiswa-icon" d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                            </svg>
                            <span class="nav-link-text"style="margin-left:20px">Prodi</span>
                        </a>
                        <ul style="background-color: #5E72E4;">
                            <li><a style="color:white;" class="dropdown-item" href="/approve">Approve Beasiswa</a></li>
                        </ul>
        
                    </li>
                    
                @elseif (Auth::user()->role == 'Fakultas') 
                    <li class="nav-item dropdown" style="height: 50px; border-radius:5px;">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left:16px;">
                            <i class="bi bi-person-workspace" style="margin-left: 2px; color:#5e72e4;"></i>                            
                            <span class="nav-link-text font-weight-bold"style="margin-left:8px">Faculty</span>
                        </a>
                        {{-- <ul style="background-color: #5E72E4;">
                            <li><a style="color:white;" class="dropdown-item" href="#">Approve Beasiswa</a></li>
                            <li>
                                <a style="color:white;" class="dropdown-item" href="/fakultas/periode">Periode</a>

                            </li>
                            <li>
                                <a style="color:white;" class="dropdown-item" href="/fakultas/periode_beasiswa">Periode Beasiswa</a>
                            </li>
                        </ul> --}}
                        <ul class="dropdown-menu" style="background-color: #5E72E4;">
                            <li><a style="color:white;" class="dropdown-item" href="/approve">Approve Beasiswa</a></li>
                            <li><a style="color:white;" class="dropdown-item" href="/fakultas/periode">Periode</a></li>
                            <li><a style="color:white;" class="dropdown-item" href="/fakultas/periode_beasiswa">Periode Beasiswa</a></li>
                        </ul>
                    </li>
                    
                @elseif (Auth::user()->role == 'Mahasiswa') 
                    <li class="nav-item dropdown" style="height: 50px; border-radius: 5px;">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: 16px;">
                            <i class="bi bi-person" style="font-size: 20px; margin-right: 8px; color:#5e72e4;"></i>
                            <span class="nav-link-text font-weight-bold" style="margin-top:2px;">Students</span>
                        </a>
                        <ul class="dropdown-menu" style="background-color: #5E72E4;">
                            <li><a style="color: white;" class="dropdown-item" href="{{ route('student.timeline') }}">Timeline Beasiswa</a></li>
                            <li><a style="color: white;" class="dropdown-item" href="/students/history">History Beasiswa</a></li>
                        </ul>
                    </li>
                
                
                @elseif (Auth::user()->role == 'Admin') 
                    <li class="nav-item dropdown" style="height: 50px; border-radius:5px;">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left:19px;">
                            <i class="bi bi-person-video3" style="font-size:15px; color:#5e72e4;"></i>
                            <span class="nav-link-text font-weight-bold"style="margin:2px 0px 0px 7px;">Admin</span>
                        </a>
                        <ul class="dropdown-menu" style="background-color: #5E72E4;">
                            <li><a style="color:white;" class="dropdown-item" href="/AddFakultas">Add Fakultas</a></li>
                            <li><a style="color:white;" class="dropdown-item" href="/AddProdi">Add Prodi</a></li>
                            <li><a style="color:white;" class="dropdown-item" href="/AddUser">Add User</a></li>
                            <li><a style="color:white;" class="dropdown-item" href="/AddBeasiswa">Beasiswa</a></li>
                        </ul>
                    </li>
                
                @endif
            @endauth
        </ul>
    </div>
</aside>
