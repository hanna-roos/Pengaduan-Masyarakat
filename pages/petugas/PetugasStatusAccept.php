<?php
session_start();
include '../koneksi/koneksi.php';

// pastikan ada id_pengaduan di URL
if (!isset($_GET['id_pengaduan'])) {
    echo "<script>
            alert('ID Pengaduan tidak ditemukan!');
            window.location.href = 'lihat_pengaduan.php';
          </script>";
    exit();
}

$id_pengaduan = (int) $_GET['id_pengaduan'];
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
                    <form action="switch_petugas.php?aksi=status-accept" method="POST">
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
