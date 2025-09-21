<?php
session_start();
include '../koneksi/koneksi.php';

switch ($_GET['aksi']) {

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
            SET status = 'decline' 
            WHERE id_pengaduan = '$id_pengaduan'";
    mysqli_query($config, $sql);

    // Insert tanggapan
    $sql2 = "INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas)
             VALUES ('$id_pengaduan', NOW(), '$tanggapan', '$id_petugas')";
    mysqli_query($config, $sql2);

    header("Location: lihat_pengaduan.php");
    break;

case 'update-masyarakat':
    $id_masyarakat = $_POST['id_masyarakat']; // tambahkan hidden input di form edit
    $nik   = $_POST['nik'];
    $nama  = $_POST['nama'];
    $email = $_POST['email'];
    $telp  = $_POST['telp'];

    // cek apakah email sudah dipakai orang lain (selain dirinya sendiri)
    $query = mysqli_query($config, "SELECT * FROM masyarakat 
                                    WHERE email = '$email' 
                                    AND id_masyarakat != '$id_masyarakat'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        echo "<script>
        alert('Email $email sudah ada yang menggunakan, silahkan gunakan email yang berbeda');
        window.location.href = 'lihat_masyarakat.php';
        </script>";
    } else {
        mysqli_query($config, "UPDATE masyarakat SET 
                nik   = '$nik',
                nama  = '$nama',
                email = '$email',
                telp  = '$telp'
                WHERE id_masyarakat = '$id_masyarakat'");
        echo "<script>
        alert('Data berhasil diupdate!');
        window.location.href = 'lihat_masyarakat.php';
        </script>";
    }
    break;



// TAMBAH masyarakat
case 'tambah-masyarakat':
    $id_masyarakat = $_POST ['id_masyarakat'];
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
    $id_masyarakat = $_GET['id_masyarakat'];

    // ambil semua id_pengaduan milik masyarakat ini
    $res = mysqli_query($config, "SELECT id_pengaduan FROM pengaduan WHERE id_masyarakat='$id_masyarakat'");
    while ($row = mysqli_fetch_assoc($res)) {
        $id_pengaduan = $row['id_pengaduan'];
        mysqli_query($config, "DELETE FROM tanggapan WHERE id_pengaduan = '$id_pengaduan'");
    }

    // hapus semua pengaduan milik masyarakat
    mysqli_query($config, "DELETE FROM pengaduan WHERE id_masyarakat='$id_masyarakat'");

    // hapus data masyarakat
    mysqli_query($config, "DELETE FROM masyarakat WHERE id_masyarakat='$id_masyarakat'");

    echo "<script>
        alert('Pengguna berhasil dihapus');
        window.location.href = 'lihat_masyarakat.php';
    </script>";
    break;

}
?>
