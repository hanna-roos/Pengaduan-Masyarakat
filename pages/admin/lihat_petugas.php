<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>

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
                                        Tampilan Data Petugas
                                    </h1>
                                </div>
                            </div>
                        </div>

                        <!-- Data Pengaduan -->
                        <div class="row">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Tambah Petugas
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Petugas</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form action="switch_admin.php?aksi=tambah-petugas" method="post">
                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label for="nama_petugas" class="form-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="nama_petugas"
                                                        placeholder="Isi Nama Lengkap Anda" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" name="username"
                                                        placeholder="Isi Username Anda" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="password"
                                                        placeholder="Isi Password Anda" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="telp" class="form-label">Telepon</label>
                                                    <input type="number" class="form-control" name="telp"
                                                        placeholder="Isi Telepon Anda" required>
                                                </div>


                                                <div class="form-group">
                                                    <label for="level">Anda adalah Seorang:</label>
                                                    <select id="level" name="level" class="form-select" required>
                                                        <option value="">Pilih</option>
                                                        <option value="petugas">Petugas</option>
                                                        <option value="admin">Admin</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="submit"
                                                    class="btn btn-success">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-bordered table-dark">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>ID Petugas</td>
                                            <td>Nama</td>
                                            <td>Username</td>
                                            <td>Password</td>
                                            <td>Telp</td>
                                            <td>Level</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($config, "SELECT * FROM petugas");
                                        $no = 1;
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $row['id_petugas'] ?></td>
                                            <td><?php echo $row['nama_petugas'] ?></td>
                                            <td><?php echo $row['username'] ?></td>
                                            <td><?php echo $row['password'] ?></td>
                                            <td><?php echo $row['telp'] ?></td>
                                            <td><?php echo $row['level'] ?></td>
                                            <td>
                                                <a href="admin.php?aksi=edit-petugas&id=<?= $row['id_petugas'] ?>"
                                                    class="btn btn-success btn-sm w-100">Edit</a>
                                                <a href="switch_admin.php?aksi=hapus-petugas&id_petugas=<?php echo $row['id_petugas'] ?>"
                                                    class="btn btn-danger">Hapus</a>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<script src="../../js/script.js"></script>

</html>