<?php
session_start();
include "koneksi/koneksi.php";

$nik      = $_POST['nik'];
$nama     = $_POST['nama'];
$email    = $_POST['email'];
$password = md5($_POST['password']);
$telp     = $_POST['telp'];

// cek NIK
$queryNik = mysqli_query($config, "SELECT * FROM masyarakat WHERE nik = '$nik'");
$cekNik   = mysqli_num_rows($queryNik);

// cek Email
$queryEmail = mysqli_query($config, "SELECT * FROM masyarakat WHERE email = '$email'");
$cekEmail   = mysqli_num_rows($queryEmail);

if ($cekNik > 0) {
    echo "<script>
        alert('NIK $nik sudah digunakan, silahkan registrasi kembali!');
        window.location.href = 'regis.php';
    </script>";
} elseif ($cekEmail > 0) {
    echo "<script>
        alert('Email $email sudah digunakan, silahkan gunakan email lain!');
        window.location.href = 'regis.php';
    </script>";
} else {
    mysqli_query($config, "INSERT INTO masyarakat (nik, nama, email, password, telp) 
                           VALUES('$nik', '$nama', '$email', '$password', '$telp')");
    echo "<script>
        alert('Data berhasil ditambahkan, silahkan login kembali!');
        window.location.href = 'index.php';
    </script>";
}
?>
