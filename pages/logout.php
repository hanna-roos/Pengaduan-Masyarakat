<?php

include 'koneksi/koneksi.php';

session_start();
session_unset();
session_destroy();

header('location:index.php');

?>
session_start();
session_destroy();


echo "<script>
        alert('Anda berhasil logout');
        window.location.href = 'index.php';
    </script>";
exit();
