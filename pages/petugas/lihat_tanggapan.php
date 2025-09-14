<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Petugas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/petugas.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
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
                <img src="../../img/lol.png" alt="">
            </div>
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="petugas.php" class="nav__logo">
                        <i class='bx bx-layer nav__logo-icon'></i>
                        <span class="nav__logo-name">Citizen</span>
                    </a>

                    <div class="nav__list">
                        <a href="petugas.php" class="nav__link">
                        <i class='bx bx-grid-alt nav__icon' ></i>
                            <span class="nav__name">Dashboard</span>
                        </a>
                        
                        <a href="lihat_pengaduan.php?aksi=lihat-pengaduan" class="nav__link">
                            <i class='bx bx-message-square-detail nav__icon' ></i>
                            <span class="nav__name">Lihat Pengaduan</span>
                        </a>

                        <a href="lihat_tanggapan.php?aksi=lihat-tanggapan" class="nav__link active">
                            <i class='bx bx-bookmark nav__icon' ></i>
                            <span class="nav__name">Lihat Tanggapan</span>
                        </a>

                        <a href="lihat_masyarakat.php?aksi=lihat-masyarakat" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Lihat Masyarakat</span>
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
                        <!-- Data Pengaduan -->
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-bordered table-dark">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Tanggal Tanggapan</td>
                                            <td>ID Pengaduan</td>
                                            <td>Isi Tanggapan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = mysqli_query($config, "SELECT * FROM tanggapan");
                                            $no = 1;
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['tgl_tanggapan'] ?></td>
                                            <td><?= $row['id_pengaduan'] ?></td>
                                            <td><?= $row['tanggapan'] ?></td>
                                            <td class="d-flex flex-column gap-2">
                                                <a href="lihat_tanggapan.php?aksi=tanggapan-edit&id_pengaduan=<?= $row['id_pengaduan'] ?>"
                                                    class="btn btn-success btn-sm w-100">Edit</a>
                                                <a href="switch_petugas.php?aksi=tanggapan-hapus&id_pengaduan=<?= $row['id_pengaduan'] ?>"
                                                    class="btn btn-danger btn-sm w-100">Delete</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?php
                        break;

                        case 'tanggapan-edit' :
                            include '../koneksi/koneksi.php';
                             $id_pengaduan = $_GET['id_pengaduan'];
                             $query = mysqli_query($config, "SELECT * FROM tanggapan WHERE id_pengaduan = '$id_pengaduan'");
                             $row = mysqli_fetch_array($query);
                        ?>

                        <!-- edit pengaduan -->
                        <div class="container mt-5">
                            <form action="switch_petugas.php?aksi=tanggapan-edit" method="post">
                                <div class="card">
                                    <div class="card-header">Edit Pengaduan</div>

                                    <!-- hidden id_pengaduan -->
                                    <input type="hidden" name="id_pengaduan" value="<?= $row['id_pengaduan'] ?>">

                                    <div class="form-group mb-3 px-3">
                                        <label>Isi Laporan</label>
                                        <textarea class="form-control" name="tanggapan"
                                            rows="5"><?= $row['tanggapan'] ?></textarea>
                                    </div>

                                    <button class="btn btn-lg btn-primary">Simpan Tanggapan</button>
                                </div>
                            </form>
                        </div>
                        <!-- edit pengaduan -->
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
<script src="../../js/petugas.js"></script>
</body>
</html>