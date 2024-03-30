<?php
require_once 'function.php';
require_once 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <?php include_once 'head.php'; ?>
</head>
<body class="sb-nav-fixed">
<?php include_once 'navbar.php'; ?>
<div id="layoutSidenav">
<?php include_once 'sidebar.php'; ?>
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Data Barang Masuk
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Data Barang Keluar
                    </div>
                    <div class="card-body"><canvas id="myBarChart2" width="100%" height="50"></canvas></div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once 'footer.php'; ?>
</div>
</div>
<?php include_once 'script.php'; ?>
</body>
</html>
