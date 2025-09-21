<?php
session_start();
include '../koneksi/koneksi.php';

switch ($_GET['aksi']) {

    // Tambah pengaduan
    case 'tambah-pengaduan':
        $tgl_pengaduan = $_POST['tgl_pengaduan'];
        $nik           = $_POST['nik'];
        $isi_laporan   = $_POST['isi_laporan'];
        $foto          = $_POST['foto'];
        
        // Default status = menunggu
        $status        = 'menunggu';

        $sql = "INSERT INTO pengaduan (tgl_pengaduan, nik, isi_laporan, foto, status) 
                VALUES ('$tgl_pengaduan', '$nik', '$isi_laporan', '$foto', '$status')";
        mysqli_query($config, $sql) or die(mysqli_error($config));

        echo "<script>
                alert('Pengaduan berhasil dikirim');
                window.location.href = 'masyarakat.php';
              </script>";
        break;

    // Edit pengaduan
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

    // Hapus pengaduan
    case 'hapus':
        $id_pengaduan = $_GET['id_pengaduan'];
        $query = mysqli_query($config, "DELETE FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'");
        echo "<script>
                alert('Pengaduan berhasil dihapus');
                window.location.href = 'lihat_pengaduan.php';
              </script>";
        break;

    // Edit tanggapan
    case 'tanggapan-edit':
        $id_pengaduan = $_POST['id_pengaduan'];
        $tanggapan    = $_POST['tanggapan'];

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

    // Hapus tanggapan
    case 'tanggapan-hapus':
        $id_pengaduan = $_GET['id_pengaduan'];
        $query = mysqli_query($config, "DELETE FROM tanggapan WHERE id_pengaduan = '$id_pengaduan'");
        echo "<script>
                alert('Tanggapan berhasil dihapus');
                window.location.href = 'lihat_tanggapan.php';
              </script>";
        break;

case 'status-decline':
    $id_pengaduan = $_GET['id_pengaduan'];
    $tanggapan    = $_GET['tanggapan'];
    $id_petugas   = $_SESSION['id_petugas']; 

    // Update pengaduan jadi Tidak Terima
    $sql = "UPDATE pengaduan 
            SET status = 'Tidak Terima' 
            WHERE id_pengaduan = '$id_pengaduan'";
    mysqli_query($config, $sql);

    // Insert tanggapan
    $sql2 = "INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas)
             VALUES ('$id_pengaduan', NOW(), '$tanggapan', '$id_petugas')";
    mysqli_query($config, $sql2);

    header("Location: lihat_pengaduan.php");
    break;


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

}
?>
