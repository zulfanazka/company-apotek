@php
    $currentRoute = Route::currentRouteName();
@endphp

<style>
    /* Transisi halus untuk semua link */
    .sb-sidenav .nav-link {
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Hover untuk link utama sidebar */
    .sb-sidenav .nav-link:hover {
        background-color: #88CBF5 !important;
        color: #fff !important;
    }
.sb-sidenav .nav-link {
    color: #fff !important;
}

.sb-sidenav .nav-link:hover,
.sb-sidenav .nav-link.active {
    color: #fff !important;
}

    /* Hover untuk ikon di dalam link */
    .sb-sidenav .nav-link:hover .sb-nav-link-icon,
    .sb-sidenav .nav-link:hover i {
        color: #fff !important;
    }

    /* Hover untuk submenu (nested nav) */
    .sb-sidenav-menu-nested .nav-link:hover {
        background-color: #88CBF5 !important;
        color: #fff !important;
    }

    /* Style untuk link aktif */
    .nav-link.active, 
    .nav-link.active:hover {
        font-weight: bold;
        color: #fff !important;
        background-color: #237BDD !important; /* Warna utama sidebar */
    }

    /* Style khusus untuk sidebar dan accordion */
    #layoutSidenav_nav nav.sb-sidenav.accordion {
        background-color: #237BDD; /* Warna biru utama */
    }

    /* User Info Section */
    .sb-user-info {
        text-align: center;
        padding: 1rem 0;
    }

    .sb-user-info img {
        border-radius: 50%;
        margin-bottom: 0.5rem;
        width: 60px;
        height: 60px;
    }

    .sb-user-info .text-warning {
        font-size: 0.85rem;
    }

    .status-indicator .badge {
        width: 10px;
        height: 10px;
    }
/* Sidebar Background */
#layoutSidenav_nav nav.sb-sidenav.accordion {
    background-color: #237BDD;
}

/* Teks link default */
.sb-sidenav .nav-link {
    color: #fff !important;
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Hover dan aktif link */
.sb-sidenav .nav-link:hover,
.sb-sidenav .nav-link.active,
.sb-sidenav .nav-link.active:hover {
    background-color: #237BDD;
    color: #fff !important;
    font-weight: bold;
}

/* Ikon di link */
.sb-nav-link-icon,
.sb-nav-link-icon i {
    color: #fff !important;
}

/* Heading sidebar */
.sb-sidenav-menu-heading {
    color: #fff !important;
}

/* Collapse arrow */
.sb-sidenav-collapse-arrow i {
    color: #fff !important;
}

/* User Info, jika ada */
.sb-user-info {
    color: #fff !important;
}

    /* Margin dan padding untuk menu */
    .sb-sidenav-menu {
        padding-top: 0;
    }

    /* Collapse arrow color */
    .sb-sidenav-collapse-arrow i {
        color: #fff !important;
    }
</style>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #237BDD;">
        <!-- Sidebar Menu -->
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading text-white">Company Profile</div>


<a href="{{ route('adwelcome.index') }}" class="nav-link text-white {{ $currentRoute == 'adwelcome.index' ? 'active' : '' }}">
    <div class="sb-nav-link-icon text-white"><i class="fas fa-home"></i></div>
    Home
</a>

<a href="{{ route('adprofile.index') }}" class="nav-link text-white {{ $currentRoute == 'adprofile.index' ? 'active' : '' }}">
    <div class="sb-nav-link-icon text-white"><i class="fas fa-user"></i></div>
    Profiles
</a>

<a href="{{ route('adproduct.index') }}" class="nav-link text-white {{ $currentRoute == 'adproduct.index' ? 'active' : '' }}">
    <div class="sb-nav-link-icon text-white"><i class="fas fa-box"></i></div>
    Product
</a>

<a href="{{ route('contact') }}" class="nav-link text-white {{ $currentRoute == 'contact' ? 'active' : '' }}">
    <div class="sb-nav-link-icon text-white"><i class="fas fa-phone"></i></div>
    Contact
</a>

            </div>
        </div>
    </nav>
</div>
