<?php
session_start();
include "koneksi/koneksi.php";

$email     = $_POST['email'];
$password  = md5($_POST['password']); // ⚠️ later change to password_hash
$level     = $_POST['level'] ?? '';

if ($level == "masyarakat" && empty($_POST['nik'])) {
    echo "<script>
        alert('NIK wajib diisi!');
        window.location.href = 'index.php?gagal-login';
    </script>";
    exit;
}
if (($level == "petugas" || $level == "admin") && empty($_POST['id_petugas'])) {
    echo "<script>
        alert('ID Petugas wajib diisi!');
        window.location.href = 'index.php?gagal-login';
    </script>";
    exit;
}

if ($level == "masyarakat") {
    $nik = $_POST['nik']; // only masyarakat needs NIK
    $select = "SELECT * FROM masyarakat WHERE email = '$email' AND password = '$password' AND nik = '$nik'";
} elseif ($level == "petugas") {
    $id_petugas = $_POST['id_petugas']; // only petugas needs ID Petugas
    $select = "SELECT * FROM petugas WHERE email = '$email' AND password = '$password' AND id_petugas = '$id_petugas'";
} elseif ($level == "admin") {
    $id_petugas = $_POST['id_petugas']; // admin also comes from petugas table
    $select = "SELECT * FROM petugas WHERE email = '$email' AND password = '$password' AND id_petugas = '$id_petugas'";
} else {
    echo "<script>
        alert('Anda harus memilih level!');
        window.location.href = 'index.php?gagal-login';
    </script>";
    exit;
}

$result = mysqli_query($config, $select);
$cek    = mysqli_num_rows($result);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($result);

    if ($level == 'masyarakat') {
        $_SESSION['email'] = $data['email'];
        $_SESSION['nik']   = $data['nik'];
        $_SESSION['level'] = 'masyarakat';
        echo "<script>
            alert('Anda berhasil login sebagai masyarakat');
            window.location.href = '../pages/masyarakat/masyarakat.php';
        </script>";
    } elseif ($level == 'petugas') {
        $_SESSION['email']      = $data['email'];
        $_SESSION['id_petugas'] = $data['id_petugas'];
        $_SESSION['level']      = 'petugas';
        echo "<script>
            alert('Anda berhasil login sebagai petugas');
            window.location.href = '../pages/petugas/petugas.php';
        </script>";
    } else {
        $_SESSION['email']      = $data['email'];
        $_SESSION['id_petugas'] = $data['id_petugas'];
        $_SESSION['level']      = 'admin';
        echo "<script>
            alert('Anda berhasil login sebagai admin');
            window.location.href = '../pages/admin/admin.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Email, password, atau ID/NIK anda salah!');
        window.location.href = 'index.php?gagal-login';
    </script>";
}
?>
