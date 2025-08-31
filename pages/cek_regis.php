<?php
session_start();
include "koneksi/koneksi.php";

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
   window.location.href = 'index.php';
   </script>";
   // kalo username nya gak ada di database maka registrasi berhasil
}
?>