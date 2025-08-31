<?php
session_start();
include "koneksi/koneksi.php";

$username   = $_POST['username'];
$password   = md5($_POST['password']);

if(isset($_POST['level'])){
    $level = $_POST['level'];

    if ($level == "masyarakat") {
        $select = "SELECT * FROM masyarakat WHERE username = '$username' AND password = '$password'";
    } else if ($level == "petugas") {
        $select = "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'";
    }

    $result = mysqli_query($config, $select);
    $cek    = mysqli_num_rows($result);

    if($cek > 0) {
        $data = mysqli_fetch_assoc($result);

        if ($level == 'masyarakat') {
            $_SESSION['username'] = $data['username'];
            $_SESSION['nik'] = $data['nik'];
            $_SESSION['level']    = 'masyarakat';
            echo "<script>
                alert('Anda berhasil login sebagai masyarakat');
                window.location.href = '../pages/masyarakat/masyarakat.php';
            </script>";
        } else if ($level == 'petugas') {
            $_SESSION['username']   = $data['username'];
            $_SESSION['id_petugas'] = $data['id_petugas'];
            $_SESSION['level']      = 'petugas';
            echo "<script>
                alert('Anda berhasil login sebagai petugas');
                window.location.href = '../pages/petugas/petugas.php';
            </script>";
        }

    } else {
        echo "<script>
            alert('Username atau password salah!');
            window.location.href = 'index.php?gagal-login';
        </script>";
    }

} else {
    echo "<script>
        alert('Anda harus memilih level!');
        window.location.href = 'index.php?gagal-login';
    </script>";
}

?>