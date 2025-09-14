<?php
include "../koneksi/koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/admin.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <script>
    UPLOADCARE_PUBLIC_KEY = '38882543888abfb41547';
    </script>
    <script src="https://ucarecdn.com/libs/widget/3.x/uploadcare.full.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@uploadcare/file-uploader@1/web/uc-file-uploader-regular.min.css">
    <title>Laporan Pengaduan</title>

    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn-container { margin-top: 20px; }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>

</head>
<body>
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
                        
                        <a href="lihat_pengaduan.php?aksi=lihat-pengaduan" class="nav__link">
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
			<a href="lihat_report.php" class="nav__link active">
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
            <h2>Laporan Pengaduan</h2>
            <table>
                <tr>
                    <th>ID Pengaduan</th>
                    <th>Tanggal</th>
                    <th>NIK</th>
                    <th>Isi Laporan</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Tanggapan</th>
                </tr>
                <?php
                $query = mysqli_query($config, "
                    SELECT p.id_pengaduan, p.tgl_pengaduan, p.nik, p.isi_laporan, p.foto, p.status, 
                        COALESCE(t.tanggapan, 'Belum ada tanggapan') AS tanggapan
                    FROM pengaduan p
                    LEFT JOIN tanggapan t ON p.id_pengaduan = t.id_pengaduan
                ");

                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>
                            <td>".$row['id_pengaduan']."</td>
                            <td>".$row['tgl_pengaduan']."</td>
                            <td>".$row['nik']."</td>
                            <td>".$row['isi_laporan']."</td>
                            <td>".$row['foto']."</td>
                            <td>".$row['status']."</td>
                            <td>".$row['tanggapan']."</td>
                        </tr>";
                }
                ?>
            </table>

            <div class="btn-container">
                <a href="admin.php" class="btn">Back to Admin Dashboard</a>
            </div>
        </div>

    </div>

    
 <script>
    window.print(); 
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/admin.js"></script>
</body>
</html>
