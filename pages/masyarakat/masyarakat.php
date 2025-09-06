<?php
session_start(); 

include "../koneksi/koneksi.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['nik'])) {
    echo "<script>
        alert('Anda Belum Login, Silahkan Login terlebih dahulu');
        window.location.href = '../index.php';
    </script>";
    exit;
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masyarakat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    

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
        // ================= DASHBOARD =================
        ?>

<body>
    <!-- dashboard -->
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button id="toggle-btn" type="button" class="toggle-btn">
                    <i class="bi bi-columns-gap"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="masyarakat.php">Citizen</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="masyarakat.php" class="sidebar-link">
                        <i class="bi bi-house"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="masyarakat.php?aksi=tambah-pengaduan" class="sidebar-link">
                        <i class="bi bi-send"></i>
                        <span>Submit Pengaduan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="masyarakat.php?aksi=lihat-pengaduan" class="sidebar-link">
                        <i class="bi bi-eye"></i>
                        <span>Lihat Tanggapan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="masyarakat.php?aksi=edit-profile" class="sidebar-link">
                        <i class="bi bi-person-circle"></i>
                        <span>Profile</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="logout.php" class="sidebar-link">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">User Dashboard</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h1>
                                        Selamat Datang di Dashboard <?php echo $_SESSION['username']; ?>!
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped columns table-bordered table-dark">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Tanggal Pengaduan</td>
                                            <td>NIK</td>
                                            <td>Isi Laporan</td>
                                            <td>Foto</td>
                                            <td>Status</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                  // fungsi include untuk menyisipkan file koneksi.php
                  include '../koneksi/koneksi.php';
      
                  // fungsi dari mysqli_query untuk mengambil data sql yang ada di database
                  // fungsi mysqli_fetch_array untuk mengambil data menggunakan angka atau nama field
                  // fungsi mysqli_fetch_assoc untuk mengambil data menggunakan nama field
                  // fungsi mysqli_fetch_rows untuk mengambil data menggunakan angka field
                  $nik = $_SESSION['nik'];
                  $query = mysqli_query($config, "SELECT * FROM pengaduan WHERE nik = '$nik'");
                  $no = 1;
                  while ($row = mysqli_fetch_array($query)) {
                     ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $row['tgl_pengaduan'] ?></td>
                                            <td><?php echo $row['nik'] ?></td>
                                            <td><?php echo $row['isi_laporan'] ?></td>
                                            <td><?php echo $row['foto'] ?></td>
                                            <td><?php echo $row['status'] ?></td>
                                            <td>
                                                <a href="masyarakat.php?aksi=edit-pengaduan&id_pengaduan=<?php echo $row['id_pengaduan'] ?>"
                                                    class="btn btn-primary">Edit</a>
                                                <a href="switch_masyarakat.php?aksi=hapus&id_pengaduan=<?php echo $row['id_pengaduan'] ?>"
                                                    class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                        <?php
                  }
                  ?>
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

    case 'tambah-pengaduan':
    include '../koneksi/koneksi.php';
    $nik = $_SESSION['nik'];
    $query = mysqli_query($config, "SELECT * FROM masyarakat WHERE nik = '$nik'");
    $row = mysqli_fetch_array($query);
        ?>
<!-- tambah data -->
<div class="container mt-5">
    <form action="switch_masyarakat.php?aksi=tambah-pengaduan" method="post">
        <div class="card">
            <div class="card-header">Tambah Pengaduan</div>
            <div class="form-group mb-3 px-3">
                <label>Tanggal Pengaduan</label>
                <input class="form-control" type="text" name="tgl_pengaduan" value="<?php echo date('Y/m/d'); ?>"
                    readonly />
            </div>
            <div class="form-group mb-3 px-3">
                <label>NIK</label>
                <input type="text" class="form-control" name="nik" value="<?= $row['nik']; ?>"/>
            </div>
            <div class="form-group mb-3 px-3">
                <label>Isi Laporan</label>
                <input type="text" class="form-control" name="isi_laporan">
            </div>
            <div class="form-group mb-3 px-3">
                <label>Foto</label><br>
                <input type="hidden" name="foto" role="uploadcare-uploader" data-public-key="38882543888abfb41547"
                    data-images-only />
            </div>
            <div class="form-group mb-3 px-3">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="pending">Pending</option>
                </select>
            </div>
            <button class="btn btn-lg btn-primary" id="">Kirim Laporan</button>
        </div>
    </form>
</div>
<!-- tambah data -->
<?php
        break;

    case 'edit-pengaduan':
    include '../koneksi/koneksi.php';
    $id_pengaduan = $_GET['id_pengaduan'];
    $query = mysqli_query($config, "SELECT * FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'");
    $row = mysqli_fetch_array($query);
?>
<!-- edit pengaduan -->
<div class="container mt-5">
    <form action="switch_masyarakat.php?aksi=edit-pengaduan" method="post">
        <div class="card">
            <div class="card-header">Edit Pengaduan</div>

            <!-- hidden id_pengaduan -->
            <input type="hidden" name="id_pengaduan" value="<?= $row['id_pengaduan'] ?>">

            <div class="form-group mb-3 px-3">
                <label>Isi Laporan</label>
                <textarea class="form-control" name="isi_laporan" rows="5"><?= $row['isi_laporan'] ?></textarea>
            </div>

            <button class="btn btn-lg btn-primary">Simpan Laporan</button>
        </div>
    </form>
</div>
<!-- edit pengaduan -->
<?php
    break;

   case 'edit-profile':
    include '../koneksi/koneksi.php';
    $nik = $_SESSION['nik'];
    $query = mysqli_query($config, "SELECT * FROM masyarakat WHERE nik = '$nik'");
    $row = mysqli_fetch_array($query);
?>
<div class="container mt-5">
    <form action="switch_masyarakat.php?aksi=edit-profile" method="post">
        <div class="card">
            <div class="card-header">Your Profile</div>
            <div class="form-group mb-3 px-3">
                <label>NIK</label>
                <input type="text" class="form-control" name="nik_baru" value="<?=$row['nik']?>">
                <input type="hidden" name="nik_lama" value="<?=$row['nik']?>">
            </div>
            <div class="form-group mb-3 px-3">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" value="<?=$row['nama']?>">
            </div>
            <div class="form-group mb-3 px-3">
                <label>Username</label>
                <input type="text" class="form-control" name="username" value="<?=$row['username']?>">
            </div>
            <div class="form-group mb-3 px-3">
                <label>Password</label>
                <input type="text" class="form-control" name="password" value="<?=$row['password']?>">
            </div>
            <div class="form-group mb-3 px-3">
                <label>Telp</label>
                <input type="text" class="form-control" name="telp" value="<?=$row['telp']?>">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="masyarakat.php" class="btn btn-danger">Kembali</a>
        </div>
    </form>
</div>
<?php
break;
case 'lihat-pengaduan':
    include '../koneksi/koneksi.php';

    // ambil NIK dari session
    $nik = $_SESSION['nik'];

    // ambil data pengaduan + tanggapan hanya untuk user login
    $query = mysqli_query($config, "
        SELECT pengaduan.id_pengaduan, pengaduan.isi_laporan, pengaduan.foto, pengaduan.status,
               tanggapan.tanggapan, tanggapan.tgl_tanggapan
        FROM pengaduan
        LEFT JOIN tanggapan 
        ON tanggapan.id_pengaduan = pengaduan.id_pengaduan
        WHERE pengaduan.nik = '$nik'
    ");

    ?>
    <div class="container mt-5">
        <h1 class="fw-bold">Tampil Tanggapan</h1>
        <a href="masyarakat.php">Kembali</a>
        <table class="table table-striped table-bordered table-dark">
            <thead>
                <tr>
                    <td>No</td>
                    <td>ID Pengaduan</td>
                    <td>Isi Laporan</td>
                    <td>Foto</td>
                    <td>Tanggapan</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['id_pengaduan'] ?></td>
                        <td><?= $row['isi_laporan'] ?></td>
                        <td><img src="<?= $row['foto'] ?>" alt="foto" width="100"></td>
                        <td><?= $row['tanggapan'] ? $row['tanggapan'] : '<span class="text-warning">Belum ditanggapi</span>' ?></td>
                        <td><?= $row['status'] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    break;

    ?>

    <?php

}
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="../../js/script.js"></script>

</html>