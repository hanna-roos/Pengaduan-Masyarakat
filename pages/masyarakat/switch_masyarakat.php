<?php
include '../koneksi/koneksi.php';
switch ($_GET['aksi']) {
case 'tambah-pengaduan':
   $tgl_pengaduan  = $_POST['tgl_pengaduan'];
   $id_masyarakat  = $_POST['id_masyarakat'];
   $nik            = $_POST['nik'];          // tambahin ini
   $isi_laporan    = $_POST['isi_laporan'];
   $foto           = $_POST['foto'];
   $status         = $_POST['status'];

   $sql = "INSERT INTO pengaduan (tgl_pengaduan, id_masyarakat, nik, isi_laporan, foto, status) 
           VALUES ('$tgl_pengaduan', '$id_masyarakat', '$nik', '$isi_laporan', '$foto', 'pending')";
   mysqli_query($config, $sql) or die(mysqli_error($config));

   echo "<script>
   alert('Pengaduan berhasil dikirim');
   window.location.href = 'masyarakat.php?aksi=lihat-pengaduan';
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
        window.location.href = 'masyarakat.php?aksi=lihat-pengaduan';
        </script>";
    } else {
        echo "<script>
        alert('Gagal mengedit isi laporan');
        window.location.href = 'masyarakat.php?aksi=lihat-pengaduan';
        </script>";
    }
    break;



case 'hapus':
    $id_pengaduan = $_GET['id_pengaduan'];

    // hapus dulu tanggapan yang terkait
    mysqli_query($config, "DELETE FROM tanggapan WHERE id_pengaduan = '$id_pengaduan'");

    // baru hapus pengaduan
    mysqli_query($config, "DELETE FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'");

    echo "<script>
        alert('Pengaduan berhasil dihapus');
        window.location.href = 'masyarakat.php';
    </script>";
    break;

case 'edit-profile':
    $id_masyarakat = $_POST['id_masyarakat'];
    $nik      = $_POST['nik'];
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $telp     = $_POST['telp'];

$query = mysqli_query($config, "SELECT * FROM masyarakat 
                                WHERE (nik = '$nik' OR email = '$email') 
                                AND id_masyarakat != '$id_masyarakat'");
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    echo "<script>
    alert('NIK atau Email sudah ada yang menggunakan, silahkan gunakan yang berbeda');
    window.location.href = '../masyarakat/masyarakat.php?aksi=edit-profile';
    </script>";
} else {
    mysqli_query($config, "UPDATE masyarakat SET 
        nik = '$nik',
        nama = '$nama',
        email = '$email',
        telp = '$telp'
        WHERE id_masyarakat = '$id_masyarakat'");

    echo "<script>
    alert('Profile berhasil di edit, tolong relogin jika mengubah email');
    window.location.href = '../masyarakat/masyarakat.php?aksi=edit-profile';
    </script>";
}


    break;
      
   }
   ?>