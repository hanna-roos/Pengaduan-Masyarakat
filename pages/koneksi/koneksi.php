<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "pengaduan_masyarakat";

$config = mysqli_connect($hostname, $username, $password, $database) or die ('Gagal terhubung ke server MySQL');
?>