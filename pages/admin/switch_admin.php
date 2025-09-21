<?php
include '../koneksi/koneksi.php';
session_start();
switch ($_GET['aksi']) {

//pengaduan 
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


    case 'status-decline':
        if (isset($_GET['id_pengaduan'])) {
    $id_pengaduan = $_GET['id_pengaduan'];

    // Update the status to "Approved"
    $query = "UPDATE pengaduan SET status='decline' WHERE id_pengaduan='$id_pengaduan'";
    $result = mysqli_query($config, $query);

    if ($result) {
        echo "<script>
                alert('Pengaduan telah ditolak!');
                window.location.href = 'lihat_pengaduan.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal memperbarui status!');
                window.location.href = 'lihat_pengaduan.php';
              </script>";
        exit();
    }
} else {
    echo "<script>
            alert('ID Pengaduan tidak ditemukan!');
            window.location.href = 'lihat_pengaduan.php';
          </script>";
    exit();
}
        break;
        //tanggapan
              //Lihat Tanggapan

case 'tanggapan-edit':
    $id_pengaduan = $_POST['id_pengaduan'];
    $tanggapan  = $_POST['tanggapan'];

    $query = mysqli_query($config, "UPDATE tanggapan 
                                    SET tanggapan = '$tanggapan' 
                                    WHERE id_pengaduan = '$id_pengaduan'");

    if ($query) {
        echo "<script>
        alert('Isi Tanggapan berhasil diedit');
        window.location.href = 'lihat_tanggapan.php';
        </script>";
    } else {
        echo "<script>
        alert('Gagal mengedit isi Tanggapan');
        window.location.href = 'lihat_tanggapan.php';
        </script>";
    }
    break;

    case 'tanggapan-hapus':
      $id_pengaduan = $_GET['id_pengaduan'];
      $query = mysqli_query($config, "DELETE FROM tanggapan WHERE id_pengaduan = '$id_pengaduan'");
      echo "<script>
         alert('Tanggapan berhasil dihapus');
         window.location.href = 'lihat_tanggapan.php';
      </script>";
      break;

   // UPDATE masyarakat
case 'update-masyarakat':
    $nik   = $_POST['nik'];
    $nama  = $_POST['nama'];
    $email = $_POST['email'];
    $telp  = $_POST['telp'];

    // cek apakah email sudah dipakai orang lain (selain dirinya sendiri)
    $query = mysqli_query($config, "SELECT * FROM masyarakat 
                                    WHERE email = '$email' 
                                    AND nik != '$nik'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        echo "<script>
        alert('Email $email sudah ada yang menggunakan, silahkan gunakan email yang berbeda');
        window.location.href = 'lihat_masyarakat.php';
        </script>";
    } else {
        mysqli_query($config, "UPDATE masyarakat SET 
                nama  = '$nama',
                email = '$email',
                telp  = '$telp'
                WHERE nik = '$nik'");
        echo "<script>
        alert('Data berhasil diupdate!');
        window.location.href = 'lihat_masyarakat.php';
        </script>";
    }
    break;


// TAMBAH masyarakat
case 'tambah-masyarakat':
    $nik      = $_POST['nik'];
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $password = md5($_POST['password']);
    $telp     = $_POST['telp'];

    // cek apakah nik atau email sudah dipakai
    $query = mysqli_query($config, "SELECT * FROM masyarakat 
                                    WHERE nik = '$nik' OR email = '$email'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        echo "<script>
        alert('NIK atau Email sudah ada yang menggunakan, silahkan gunakan yang berbeda');
        window.location.href = 'lihat_masyarakat.php';
        </script>";
    } else {
        mysqli_query($config, "INSERT INTO masyarakat (nik, nama, email, password, telp) 
                               VALUES('$nik', '$nama', '$email', '$password', '$telp')");
        echo "<script>
        alert('Data berhasil ditambahkan!');
        window.location.href = 'lihat_masyarakat.php';
        </script>";
    }
    break;


case 'hapus-masyarakat':
    $nik = $_GET['nik'];

    // ambil semua id_pengaduan milik masyarakat ini
    $res = mysqli_query($config, "SELECT id_pengaduan FROM pengaduan WHERE nik='$nik'");
    while ($row = mysqli_fetch_assoc($res)) {
        $id_pengaduan = $row['id_pengaduan'];
        mysqli_query($config, "DELETE FROM tanggapan WHERE id_pengaduan = '$id_pengaduan'");
    }

    // hapus semua pengaduan milik masyarakat
    mysqli_query($config, "DELETE FROM pengaduan WHERE nik = '$nik'");

    // hapus data masyarakat
    mysqli_query($config, "DELETE FROM masyarakat WHERE nik = '$nik'");

    echo "<script>
        alert('Pengguna berhasil dihapus');
        window.location.href = 'lihat_masyarakat.php';
    </script>";
    break;


      //petugas
case 'update-petugas':
    $id_petugas   = $_POST['id_petugas'];
    $nama_petugas = $_POST['nama_petugas'];
    $email        = $_POST['email'];
    $telp         = $_POST['telp'];
    $level        = $_POST['level'];

    // cek apakah email sudah dipakai oleh orang lain
    $query = mysqli_query($config, "SELECT * FROM petugas 
                                    WHERE email = '$email' 
                                    AND id_petugas != '$id_petugas'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        echo "<script>
        alert('Email $email sudah ada yang menggunakan, silahkan gunakan email yang berbeda');
        window.location.href = 'lihat_petugas.php';
        </script>";
    } else {
        mysqli_query($config, "UPDATE petugas SET 
                nama_petugas = '$nama_petugas',
                email        = '$email',
                telp         = '$telp',
                level        = '$level'
                WHERE id_petugas = '$id_petugas'");
        echo "<script>
        alert('Data berhasil diupdate!');
        window.location.href = 'lihat_petugas.php';
        </script>";
    }
    break;


    case 'tambah-petugas':
        
    $id_petugas      = $_POST['id_petugas'];
    $nama_petugas     = $_POST['nama_petugas'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $telp     = $_POST['telp'];
    $level    = $_POST['level'];

    // cek apakah email sudah dipakai oleh orang lain
    $query = mysqli_query($config, "SELECT * FROM petugas 
                                    WHERE email = '$email' 
                                    AND id_petugas != '$id_petugas'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        echo "<script>
        alert('Email $email sudah ada yang menggunakan, silahkan gunakan email yang berbeda');
        window.location.href = 'lihat_petugas.php';
        </script>";
    } else {
        mysqli_query($config, "INSERT INTO petugas VALUES('$id_petugas', '$nama_petugas', '$email', '$password', '$telp', '$level')");
        echo "<script>
        alert('Data berhasil ditambah!');
        window.location.href = 'lihat_petugas.php';
        </script>";
    }

    break;

      case 'hapus-petugas':
      $id_petugas = $_GET['id_petugas'];
      $query = mysqli_query($config, "DELETE FROM tanggapan WHERE id_petugas = '$id_petugas'");
      $acc = mysqli_query($config, "DELETE FROM petugas WHERE id_petugas = '$id_petugas'");

      echo "<script>
         alert('Petugas berhasil dihapus');
         window.location.href = 'lihat_petugas.php';
      </script>";
      break;
      
   }
   ?>