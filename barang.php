<?php
require_once 'function.php';

checkLogin();
$dataUserLogin = dataUserLogin();

$barang = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_barang ASC");

if (isset($_POST['btnTambahBarang'])) {
    if (tambahBarang($_POST) > 0) {
      setAlert("Berhasil", "Barang berhasil ditambahkan", "success");
      header("Location: barang.php");
      exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Barang</title>
    <?php include_once 'head.php'; ?>
</head>
<body class="sb-nav-fixed">
<?php include_once 'navbar.php'; ?>
<div id="layoutSidenav">
<?php include_once 'sidebar.php'; ?>
<div id="layoutSidenav_content">
<main>
    <!-- Modal -->
    <div class="modal fade" id="tambahBarangModal" tabindex="-1" aria-labelledby="tambahBarangModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahBarangModalLabel">Tambah Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="nama_barang" class="form-label">Nama Barang</label>
                  <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                </div>
                <div class="mb-3">
                  <label for="deskripsi" class="form-label">Deskripsi</label>
                  <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                </div>
                <div class="mb-3">
                  <label for="total_stok" class="form-label">Total Stok</label>
                  <input type="number" class="form-control" min="0" id="total_stok" name="total_stok" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tutup</button>
                <button type="submit" class="btn btn-primary" name="btnTambahBarang"><i class="fas fa-fw fa-save"></i> Simpan</button>
              </div>
            </div>
        </form>
      </div>
    </div>

    <div class="container-fluid px-4">
        <div class="row justify-content-between mt-4">
            <div class="col my-auto">
                <h1>Barang</h1>
            </div>
            <div class="col text-end my-auto">
                <button type="button" data-bs-toggle="modal" data-bs-target="#tambahBarangModal" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Barang</button>
            </div>
        </div>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Deskripsi</th>
                                <th>Total Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($barang as $data_barang): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $data_barang['nama_barang']; ?></td>
                                    <td><?= $data_barang['deskripsi']; ?></td>
                                    <td><?= $data_barang['total_stok']; ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="ubah_barang.php?id_barang=<?= $data_barang['id_barang']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah</a>

                                        <a data-nama="Barang <?= $data_barang['nama_barang']; ?>" class="btn-delete btn btn-sm btn-danger" href="hapus_barang.php?id_barang=<?= $data_barang['id_barang']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once 'footer.php'; ?>
</div>
</div>
</body>
</html>
