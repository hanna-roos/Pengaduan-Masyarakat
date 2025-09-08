<!-- <?php
include "../koneksi/koneksi.php";
if(!isset($_SESSION['username']) == 'username'){
   echo "<script>
   alert('Anda Belum Login, Silahkan Login terlebih dahulu');
   window.location.href = '../index.php';
   </script>";
}
?> -->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Petugas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/petugas.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css" />

    <script>
    UPLOADCARE_PUBLIC_KEY = '38882543888abfb41547';
    </script>
    <script src="https://ucarecdn.com/libs/widget/3.x/uploadcare.full.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@uploadcare/file-uploader@1/web/uc-file-uploader-regular.min.css">
</head>

<?php 
session_start();
include "../koneksi/koneksi.php";

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

// hitung accepted
$accepted = mysqli_fetch_array(mysqli_query($config, "SELECT COUNT(*) AS total FROM pengaduan WHERE status='Dicatat'"))['total'];
$pending  = mysqli_fetch_array(mysqli_query($config, "SELECT COUNT(*) AS total FROM pengaduan WHERE status='Menunggu'"))['total'];
$decline  = mysqli_fetch_array(mysqli_query($config, "SELECT COUNT(*) AS total FROM pengaduan WHERE status='Tidak Terima'"))['total'];


switch ($aksi) {
    case 'edit-masyarakat':
    $id = $_GET['id'];
    $query = mysqli_query($config, "SELECT * FROM masyarakat WHERE nik='$id'");
    $data = mysqli_fetch_array($query);
?>

<div class="container mt-5">
    <h2>Edit Data Masyarakat</h2>
    <form method="POST" action="switch_admin.php?aksi=update-masyarakat">
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
        <a href="lihat_masyarakat.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php
    break;

    default:
?>

<body>
    <!-- dashboard -->
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button id="toggle-btn" type="button" class="toggle-btn">
                    <i class="lni lni-dashboard-square-1"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="admin.php">Admin</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="admin.php" class="sidebar-link">
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
                    <a href="lihat_petugas.php?aksi=lihat-petugas" class="sidebar-link">
                        <i class="lni lni-user-multiple-4"></i>
                        <span>Petugas</span>
                    </a>
                </li>
               <li class="sidebar-item">
                    <a href="lihat_masyarakat.php?aksi=lihat-masyarakat" class="sidebar-link">
                        <i class="lni lni-user-multiple-4"></i>
                        <span>Masyarakat</span>
                    </a>
                </li>
                    <li class="sidebar-item">
                    <a href="lihat_report.php" class="sidebar-link">
                        <i class="lni lni-user-multiple-4"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Dashboard Admin</a>
                </div>
            </nav>
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 mb-5">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h1 class="text-center">
                                        Selamat Datang di Dashboard Admin!
                                    </h1>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Count Accepted, Pending, Decline -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <table class="table table-striped table-bordered table-dark text-center">
                                    <thead>
                                        <tr>
                                            <td class="text-success">Accepted</td>
                                            <td class="text-warning">Pending</td>
                                            <td class="text-danger">Decline</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $accepted; ?></td>
                                            <td><?php echo $pending; ?></td>
                                            <td><?php echo $decline; ?></td>
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
                                            <td>Foto</td>
                                            <td>Tanggal Laporan</td>
                                            <td>NIK</td>
                                            <td>Isi Laporan</td>
                                            <td>Status</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($config, "SELECT * FROM pengaduan");
                                        $no = 1;
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><img src="<?php echo $row['foto']; ?>" width="70"></td>
                                            <td><?php echo $row['tgl_pengaduan'] ?></td>
                                            <td><?php echo $row['nik'] ?></td>
                                            <td><?php echo $row['isi_laporan'] ?></td>
                                            <td><?php echo $row['status'] ?></td>
                                            <td class="d-flex flex-column gap-2">
                                                <a href="switch_admin.php?aksi=update-status&id_pengaduan=<?= $row['id_pengaduan'] ?>&status=Dicatat" class="btn btn-success btn-sm w-100">Accept</a>
                                                <a href="switch_admin.php?aksi=update-status&id_pengaduan=<?= $row['id_pengaduan'] ?>&status=Menunggu" class="btn btn-warning btn-sm w-100">Pending</a>
                                                <a href="switch_admin.php?aksi=update-status&id_pengaduan=<?= $row['id_pengaduan'] ?>&status=Tidak Terima" class="btn btn-danger btn-sm w-100">Decline</a>
                                            </td>
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
</body>

<?php
    break;
}
?>

</html>
