<?php 
session_start();
include "../koneksi/koneksi.php";
if (!isset($_SESSION['username'])){
   // true
   echo "<script>
   alert('Anda belum Login, Silahkan Login Terlebih Dahulu!');
   window.location.href = '../index.php';
   </script>";
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/admin.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <script>
    UPLOADCARE_PUBLIC_KEY = '38882543888abfb41547';
    </script>
    <script src="https://ucarecdn.com/libs/widget/3.x/uploadcare.full.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@uploadcare/file-uploader@1/web/uc-file-uploader-regular.min.css">
</head>

<?php 
include "../koneksi/koneksi.php";

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

// hitung accepted
$accepted = mysqli_fetch_array(mysqli_query($config, "SELECT COUNT(*) AS total FROM pengaduan WHERE status='accept'"))['total'];
$pending  = mysqli_fetch_array(mysqli_query($config, "SELECT COUNT(*) AS total FROM pengaduan WHERE status='pending'"))['total'];
$decline  = mysqli_fetch_array(mysqli_query($config, "SELECT COUNT(*) AS total FROM pengaduan WHERE status='decline'"))['total'];


switch ($aksi) {
    default:
?>

<body>
    <!-- dashboard -->
    <div class="wrapper" id="body-pd">
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <div class="header__img">
                <img src="../../img/adminpetugas.png" alt="">
            </div>
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="admin.php" class="nav__logo">
                        <i class='bx bx-layer nav__logo-icon'></i>
                        <span class="nav__logo-name">Citizen</span>
                    </a>

                    <div class="nav__list">
                        <a href="admin.php" class="nav__link">
                        <i class='bx bx-grid-alt nav__icon' ></i>
                            <span class="nav__name">Dashboard</span>
                        </a>
                        
                        <a href="lihat_pengaduan.php?aksi=lihat-pengaduan" class="nav__link active">
                            <i class='bx bx-message-square-detail nav__icon' ></i>
                            <span class="nav__name">Lihat Pengaduan</span>
                        </a>

                        <a href="lihat_petugas.php?aksi=lihat-petugas" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Lihat Petugas</span>
                        </a>

                        <a href="lihat_masyarakat.php?aksi=lihat-masyarakat" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Lihat Masyarakat</span>
                        </a>
			            <a href="lihat_report.php" class="nav__link">
                            <i class='bx bx-file nav__icon' ></i>
                            <span class="nav__name">Laporan</span>
                        </a>

                    </div>
                </div>

                <a href="../logout.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <div class="main">
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 mb-5">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h1 class="text-center">
                                        Tampilan Data Pengaduan Masyarakat
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
                                            <td><?= $accepted; ?></td>
                                            <td><?= $pending; ?></td>
                                            <td><?= $decline; ?></td>
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
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['tgl_pengaduan'] ?></td>
                                            <td><?= $row['nik'] ?></td>
                                            <td><?= $row['isi_laporan'] ?></td>
                                            <td><?= $row['status'] ?></td>
                                            <td class="d-flex flex-column gap-2">
                                                <a href="petugas.php?aksi=status-accept&id_pengaduan=<?= $row['id_pengaduan'] ?>"
                                                    class="btn btn-success btn-sm w-100">Tanggapi</a>
                                                <a href="switch_petugas.php?aksi=status-decline&id_pengaduan=<?= $row['id_pengaduan'] ?>"
                                                    class="btn btn-danger btn-sm w-100">Decline</a>
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
    
    <?php
    break;
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/admin.js"></script>
</body>
</html>
