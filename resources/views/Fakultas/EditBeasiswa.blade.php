<!DOCTYPE html>
<html lang="en">

{{-- HEAD  --}}
@include('layouts.headers')

<body class="g-sidenav-show bg-gray-100">

    {{-- SIDEBAR  --}}
    <div class="min-height-300 bg-primary position-fixed w-100"></div>
    @include('layouts.sidebar')
    <main style="height: 170vh;">

        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- End Navbar -->

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="table-responsive card" style="
            position: absolute;
            top: 85%;
            left: 60%;
            transform: translate(-50%, -50%);
            width: 70%;
            padding: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        ">
            <div class="card-header pb-0">
                <h6 class="mb-0">Form edit Beasiswa untuk {{ $beasiswa->id_periode }} {{ $beasiswa->id_beasiswa  }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('periode_beasiswa.update', [$beasiswa->id_periode, $beasiswa->id_beasiswa])  }}" method="POST">
                    @csrf
                    @method("PATCH")
                    <input type="hidden" class="form-control" id="id_periode" name="id_periode" value={{ $beasiswa->id_periode }} >
                    <input type="hidden" class="form-control" id="id_beasiswa" name="id_beasiswa" value={{ $beasiswa->id_beasiswa }}  >

                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value={{  $beasiswa->tanggal_mulai }} >
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
                        <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir" value={{  $beasiswa->tanggal_berakhir }} >
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" value={{  $beasiswa->deskripsi }} ></textarea>
                    </div>
                    @php
                        $today = now();
                        $expired = false;

                        if ($beasiswa->tanggal_berakhir < $today || $beasiswa->jatuh_tempo < $today) {
                            $expired = true;
                        }
                    @endphp

                    @if ($expired)
                    <input type="hidden" class="form-control" id="status" name="status" value="Expired">

                    @else
                    <input type="hidden" class="form-control" id="status" name="status" value="Active">

                    @endif
                        
                
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                
            </div>
        </div>

        
    </main>
    
    
    
    @include('layouts.script')
</body>
</html>
