<?php
include "../koneksi/koneksi.php";
if(!isset($_SESSION['username']) == 'username'){
   echo "<script>
   alert('Anda Belum Login, Silahkan Login terlebih dahulu');
   window.location.href = '../index.php';
   </script>";
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Petugas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
                    <i class="lni lni-dashboard-square-1"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="masyarakat.php">Citizen</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="masyarakat.php" class="sidebar-link">
                        <i class="lni lni-home-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="masyarakat.php?aksi=tambah-pengaduan" class="sidebar-link">
                        <i class="lni lni-shield-2-check"></i>
                        <span>Submit Pengaduan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="masyarakat.php?aksi=lihat-pengaduan" class="sidebar-link">
                        <i class="lni lni-shield-2-check"></i>
                        <span>Lihat Pengaduan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="masyarakat.php?aksi=edit-profile" class="sidebar-link">
                        <i class="lni lni-user-4"></i>
                        <span>Profile</span>
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
                  $query = mysqli_query($config, "SELECT * FROM pengaduan");
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
                <input type="text" class="form-control" name="nik">
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
                    <option value="0">0</option>
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

}
?>

</html>

<?php