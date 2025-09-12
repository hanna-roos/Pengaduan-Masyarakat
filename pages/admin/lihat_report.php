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

<!DOCTYPE html>
<html>
<head>
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

    <script>
        window.print(); 
    </script>
</body>
</html>
