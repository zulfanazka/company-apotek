<!-- @include('include.style')


<nav class="navbar navbar-expand navbar-light bg-white shadow-sm px-4 py-2" style="margin-left: 250px; z-index: 1001;">
    <!-- Logo dan Nama -->
    <!-- <a class="navbar-brand d-flex align-items-center me-auto text-nowrap" href="#">
        <img src="{{ asset('template/assets/images/tolak angin.jpg') }}" alt="Logo" width="35" class="mr-2 rounded-circle">
        <span class="font-weight-bold text-primary ml-2">Apotek Rajawali</span>
    </a>

    <!-- Sidebar Toggle -->
    <!-- <button class="btn btn-link btn-sm d-none d-md-inline-block ml-2" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Search -->
    <!-- <form class="d-none d-md-inline-block flex-grow-1 mx-3">
        <div class="input-group">
            <input class="form-control border-0 shadow-sm" type="text" placeholder="Search for..." aria-label="Search" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Tanggal dan Jam -->
    <!-- <div class="d-none d-md-flex align-items-center text-muted small mr-3">
        <span>{{ \Carbon\Carbon::now()->format('d F Y') }}</span>
        <!-- <span class="ml-2" id="clock"></span> -->
    <!-- </div> -->

    <!-- User Dropdown -->
    <!-- <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" id="userDropdown" href="#" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('template/assets/images/tolak angin.jpg') }}" alt="User" class="rounded-circle"
                    width="30" height="30">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('home') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </div>
        </li>
    </ul>
</nav> -->

<!-- <script>
    function updateClock() {
        const now = new Date();
        const time = now.toLocaleTimeString('en-GB', { hour12: false });
        document.getElementById('clock').textContent = time;
    }
    setInterval(updateClock, 1000);
    updateClock();
</script> --> --> --> --> --> -->



<nav class="sb-topnav navbar navbar-light bg-white shadow-sm px-2 py-2">
    <img src="{{ asset('template/assets/images/tolak angin.jpg') }}" alt="Logo" width="35" class="ml-3 mr-1 rounded-circle">
    <a class="navbar-brand" href="index.html">Apotek Rajawali</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search-->
    <!-- Search -->
    <form class="d-none d-md-inline-block flex-grow-1 mx-3">
        <div class="input-group">
            <input class="form-control border-0 shadow-sm" type="text" placeholder="Search for..." aria-label="Search" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

     <div class="d-none d-md-flex align-items-center text-muted small ml-3 mr-3">
        <span>{{ \Carbon\Carbon::now()->format('d F Y') }}</span>
        <!-- <span class="ml-2" id="clock"></span> -->
    </div>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div>
                {{-- <a class="dropdown-item" href="login.html">Logout</a> --}}
                {{-- LOGOUT --}}
                <form action="{{ route('home') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>

            </div>
        </li>
    </ul>
</nav>
