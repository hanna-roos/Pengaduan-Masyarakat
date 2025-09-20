<?php
include '../koneksi/koneksi.php';
session_start();

// Periksa apakah sesi tersedia
if (!isset($_SESSION['id_petugas']) && !isset($_SESSION['email'])) {
    header('location: ../index.php');
    exit();
}

$id_petugas = $_SESSION['id_petugas'];

// Ambil ID Petugas berdasarkan NIK
$query_petugas = "SELECT id_petugas FROM petugas WHERE id_petugas='$id_petugas'";
$result_petugas = mysqli_query($config, $query_petugas);

if (!$result_petugas || mysqli_num_rows($result_petugas) == 0) {
    die("Error: ID Petugas tidak valid.");
}

$data_petugas = mysqli_fetch_assoc($result_petugas);
$id_petugas = $data_petugas['id_petugas'];

// Ambil ID Pengaduan dari GET
$id_pengaduan = isset($_GET['id_pengaduan']) ? $_GET['id_pengaduan'] : '';

if (!$id_pengaduan) {
    die("Error: ID Pengaduan tidak valid.");
}


// Ambil data pengaduan
$pengaduan = mysqli_query($config, "SELECT * FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
$row = mysqli_fetch_array($pengaduan);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tanggapi'])) {
    $tanggapan = mysqli_real_escape_string($config, $_POST['tanggapan']);
    $tgl_tanggapan = date('Y-m-d H:i:s');

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
                window.location.href = 'lihat_pengaduan.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal menyimpan tanggapan! Pastikan data valid.');
                window.location.href = 'lihat_pengaduan.php';
              </script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Tanggapan</title>
</head>
<body>
    <div class="container-fluid">
        <div class="container mt-5 p-2 d-flex justify-content-center">
            <div class="card" style="width: 22rem;">
                <div class="card-body">
                    <h3 class="d-flex justify-content-center mb-3 mt-3">Tambah Tanggapan</h3>
                    <form action="" method="POST">
                        <input type="hidden" name="id_pengaduan" value="<?php echo htmlspecialchars($id_pengaduan); ?>">
                        <div class="mb-3">
                            <label for="tanggapan" class="form-label">Tanggapan</label>
                            <textarea class="form-control" name="tanggapan" id="tanggapan" rows="3" required></textarea>
                        </div>
                        <button type="submit" name="tanggapi" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
