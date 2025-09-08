<?php
include '../koneksi/koneksi.php';
switch ($_GET['aksi']) {
case 'tambah-pengaduan':
   $tgl_pengaduan       = $_POST['tgl_pengaduan'];
   $nik                 = $_POST['nik'];  // ambil dari form
   $isi_laporan         = $_POST['isi_laporan'];
   $foto                = $_POST['foto'];
   $status              = $_POST['status'];

   $sql = "INSERT INTO pengaduan (tgl_pengaduan, nik, isi_laporan, foto, status) 
           VALUES ('$tgl_pengaduan', '$nik', '$isi_laporan', '$foto', '$status')";
   mysqli_query($config, $sql) or die(mysqli_error($config));

   echo "<script>
   alert('Pengaduan berhasil dikirim');
   window.location.href = 'masyarakat.php';
   </script>";
   break;
   
case 'edit-pengaduan':
    $id_pengaduan = $_POST['id_pengaduan'];
    $isi_laporan  = $_POST['isi_laporan'];

    $query = mysqli_query($config, "UPDATE pengaduan 
                                    SET isi_laporan = '$isi_laporan' 
                                    WHERE id_pengaduan = '$id_pengaduan'");

    if ($query) {
        echo "<script>
        alert('Isi laporan berhasil diedit');
        window.location.href = 'masyarakat.php';
        </script>";
    } else {
        echo "<script>
        alert('Gagal mengedit isi laporan');
        window.location.href = 'masyarakat.php';
        </script>";
    }
    break;



      case 'hapus':
      $id_pengaduan = $_GET['id_pengaduan'];
      $query = mysqli_query($config, "DELETE FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'");
      echo "<script>
         alert('Pengaduan berhasil dihapus');
         window.location.href = 'masyarakat.php';
      </script>";
      break;

case 'update-status':
    $id_pengaduan = $_GET['id_pengaduan'];
    $status = $_GET['status']; // accepted / pending / decline

    $query = mysqli_query($config, "UPDATE pengaduan SET status='$status' WHERE id_pengaduan='$id_pengaduan'");

    if ($query) {
        echo "<script>
            alert('Status berhasil diupdate');
            window.location.href = 'petugas.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal update status');
            window.location.href = 'petugas.php';
        </script>";
    }
    break;

    case 'update-petugas':
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($config, "UPDATE masyarakat SET 
        nama='$nama', 
        username='$username', 
        password='$password' 
        WHERE nik='$nik'");

    if ($query) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href='lihat_masyarakat.php?aksi=lihat-masyarakat';</script>";
    } else {
        echo "<script>alert('Gagal update data'); window.location.href='lihat_masyarakat.php?aksi=lihat-masyarakat';</script>";
    }
    break;

    case 'tambah-petugas':
        
$nik      = $_POST['nik'];
$nama     = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$telp     = $_POST['telp'];

// mencari semua data username 
$query = mysqli_query($config, "SELECT * from masyarakat WHERE nik = '$nik'");
// menghitung jumlah baris query
$cek = mysqli_num_rows($query);


if($cek > 0){
   echo "<script>
   alert('NIK $nik sudah ada yang menggunakan, Silahkan Registrasi Kembali');
   window.location.href = 'regis.php';
   </script>";
   // kalo ada data dengan username tersebut maka akan disuru registrasi ulang
} else {
   mysqli_query($config, "INSERT INTO masyarakat VALUES('$nik', '$nama', '$username', '$password', '$telp')");
   echo "<script>
   alert('Data berhasil ditambahkan, Silahkan Login Kembali!');
   window.location.href = 'lihat_masyarakat.php';
   </script>";
   // kalo username nya gak ada di database maka registrasi berhasil
}
      
   }
   ?>