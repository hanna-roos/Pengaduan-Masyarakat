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
$accepted = mysqli_fetch_array(mysqli_query($config, "SELECT COUNT(*) AS total FROM pengaduan WHERE status='accept'"))['total'];
$pending  = mysqli_fetch_array(mysqli_query($config, "SELECT COUNT(*) AS total FROM pengaduan WHERE status='pending'"))['total'];
$decline  = mysqli_fetch_array(mysqli_query($config, "SELECT COUNT(*) AS total FROM pengaduan WHERE status='decline'"))['total'];


switch ($aksi) {
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
                    <a href="lihat_masyarakat.php?aksi=lihat-masyarakat" class="sidebar-link">
                        <i class="lni lni-user-multiple-4"></i>
                        <span>Masyarakat</span>
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
