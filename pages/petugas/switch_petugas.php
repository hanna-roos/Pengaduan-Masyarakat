<?php
include '../koneksi/koneksi.php';
switch ($_GET['aksi']) {

    //lihat pengaduan
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
         window.location.href = 'lihat_pengaduan.php';
      </script>";
      break;
    
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

//pengaduan edit status

case 'status-accept':
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tanggapi'])) {
        $id_pengaduan = $_POST['id_pengaduan'];
        $tanggapan = mysqli_real_escape_string($config, $_POST['tanggapan']);
        $tgl_tanggapan = date('Y-m-d H:i:s');

        // Ambil id_petugas dari session
        $id_petugas = $_SESSION['id_petugas'];

        // Update status pengaduan
        $query_pengaduan = "UPDATE pengaduan SET status='accept' WHERE id_pengaduan='$id_pengaduan'";
        $result_pengaduan = mysqli_query($config, $query_pengaduan);

        // Masukkan tanggapan ke database
        $query_tanggapan = "INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) 
                            VALUES ('$id_pengaduan', '$tgl_tanggapan', '$tanggapan', '$id_petugas')";
        $result_tanggapan = mysqli_query($config, $query_tanggapan);

        if ($result_pengaduan && $result_tanggapan) {
            echo "<script>
                    alert('Tanggapan berhasil disimpan!');
                    window.location.href = 'petugas.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Gagal menyimpan tanggapan! Pastikan data valid.');
                    window.location.href = 'petugas.php';
                  </script>";
            exit();
        }
    }
    break;


    case 'status-decline':
        if (isset($_GET['id_pengaduan'])) {
    $id_pengaduan = $_GET['id_pengaduan'];

    // Update the status to "Approved"
    $query = "UPDATE pengaduan SET status='rejected' WHERE id_pengaduan='$id_pengaduan'";
    $result = mysqli_query($config, $query);

    if ($result) {
        echo "<script>
                alert('Pengaduan telah ditolak!');
                window.location.href = 'petugas_pengaduan.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal memperbarui status!');
                window.location.href = 'petugas_pengaduan.php';
              </script>";
        exit();
    }
} else {
    echo "<script>
            alert('ID Pengaduan tidak ditemukan!');
            window.location.href = 'petugas_pengaduan.php';
          </script>";
    exit();
}
        break;

    case 'update-masyarakat':
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
      
   }
   ?>