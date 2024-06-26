<!DOCTYPE html>
<html lang="en"> 

{{-- HEAD  --}}
@include('layouts.headers')

<body class="g-sidenav-show bg-gray-100">

    {{-- SIDEBAR  --}}
    <div class="min-height-300 bg-primary position-fixed w-100"></div>
    @include('layouts.sidebar')

    {{-- MAIN  --}}
    <main class="main-content position-relative border-radius-lg" style="min-height: 100vh; justify-content: center;">

    <div class="wrap-h p-4">
        <div class="container-hero shadow-lg blur">
            <div class="rounded conten">
                <div class="wrp-img">
                    <img src="../assets/img/h-3.jpg" class="logo-hero" alt="logo-hero">
                </div>
                <div>
                    <!-- Navbar -->
                    @include('layouts.nav-hero')
                    <div class="text-hero">  
                        <div class="text p-4">
                            @auth
                                Your user ID is: {{ auth()->user()->nrp }}
                            @endauth

                            <h1>Raih Masa Depan Cerah dengan Beasiswa Terbaik</h1>
                            <h5>Beasiswa kami menawarkan peluang emas untuk meraih pendidikan tanpa beban biaya. Bergabunglah dengan kami dan fokuslah pada impian Anda!</h5>
                        </div> 
                        <button type="button" class="btn btn-outline-dark" style="border-radius:25px; font-size:16px;">Get Started</button>          
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        @if ($errors->any())
            <div class="col-12">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            </div>
        @endif
    </div>
    </main>

    @include('layouts.script')

    @if(session()->has('error'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    @if(session()->has('success'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

</body>
</html>
