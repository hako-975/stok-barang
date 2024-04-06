<?php
require_once 'function.php';

checkLogin();
$dataUserLogin = dataUserLogin();

$id_barang = $_GET['id_barang'];

if ($id_barang == null) {
    header("Location:barang.php");
    exit;
}

$barang = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang = '$id_barang'");
$data_barang = mysqli_fetch_assoc($barang);

if (isset($_POST['btnUbahBarang'])) {
    if (ubahBarang($_POST) > 0) {
      setAlert("Berhasil", "Barang berhasil diubah", "success");
      header("Location: barang.php");
      exit;
    }
}

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
        <div class="row justify-content-between mt-4">
            <div class="col my-auto">
                <h1>Ubah Barang - <?= $data_barang['nama_barang']; ?></h1>
            </div>
        </div>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <form method="post">
                    <input type="hidden" name="id_barang" value="<?= $data_barang['id_barang']; ?>">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ubahBarangModalLabel<?= $data_barang['id_barang']; ?>">Ubah Barang - <?= $data_barang['nama_barang']; ?></h1>
                            <a href="barang.php" class="btn-close"></a>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_barang<?= $data_barang['id_barang']; ?>" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang<?= $data_barang['id_barang']; ?>" name="nama_barang" value="<?= $data_barang['nama_barang']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi<?= $data_barang['id_barang']; ?>" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi<?= $data_barang['id_barang']; ?>" name="deskripsi" required><?= $data_barang['deskripsi']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="total_stok<?= $data_barang['id_barang']; ?>" class="form-label">Total Stok</label>
                                <input type="number" class="form-control" id="total_stok<?= $data_barang['id_barang']; ?>" name="total_stok" value="<?= $data_barang['total_stok']; ?>" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="btnUbahBarang"><i class="fas fa-fw fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php include_once 'footer.php'; ?>
</div>
</div>
</body>
</html>
