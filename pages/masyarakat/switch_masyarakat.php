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

    case 'edit-profile':
    $nik_lama = $_POST['nik_lama']; // NIK asli dari database (hidden input)
    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $telp     = $_POST['telp'];

    // Cek apakah NIK baru sudah dipakai user lain (selain dirinya sendiri)
    $query = mysqli_query($config, "SELECT * FROM masyarakat WHERE nik = '$nik_baru' AND nik != '$nik_lama'");
    if(mysqli_num_rows($query) > 0){
        echo "<script>
        alert('NIK $nik_baru sudah dipakai orang lain');
        window.location.href = '../masyarakat/masyarakat.php?aksi=edit-profile';
        </script>";
    } else {
        // Update data
        mysqli_query($config, "UPDATE masyarakat SET 
            nama = '$nama',
            username = '$username',
            telp = '$telp'
            WHERE nik = '$nik_lama'");

        echo "<script>
        alert('Data berhasil di edit');
        window.location.href = '../masyarakat/masyarakat.php?aksi=edit-profile';
        </script>";
    }
break;
      
   }
   ?>