<nav class="navbar navbar-h navbar-expand-lg border-radius-lg start-0 end-0 mx-3">
    <div class="container-fluid">
        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3" href="#" style="display: flex; align-items: center;">
            <i class="bi bi-mortarboard-fill" style="font-size: 18px; margin-right: 12px;"></i>
            <span style="margin-bottom:1px;">Universitas Kristen Maranatha</span>
        </a>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
                <li class="nav-item" style="margin-top: 2px;">
                    <a class="nav-link d-flex align-items-center me-2" href="/profil">
                        <i class="fa fa-user me-2"></i>
                        <span style="margin-top: 1px">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-flex">
                        @csrf 
                        <button type="button" class="nav-link d-flex align-items-center me-2" id="logout-button" style="border: none; background-color: transparent;">
                            <i class="bi bi-box-arrow-right me-2" style="font-size: 17px;"></i>                            
                            <span style="margin-bottom: 2px">Log Out</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
document.getElementById('logout-button').addEventListener('click', function (event) {
    event.preventDefault();
    Swal.fire({
        title: "Are you sure you want to log out?",
        text: "You will need to log in again to access your account.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, log out",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
});
</script>