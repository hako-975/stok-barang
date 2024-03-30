<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading"></div>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">BARANG</div>
                <a class="nav-link" href="barang_masuk.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-sign-in-alt"></i></div>
                    Barang Masuk
                </a>
                <a class="nav-link" href="barang_keluar.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                    Barang Keluar
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    BARANG
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="barang.php">Barang</a>
                        <a class="nav-link" href="barang_masuk.php">Barang Masuk</a>
                        <a class="nav-link" href="barang_keluar.php">Barang Keluar</a>
                    </nav>
                </div>
                
                <div class="sb-sidenav-menu-heading">User</div>
                
                <a class="nav-link" href="user.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    User
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= $dataUserLogin['email']; ?>
        </div>
    </nav>
</div>