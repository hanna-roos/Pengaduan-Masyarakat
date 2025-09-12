<?php
include "../koneksi/koneksi.php";
session_start();
if (!isset($_SESSION['username']) == 'username'){
   // true
   echo "<script>
   alert('Anda belum Login, Silahkan Login Terlebih Dahulu!');
   window.location.href = '../index.php';
   </script>";
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masyarakat</title>
    <link rel="stylesheet" href="../../css/masyarakat.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <script>
    UPLOADCARE_PUBLIC_KEY = '38882543888abfb41547';
    </script>
    <script src="https://ucarecdn.com/libs/widget/3.x/uploadcare.full.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@uploadcare/file-uploader@1/web/uc-file-uploader-regular.min.css">
</head>
<?php 
include "../koneksi/koneksi.php";

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

switch ($aksi) {
    default:
        // ================= DASHBOARD =================
        ?>

<body id="body-pd">
    <div class="wrapper">
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <div class="header__img">
                <img src="assets/img/perfil.jpg" alt="">
            </div>
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="masyarakat.php" class="nav__logo">
                        <i class='bx bx-layer nav__logo-icon'></i>
                        <span class="nav__logo-name">Citizen</span>
                    </a>

                    <div class="nav__list">
                        <a href="masyarakat.php" class="nav__link active">
                        <i class='bx bx-grid-alt nav__icon' ></i>
                            <span class="nav__name">Dashboard</span>
                        </a>
                        
                        <a href="masyarakat.php?aksi=tambah-pengaduan" class="nav__link">
                            <i class='bx bx-message-square-detail nav__icon' ></i>
                            <span class="nav__name">Submit Pengaduan</span>
                        </a>

                        <a href="masyarakat.php?aksi=lihat-pengaduan" class="nav__link">
                            <i class='bx bx-bookmark nav__icon' ></i>
                            <span class="nav__name">Lihat Tanggapan</span>
                        </a>

                        <a href="masyarakat.php?aksi=edit-profile" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Profile</span>
                        </a>
                    </div>
                </div>

                <a href="logout.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <div class="container" style="margin-top: 60px;">
            <div class="container-fluid welcome">
                <h1 class="hero-text">Selamat Datang, <?php echo $_SESSION['username'] ?> 👋</h1>
                <p class="text-hero">Sampaikan pengaduan Anda dan bantu kami menciptakan perubahan.</p>
           
                <!-- data -->
                <div class="row data" style="margin-top: 35px;">
                    <div class="col-sm-12 col-md-4 col-xl-4 dataa">
                        <div class="card py-4 px-4">
                            <h5>Total Pengaduan</h5>
                            <div class="d-flex justify-content-between">
                                <span class="num" data-val="237">000</span>
                                <i class='bx bxs-file'></i>
                            </div>
                            <p> <span>↗ +12 </span> bulan ini </p>
                        </div>
                    </div>
                     <div class="col-sm-12 col-md-4 col-xl-4 dataa">
                        <div class="card py-3 px-3">
                            <h5>Pengaduan Diproses</h5>
                            <div class="d-flex justify-content-between">
                                <span class="num" data-val="34">00</span>
                                <i class='bx bxs-time'></i>
                            </div>
                            <p> <span>↗ +5 </span> bulan ini </p>
                        </div>
                    </div>
                     <div class="col-sm-12 col-md-4 col-xl-4 dataa">
                        <div class="card py-3 px-3">
                            <h5>Pengaduan Selesai</h5>
                            <div class="d-flex justify-content-between">
                                <span class="num" data-val="98">00</span>
                                <i class='bx bxs-check-circle'></i>
                            </div>
                            <p> <span>↗ +8 </span> bulan ini </p>
                        </div>
                    </div>

                </div>

                <!-- aksi cepat -->
                <div class="row aksi py-3 px-3" style="margin-top: 35px;">
                    <h3>Aksi Cepat</h3>
                    <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <div class="card">
                            <button>
                                <a href=""><i class='bx bx-plus'></i>Buat Pengaduan</a>
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <div class="card">
                            <button>
                                <a href=""><i class='bx bx-send'></i>Tanya CiMin</a>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- tampil data pengaduan -->
                <div class="container pengaduann" style="margin-top: 35px;">
                        <div class="pengaduan py-3 px-3">
                            <h3>Daftar Pengaduan</h3>
                            <div class="search d-flex">
                                <input type="text" name="seacrh" placeholder="Cari pengaduan...">
                                <i class='bx bx-search'></i>
                            </div>
                        </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Tanggal Pengaduan</td>
                                <td>NIK</td>
                                <td>Isi Laporan</td>
                                <td>Foto</td>
                                <td>Status</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>                                           
                        <tbody>
                            <?php
                            include '../koneksi/koneksi.php';
                            $nik = $_SESSION['nik'];
                            $query = mysqli_query($config, "SELECT * FROM pengaduan WHERE nik = '$nik'");
                            $no = 1;
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['tgl_pengaduan'] ?></td>
                                    <td><?php echo $row['nik'] ?></td>
                                    <td><?php echo $row['isi_laporan'] ?></td>
                                    <td><img src="<?= $row['foto'] ?>" alt="foto" width="100" height="100"></td>
                                    <td><?php echo $row['status'] ?></td>
                                    <td>
                                        <a href="masyarakat.php?aksi=edit-pengaduan&id_pengaduan=<?php echo $row['id_pengaduan'] ?>" 
                                                                                    class="bx bx-edit-alt edit"></a>
                                        <a href="switch_masyarakat.php?aksi=hapus&id_pengaduan=<?php echo $row['id_pengaduan'] ?>" 
                                                                                    class="bx bx-trash hps"></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                </div> <!-- end table-responsive -->
                        

                <!-- informasi penting -->
                <div class="row informasi" style="margin-top: 35px;">
                    <h3>Informasi Penting</h3>
                    <div class="col-sm-12 col-md-7 col-xl-8">
                         <div class="timeline">
                            <!-- Item 1 -->
                            <div class="timeline-item">
                            <div class="card p-3">
                                <h5 class="fw-bold">Cara Membuat Pengaduan</h5>
                                <p class="text-muted mb-2">Klik tombol "Buat Pengaduan" dan isi formulir secara lengkap sesuai dengan permasalahan yang Anda alami. Pastikan untuk menuliskan kronologi kejadian dengan jelas, sertakan alamat atau lokasi kejadian, serta bukti pendukung berupa foto atau dokumen yang relevan agar tim dapat melakukan verifikasi dengan cepat. Semakin detail informasi yang Anda berikan, semakin mudah pengaduan Anda diproses dan ditindaklanjuti sesuai ketentuan yang berlaku.</p>
                                <!-- <span class="status status-done">Завершен</span> -->
                            </div>
                            </div>

                            <!-- Item 2 -->
                            <div class="timeline-item">
                            <div class="card p-3">
                                <h5 class="fw-bold">Estimasi Waktu Penyelesaian</h5>
                                <p class="text-muted mb-2">Setiap pengaduan yang masuk akan diverifikasi terlebih dahulu oleh tim kami sebelum diteruskan ke instansi terkait. Proses ini biasanya membutuhkan waktu sekitar 3 hingga 7 hari kerja, tergantung tingkat kerumitan kasus yang diajukan. Selama proses berlangsung, Anda akan menerima notifikasi secara berkala melalui SMS dan email, mulai dari tahap verifikasi, tindak lanjut, hingga penyelesaian akhir. Dengan begitu, Anda dapat memantau perkembangan status pengaduan tanpa perlu menunggu lama atau khawatir kehilangan informasi penting.</p>
                                <!-- <span class="status status-done">Завершен</span> -->
                            </div>
                            </div>

                            <!-- Item 3 -->
                            <div class="timeline-item">
                            <div class="card p-3">
                                <h5 class="fw-bold">Kontak Darurat</h5>
                                <p class="text-muted mb-2">Jika Anda mengalami kondisi mendesak yang membutuhkan penanganan cepat, segera hubungi hotline darurat di 0800-1234-5678 atau kirim pesan WhatsApp ke 0812-3456-7890. Layanan darurat ini tersedia 24 jam setiap hari, termasuk hari libur, sehingga Anda tetap bisa mendapatkan bantuan kapan pun dibutuhkan. Tim kami siap memberikan respons cepat, baik untuk pengaduan terkait keamanan, gangguan fasilitas umum, maupun kebutuhan mendesak lainnya. Jangan ragu untuk menghubungi kami agar permasalahan Anda dapat segera ditangani.</p>
                                <!-- <span class="status status-progress">Начат: 13.06.2023</span> -->
                            </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-5 col-xl-4">
                        <div class="row d-flex">
                           <div class="col-sm-12 col-md-12">
                                <div class="card py-3 px-3 statistik" style="border: none; outline: none; background: white; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.252);">
                                    <h3>Statistik Bulanan</h3>
                                      <div class="d-flex align-items-center mb-3 bulan">
                                        <div class="month mt-3">Apr</div>
                                            <div class="flex-grow-1 mx-3">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span>Total: 61</span>
                                                    <span>Selesai: 53</span>
                                                </div>
                                                <div class="progress" style="height: 9px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 84%;" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                            <div class="percentage mt-4">87%</div>
                                      </div>
                                      <div class="d-flex align-items-center mb-3 bulan">
                                        <div class="month mt-3">Mei</div>
                                            <div class="flex-grow-1 mx-3">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span>Total: 58</span>
                                                    <span>Selesai: 49</span>
                                                </div>
                                                <div class="progress" style="height: 9px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 84%;" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                            <div class="percentage mt-4">84%</div>
                                      </div>
                                      <div class="d-flex align-items-center mb-3 bulan">
                                        <div class="month mt-3">Jun</div>
                                            <div class="flex-grow-1 mx-3">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span>Total: 67</span>
                                                    <span>Selesai: 58</span>
                                                </div>
                                                <div class="progress" style="height: 9px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 84%;" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                            <div class="percentage mt-4">84%</div>
                                      </div>
                                      <div class="d-flex align-items-center mb-3 bulan">
                                        <div class="month mt-3">Jul</div>
                                            <div class="flex-grow-1 mx-3">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span>Total: 67</span>
                                                    <span>Selesai: 58</span>
                                                </div>
                                                <div class="progress" style="height: 9px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 84%;" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                            <div class="percentage mt-4">84%</div>
                                      </div>
                                      <div class="d-flex align-items-center mb-3 bulan">
                                        <div class="month mt-3">Agu</div>
                                            <div class="flex-grow-1 mx-3">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span>Total: 67</span>
                                                    <span>Selesai: 58</span>
                                                </div>
                                                <div class="progress" style="height: 9px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 84%;" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                            <div class="percentage mt-4">84%</div>
                                      </div>
                                </div>
                            </div>
                             <div class="col-sm-12 col-md-12">
                                <div class="card py-3 px-3" style="border: none; outline: none; background: white; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.252);">
                                    <h3>Kategori Pengaduan</h3>
                                    <div class="d-flex align-items-center mb-2 kategori" >
                                        <div class="rounded-circle bg-primary mt-3" style="width:16px; height:16px; margin-right:10px;"></div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span class="fw-medium">Pelayanan Publik</span>
                                                    <span class="text-muted">120 pengaduan</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" 
                                                    aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                        <div class="small fw-medium text-muted ms-3 mt-3">70%</div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 kategori">
                                        <div class="rounded-circle bg-primary mt-3" style="width:16px; height:16px; margin-right:10px;"></div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span class="fw-medium">Infrastruktur</span>
                                                    <span class="text-muted">120 pengaduan</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" 
                                                    aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                        <div class="small fw-medium text-muted ms-3 mt-3">70%</div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 kategori">
                                        <div class="rounded-circle bg-primary mt-3" style="width:16px; height:16px; margin-right:10px;"></div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span class="fw-medium">Kebersihan</span>
                                                    <span class="text-muted">120 pengaduan</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" 
                                                    aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                        <div class="small fw-medium text-muted ms-3 mt-3">70%</div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2 kategori">
                                        <div class="rounded-circle bg-primary mt-3" style="width:16px; height:16px; margin-right:10px;"></div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span class="fw-medium">Kebersihan</span>
                                                    <span class="text-muted">120 pengaduan</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" 
                                                    aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                        <div class="small fw-medium text-muted ms-3 mt-3">70%</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- activity lately -->
                <div class="container aktivitas d-flex flex-column py-4 px-3">
                    <h3>Aktivitas Terbaru</h3>
                    <div class="akt-1 d-flex mt-2 ms-2">
                        <i class='bx bx-plus' style="margin-top: 2px;"></i>
                        <div class="d-flex flex-column ms-2">
                            <p class="akt-tit">Pengaduan baru diterima</p>
                            <p class="akt-body" style="margin-top: -13px;">2 menit yang lalu</p>
                        </div>
                    </div>
                    <div class="akt-1 d-flex mt-2 ms-2">
                        <i class='bx bx-time-five' style="margin-top: 2px;"></i>
                        <div class="d-flex flex-column ms-2">
                            <p class="akt-tit">Status pengaduan #156 diubah menjadi "Selesai"</p>
                            <p class="akt-body" style="margin-top: -13px;">15 menit yang lalu</p>
                        </div>
                    </div>
                    <div class="akt-1 d-flex mt-2 ms-2">
                        <i class='bx bx-send' style="margin-top: 2px;"></i>
                        <div class="d-flex flex-column ms-2">
                            <p class="akt-tit">Tanggapan diterima untuk pengaduan #142</p>
                            <p class="akt-body" style="margin-top: -13px;">1 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="akt-1 d-flex mt-2 ms-2">
                        <i class='bx bx-check-circle' style="margin-top: 2px;"></i>
                        <div class="d-flex flex-column ms-2">
                            <p class="akt-tit">Pengaduan #138 telah diselesaikan</p>
                            <p class="akt-body" style="margin-top: -13px;">2 jam yang lalu</p>
                        </div>
                    </div>
                    <hr>
                    <a href="#">Lihat semua aktivitas →</a>
                </div>
                
            </div>
        </div>
      
</body>


<!-- tambah pengaduan -->
<?php
        break;

    case 'tambah-pengaduan':
    include '../koneksi/koneksi.php';
    $nik = $_SESSION['nik'];
    $query = mysqli_query($config, "SELECT * FROM masyarakat WHERE nik = '$nik'");
    $row = mysqli_fetch_array($query);
        ?>

<div class="container py-3" id="body-pd">
        <!-- sidebar -->
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <div class="header__img">
                <img src="assets/img/perfil.jpg" alt="">
            </div>
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="masyarakat.php" class="nav__logo">
                        <i class='bx bx-layer nav__logo-icon'></i>
                        <span class="nav__logo-name">Citizen</span>
                    </a>

                    <div class="nav__list">
                        <a href="masyarakat.php" class="nav__link">
                        <i class='bx bx-grid-alt nav__icon' ></i>
                            <span class="nav__name">Dashboard</span>
                        </a>
                      
                        <a href="masyarakat.php?aksi=tambah-pengaduan" class="nav__link active">
                            <i class='bx bx-message-square-detail nav__icon' ></i>
                            <span class="nav__name">Submit Pengaduan</span>
                        </a>

                        <a href="masyarakat.php?aksi=lihat-pengaduan" class="nav__link">
                            <i class='bx bx-bookmark nav__icon' ></i>
                            <span class="nav__name">Lihat Tanggapan</span>
                        </a>

                        <a href="masyarakat.php?aksi=edit-profile" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Profile</span>
                        </a>
                    </div>
                </div>

                <a href="logout.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <!-- content -->
        <div class="container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-xl-6 panduan">
                        <h3>💡 Panduan Melapor yang Baik</h3>
                        <p>Tips supaya laporan cepat diproses:</p>
                        <ul>
                            <li><p>Jika memungkinkan, unggah foto atau dokumen yang mendukung laporan Anda. Misalnya foto jalan rusak, lampu mati, atau tumpukan sampah.</p></li>
                            <li><p>Sertakan alamat, RT/RW, atau patokan jelas di sekitar lokasi. Ini memudahkan tim petugas untuk menemukan titik masalah.</p></li>
                            <li><p>Hindari singkatan yang sulit dipahami. Gunakan kalimat singkat, padat, dan jelas.</p></li>
                            <li><p>Pastikan kategori laporan, deskripsi, dan kontak Anda benar, agar memudahkan proses tindak lanjut.</p></li>
                            <li><p>ika sudah melapor, cukup tunggu proses. Laporan ganda bisa memperlambat penanganan.</p></li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 estimasi">
                        <h3>⏳ Estimasi Waktu Proses</h3>
                        <p>Setiap pengaduan diperlakukan dengan serius, namun butuh waktu agar penanganan lebih tepat.</p>
                        <ul>
                            <li><p>Verifikasi Awal: 1-2 hari kerja</p></li>
                            <li><p>Proses Peninjauan: 3-7 hari kerja (tergantung kompleksitas masalah)</p></li>
                            <li><p>Update Status: Anda akan mendapat notifikasi melalui email/SMS/dashboard Citizen</p></li>
                            <li><p>Tindak Lanjut: Jika membutuhkan koordinasi antar instansi, proses bisa lebih lama, namun kami akan memberikan informasi perkembangan secara berkala.</p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- form tambah pengaduan -->
        <form action="switch_masyarakat.php?aksi=tambah-pengaduan" method="post">
            <div class="card tambah py-4 px-3" style="border-radius: 15px;">
                <h3>Silahkan isi form pengaduan berikut.</h3>
                <p class="subtext">Laporkan keluhan, saran, atau permasalahan yang anda alami. 
                    Laporan anda akan ditangani oleh pihak berwenang secepat mungkin.</p>

                <div class="info-box">
                    <i class='bx bx-info-circle'></i> 
                    Pastikan data yang anda masukkan benar dan jelas.
                </div>

                <div class="form-group mb-3 px-3 mt-2">
                    <label>Tanggal Pengaduan</label>
                    <input class="form-control" type="text" name="tgl_pengaduan" value="<?php echo date('Y/m/d'); ?>" readonly />
                </div>
                <div class="form-group mb-3 px-3">
                    <label>NIK</label>
                    <input type="text" class="form-control" name="nik" value="<?= $row['nik']; ?>"/>
                </div>
                <div class="form-group mb-3 px-3">
                    <label>Isi Laporan</label>
                    <textarea class="form-control" name="isi_laporan" placeholder="Tuliskan laporan anda di sini..." style="height: 100px"></textarea>
                </div>
                <div class="form-group mb-3 px-3">
                    <label>Foto</label><br>
                    <input type="hidden" name="foto" role="uploadcare-uploader" data-public-key="38882543888abfb41547" data-images-only />
                </div>
                <div class="form-group mb-3 px-3">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="pending">Pending</option>
                    </select>
                </div>
                <button class="btn btn-lg btn-primary mt-4">Kirim Laporan</button>
                <p class="note">⚡ Data anda dijamin aman dan rahasia.</p>
            </div>
        </form>
</div>

<!-- edit pengaduan -->
<?php
        break;

    case 'edit-pengaduan':
    include '../koneksi/koneksi.php';
    $id_pengaduan = $_GET['id_pengaduan'];
    $query = mysqli_query($config, "SELECT * FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'");
    $row = mysqli_fetch_array($query);
?>
<div class="container mt-5">
        <!-- sidebar -->
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <div class="header__img">
                <img src="assets/img/perfil.jpg" alt="">
            </div>
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="masyarakat.php" class="nav__logo">
                        <i class='bx bx-layer nav__logo-icon'></i>
                        <span class="nav__logo-name">Citizen</span>
                    </a>

                    <div class="nav__list">
                        <a href="masyarakat.php" class="nav__link">
                        <i class='bx bx-grid-alt nav__icon' ></i>
                            <span class="nav__name">Dashboard</span>
                        </a>
                      
                        <a href="masyarakat.php?aksi=tambah-pengaduan" class="nav__link active">
                            <i class='bx bx-message-square-detail nav__icon' ></i>
                            <span class="nav__name">Submit Pengaduan</span>
                        </a>

                        <a href="masyarakat.php?aksi=lihat-pengaduan" class="nav__link">
                            <i class='bx bx-bookmark nav__icon' ></i>
                            <span class="nav__name">Lihat Tanggapan</span>
                        </a>

                        <a href="masyarakat.php?aksi=edit-profile" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Profile</span>
                        </a>
                    </div>
                </div>

                <a href="logout.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <form action="switch_masyarakat.php?aksi=edit-pengaduan" method="post">
          <div class="card tambah py-4 px-3">
            <h3>Silahkan edit form pengaduan berikut.</h3>
                <p class="subtext">Laporkan keluhan, saran, atau permasalahan yang anda alami. 
                    Laporan anda akan ditangani oleh pihak berwenang secepat mungkin.</p>

                <div class="info-box">
                    <i class='bx bx-info-circle'></i> 
                    Pastikan isi laporan yang anda masukkan benar dan jelas.
                </div>
                <!-- hidden id_pengaduan -->
                <input type="hidden" name="id_pengaduan" value="<?= $row['id_pengaduan'] ?>">

                <div class="form-group mb-3 px-3">
                    <label>Isi Laporan</label>
                    <textarea class="form-control" name="isi_laporan" placeholder="Tuliskan laporan anda di sini..." style="height: 100px"></textarea>
                </div>

                <button class="btn btn-lg btn-primary">Simpan Laporan</button>

            </div>
        </form>
</div>

<!-- edit profile -->
<?php
    break;
?>
<<<<<<< HEAD

=======
<div class="container mt-5">
        <!-- sidebar -->
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <div class="header__img">
                <img src="assets/img/perfil.jpg" alt="">
            </div>
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="masyarakat.php" class="nav__logo">
                        <i class='bx bx-layer nav__logo-icon'></i>
                        <span class="nav__logo-name">Citizen</span>
                    </a>

                    <div class="nav__list">
                        <a href="masyarakat.php" class="nav__link">
                        <i class='bx bx-grid-alt nav__icon' ></i>
                            <span class="nav__name">Dashboard</span>
                        </a>
                      
                        <a href="masyarakat.php?aksi=tambah-pengaduan" class="nav__link">
                            <i class='bx bx-message-square-detail nav__icon' ></i>
                            <span class="nav__name">Submit Pengaduan</span>
                        </a>

                        <a href="masyarakat.php?aksi=lihat-pengaduan" class="nav__link">
                            <i class='bx bx-bookmark nav__icon' ></i>
                            <span class="nav__name">Lihat Tanggapan</span>
                        </a>

                        <a href="masyarakat.php?aksi=edit-profile" class="nav__link active">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Profile</span>
                        </a>
                    </div>
                </div>

                <a href="logout.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <form action="switch_masyarakat.php?aksi=edit-profile" method="post">
            <div class="card">
                <div class="card-header">Your Profile</div>
                <div class="form-group mb-3 px-3">
                    <label>NIK</label>
                    <input type="text" class="form-control" name="nik_baru" value="<?=$row['nik']?>">
                    <input type="hidden" name="nik_lama" value="<?=$row['nik']?>">
                </div>
                <div class="form-group mb-3 px-3">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?=$row['nama']?>">
                </div>
                <div class="form-group mb-3 px-3">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="<?=$row['username']?>">
                </div>
                <div class="form-group mb-3 px-3">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" value="<?=$row['password']?>">
                </div>
                <div class="form-group mb-3 px-3">
                    <label>Telp</label>
                    <input type="text" class="form-control" name="telp" value="<?=$row['telp']?>">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="masyarakat.php" class="btn btn-danger">Kembali</a>
            </div>
        </form>
</div>

<!-- lihat tanggapan -->
>>>>>>> 7ca424a09afe4511ff92337421de1c56d24a1c08
<?php
case 'lihat-pengaduan':
    include '../koneksi/koneksi.php';

    // ambil NIK dari session
    $nik = $_SESSION['nik'];

    // ambil data pengaduan + tanggapan hanya untuk user login
    $query = mysqli_query($config, "
        SELECT pengaduan.id_pengaduan, pengaduan.isi_laporan, pengaduan.foto, pengaduan.status,
               tanggapan.tanggapan, tanggapan.tgl_tanggapan
        FROM pengaduan
        LEFT JOIN tanggapan 
        ON tanggapan.id_pengaduan = pengaduan.id_pengaduan
        WHERE pengaduan.nik = '$nik'
    ");

    ?>
    <div class="container lihat mt-5" id="body-pd">
        <!-- sidebar -->
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <div class="header__img">
                <img src="assets/img/perfil.jpg" alt="">
            </div>
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="masyarakat.php" class="nav__logo">
                        <i class='bx bx-layer nav__logo-icon'></i>
                        <span class="nav__logo-name">Citizen</span>
                    </a>

                    <div class="nav__list">
                        <a href="masyarakat.php" class="nav__link">
                        <i class='bx bx-grid-alt nav__icon' ></i>
                            <span class="nav__name">Dashboard</span>
                        </a>
                      
                        <a href="masyarakat.php?aksi=tambah-pengaduan" class="nav__link">
                            <i class='bx bx-message-square-detail nav__icon' ></i>
                            <span class="nav__name">Submit Pengaduan</span>
                        </a>

                        <a href="masyarakat.php?aksi=lihat-pengaduan" class="nav__link active">
                            <i class='bx bx-bookmark nav__icon' ></i>
                            <span class="nav__name">Lihat Tanggapan</span>
                        </a>

                        <a href="masyarakat.php?aksi=edit-profile" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Profile</span>
                        </a>
                    </div>
                </div>

                <a href="logout.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <!-- tampilkan tanggapan -->
        <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Tanggal Pengaduan</td>
                                <td>NIK</td>
                                <td>Isi Laporan</td>
                                <td>Foto</td>
                                <td>Status</td>
                            </tr>
                        </thead>                                           
                        <tbody>
                            <?php
                            include '../koneksi/koneksi.php';
                            $nik = $_SESSION['nik'];
                            $query = mysqli_query($config, "SELECT * FROM pengaduan WHERE nik = '$nik'");
                            $no = 1;
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['tgl_pengaduan'] ?></td>
                                    <td><?php echo $row['nik'] ?></td>
                                    <td><?php echo $row['isi_laporan'] ?></td>
                                    <td><img src="<?= $row['foto'] ?>" alt="foto" width="100" height="100"></td>
                                    <td><?php echo $row['status'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
        </div>
    <?php
    break;

    ?>

    <?php

}
?>

    <script src="../../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</html>