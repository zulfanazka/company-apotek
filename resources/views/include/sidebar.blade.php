<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <!-- <div class="sb-sidenav-menu-heading">Interface</div> -->
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompanyProfile"
    aria-expanded="false" aria-controls="collapseCompanyProfile">
    <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
    Company Profile
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseCompanyProfile" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="{{ route('home') }}">Home</a>
        <a class="nav-link" href="{{ route('profiles') }}">Profiles</a>
        <a class="nav-link" href="{{ route('product') }}">Product</a>
        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
    </nav>
</div>

                <!-- <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a>
            </div> -->
            </div>
            <!-- <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div> -->
    </nav>
</div>
