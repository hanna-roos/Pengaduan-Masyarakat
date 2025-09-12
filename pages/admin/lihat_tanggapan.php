<?php
include "../koneksi/koneksi.php";
session_start();
?>


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
include "../koneksi/koneksi.php";

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

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
                    <a href="lihat_tanggapan.php?aksi=lihat-tanggapan" class="sidebar-link">
                        <i class="lni lni-shield-2-check"></i>
                        <span>Lihat Tanggapan</span>
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
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 mb-5">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h1 class="text-center">
                                        Tampilan Data Tanggapan Petugas
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
                                            <td>isi laporan</td>
                                            <td>ID Petugas</td>
                                            <td>Isi Tanggapan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include '../koneksi/koneksi.php';
                                        
                                            $query = mysqli_query($config, "SELECT * FROM tanggapan JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan");

                                            $no = 1;
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['tgl_tanggapan'] ?></td>
                                            <td><?= $row['id_pengaduan'] ?></td>
                                            <td><?= $row['isi_laporan'] ?></td>
                                            <td><?= $row['id_petugas'] ?></td>
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
</body>

<?php
    break;
}
?>

</html>