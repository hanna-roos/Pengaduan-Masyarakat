<?php 
session_start();
include "../koneksi/koneksi.php";
if (!isset($_SESSION['username']) == 'username'){
   // true
   echo "<script>
   alert('Anda belum Login, Silahkan Login Terlebih Dahulu!');
   window.location.href = '../index.php';
   </script>";
};

// hitung accepted, pending, decline
$pengaduan = mysqli_fetch_array(mysqli_query($config, "SELECT COUNT(*) AS total FROM pengaduan "))['total'];
$tanggapan  = mysqli_fetch_array(mysqli_query($config, "SELECT COUNT(*) AS total FROM tanggapan "))['total'];


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Petugas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/petugas.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css" />
</head>

    <?php
    include "../koneksi/koneksi.php";
    $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
    switch ($aksi) {
    
    // ================= DEFAULT (DASHBOARD) =================
    default:

    ?>

<body>
    <div class="wrapper">
                <aside id="sidebar">
            <div class="d-flex">
                <button id="toggle-btn" type="button" class="toggle-btn">
                    <i class="lni lni-dashboard-square-1"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="petugas.php">Petugas</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="petugas.php" class="sidebar-link">
                        <i class="lni lni-home-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="lihat_pengaduan.php?aksi=lihat-pengaduan" class="sidebar-link">
                        <i class="lni lni-shield-2-check"></i>
                        <span>Lihat Pengaduan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="lihat_tanggapan.php?aksi=lihat-tanggapan" class="sidebar-link">
                        <i class="lni lni-shield-2-check"></i>
                        <span>Lihat Tanggapan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="lihat_masyarakat.php?aksi=lihat-masyarakat" class="sidebar-link">
                        <i class="lni lni-user-multiple-4"></i>
                        <span>Masyarakat</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="../logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Dashboard Petugas</a>
                </div>
            </nav>
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 mb-5">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h1 class="text-center">Selamat Datang di Dashboard Petugas!</h1>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Count Accepted, Pending, Decline -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <table class="table table-striped table-bordered table-dark text-center">
                                    <thead>
                                        <tr>
                                            <td class="text-success">Pengaduan</td>
                                            <td class="text-warning">Tanggapan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $pengaduan; ?></td>
                                            <td><?= $tanggapan; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Data Pengaduan -->
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-bordered table-dark">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Tanggal Laporan</td>
                                            <td>NIK</td>
                                            <td>Isi Laporan</td>
                                            <td>Foto</td>
                                            <td>Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = mysqli_query($config, "SELECT * FROM pengaduan ORDER BY tgl_pengaduan DESC LIMIT 5");
                                            $no = 1;
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['tgl_pengaduan'] ?></td>
                                            <td><?= $row['nik'] ?></td>
                                            <td><?= $row['isi_laporan'] ?></td>
                                            <td><img src="<?= $row['foto']; ?>" width="70"></td>
                                            <td><?= $row['status'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Data Pengaduan -->
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-bordered table-dark">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>ID Tanggapan</td>
                                            <td>ID Pengaduan</td>
                                            <td>Tanggal Tanggapan</td>
                                            <td>Tanggapan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = mysqli_query($config, "SELECT * FROM tanggapan ORDER BY tgl_tanggapan DESC LIMIT 5");
                                            $no = 1;
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['id_tanggapan'] ?></td>
                                            <td><?= $row['id_pengaduan'] ?></td>
                                            <td><?= $row['tgl_tanggapan'] ?></td>
                                            <td><?= $row['tanggapan'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php
        break;
         // ================= EDIT MASYARAKAT =================
    case 'edit-masyarakat':
        $id = $_GET['id'];
        $query = mysqli_query($config, "SELECT * FROM masyarakat WHERE nik='$id'");
        $data = mysqli_fetch_array($query);
        ?>
    <div class="container mt-5">
        <h2>Edit Data Masyarakat</h2>
        <form method="POST" action="switch_petugas.php?aksi=update-masyarakat">
            <input type="hidden" name="nik" value="<?= $data['nik'] ?>">
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="text" name="password" class="form-control" value="<?= $data['password'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="petugas.php?aksi=lihat-masyarakat" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <?php
    break;
    
    case 'status-accept':
        $id_pengaduan = $_GET['id_pengaduan'];
        $pengaduan = mysqli_query($config, "SELECT * FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
        $row = mysqli_fetch_array($pengaduan);
                // ================= STATUS ACCEPT (TAMBAH TANGGAPAN) =================
        ?>


    <div class="container-fluid">
        <div class="container mt-5 p-2 d-flex justify-content-center">
            <div class="card" style="width: 22rem;">
                <div class="card-body">
                    <h3 class="d-flex justify-content-center mb-3 mt-3">Tambah Tanggapan</h3>
                    <form action="switch_petugas.php?aksi=status-accept" method="POST">
                        <input type="hidden" name="id_pengaduan" value="<?= $row['id_pengaduan']; ?>">
                        <div class="mb-3">
                            <label for="tanggapan" class="form-label">Tanggapan</label>
                            <textarea class="form-control" name="tanggapan" id="tanggapan" rows="3" required></textarea>
                        </div>
                        <button type="submit" name="tanggapi" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    break;
}
?>

</body>

</html>