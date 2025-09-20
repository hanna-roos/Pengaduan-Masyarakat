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


//pengaduan edit status

case 'status-accept':

    $id_petugas = $_SESSION['id_petugas'];

     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tanggapi'])) {
            $id_pengaduan   = isset($_POST['id_pengaduan']) ? (int) $_POST['id_pengaduan'] : 0;
            $tanggapan_raw  = $_POST['tanggapan'] ?? '';
            $tanggapan      = mysqli_real_escape_string($config, $tanggapan_raw);
            $tgl_tanggapan  = date('Y-m-d H:i:s');

            if ($id_pengaduan <= 0 || $tanggapan === '') {
                echo "<script>
                        alert('Data tidak lengkap. Pastikan id pengaduan dan tanggapan terisi.');
                        window.location.href = 'lihat_pengaduan.php';
                      </script>";
                break;
            }

            // Update status pengaduan
            $query_pengaduan = "UPDATE pengaduan SET status='accept' WHERE id_pengaduan='$id_pengaduan'";
            $result_pengaduan = mysqli_query($config, $query_pengaduan);

            // Insert tanggapan with a valid id_petugas from SESSION
            $query_tanggapan = "INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) 
                                VALUES ('$id_pengaduan', '$tgl_tanggapan', '$tanggapan', '$id_petugas')";
            $result_tanggapan = mysqli_query($config, $query_tanggapan);

            if ($result_pengaduan && $result_tanggapan) {
                echo "<script>
                        alert('Tanggapan berhasil disimpan!');
                        window.location.href = 'lihat_pengaduan.php';
                      </script>";
            } else {
                // Show the DB error so you can see if it's FK or something else
                $err = addslashes(mysqli_error($config));
                echo "<script>
                        alert('Gagal menyimpan tanggapan! $err');
                        window.location.href = 'lihat_pengaduan.php';
                      </script>";
            }
        } else {
            // If someone hits this route without POST form
            header('Location: lihat_pengaduan.php');
        }
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

    //masyarakat
    case 'update-masyarakat':
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($config, "UPDATE masyarakat SET 
        nama='$nama', 
        email='$email', 
        password='$password' 
        WHERE nik='$nik'");

    if ($query) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href='lihat_masyarakat.php?';</script>";
    } else {
        echo "<script>alert('Gagal update data'); window.location.href='lihat_masyarakat.php';</script>";
    }
    break;

    case 'tambah-masyarakat':
        
$nik      = $_POST['nik'];
$nama     = $_POST['nama'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$telp     = $_POST['telp'];

// mencari semua data email 
$query = mysqli_query($config, "SELECT * from masyarakat WHERE nik = '$nik'");
// menghitung jumlah baris query
$cek = mysqli_num_rows($query);


if($cek > 0){
   echo "<script>
   alert('NIK $nik sudah ada yang menggunakan, Silahkan menggunakan NIK yang berbeda');
   window.location.href = 'lihat_masyarakat.php';
   </script>";
   // kalo ada data dengan email tersebut maka akan disuru registrasi ulang
} else {
   mysqli_query($config, "INSERT INTO masyarakat VALUES('$nik', '$nama', '$email', '$password', '$telp')");
   echo "<script>
   alert('Data berhasil ditambahkan');
   window.location.href = 'lihat_masyarakat.php';
   </script>";
   // kalo email nya gak ada di database maka registrasi berhasil
}

      case 'hapus-masyarakat':
      $nik = $_GET['nik'];
      $query = mysqli_query($config, "DELETE FROM pengaduan WHERE nik = '$nik'");
      $acc = mysqli_query($config, "DELETE FROM masyarakat WHERE nik = '$nik'");

      echo "<script>
         alert('Pengguna berhasil dihapus');
         window.location.href = 'lihat_masyarakat.php';
      </script>";
      break;

      //petugas
    case 'update-petugas':
    $id_petugas = $_POST['id_petugas'];
    $nama_petugas = $_POST['nama_petugas'];
    $email = $_POST['email'];
    $password = $_POST['password'];
     $telp = $_POST['telp'];
     $level = $_POST['level'];

    $query = mysqli_query($config, "UPDATE petugas SET 
        nama_petugas='$nama_petugas', 
        email='$email', 
        password ='$password',
        telp='$telp', level='$level' 
        WHERE id_petugas='$id_petugas'");

    if ($query) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href='lihat_petugas.php?';</script>";
    } else {
        echo "<script>alert('Gagal update data'); window.location.href='lihat_petugas.php';</script>";
    }
    break;

    case 'tambah-petugas':
        
$id_petugas      = $_POST['id_petugas'];
$nama_petugas     = $_POST['nama_petugas'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$telp     = $_POST['telp'];
$level    = $_POST['level'];

// mencari semua data email 
$query = mysqli_query($config, "SELECT * from petugas WHERE id_petugas = '$id_petugas'");
// menghitung jumlah baris query
$cek = mysqli_num_rows($query);


if($cek > 0){
   echo "<script>
   alert('email $email sudah ada yang menggunakan, Silahkan menggunakan email yang berbeda');
   window.location.href = 'lihat_petugas.php';
   </script>";
   // kalo ada data dengan email tersebut maka akan disuru registrasi ulang
} else {
   mysqli_query($config, "INSERT INTO petugas VALUES('$id_petugas', '$nama_petugas', '$email', '$password', '$telp', '$level')");
   echo "<script>
   alert('Data berhasil ditambahkan');
   window.location.href = 'lihat_petugas.php';
   </script>";
   // kalo email nya gak ada di database maka registrasi berhasil
}

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