<?php
include "../koneksi/koneksi.php";
session_start();
if (!isset($_SESSION['username'])){
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

<body>
<div id="body-pd">
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <div class="header__img">
                <img src="../../img/lol.png" alt="">
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

                <a href="../logout.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <div class="container" style="margin-top: 65px;">
            <div class="container-fluid welcome">
                <h1 class="hero-text">Selamat Datang, <?php echo $_SESSION['username'] ?> 👋</h1>
                <p class="text-hero">Sampaikan pengaduan Anda dan bantu kami menciptakan perubahan.</p>
           
                <!-- data -->
                <div class="row data" style="margin-top: 30px;">
                    <div class="col-sm-12 col-md-4 col-xl-4 dataa">
                        <div class="card py-4 px-4">
                            <div class="d-flex justify-content-between">
                            <h5 class="px-3 py-3">Total Pengaduan</h5>
                            <i class='bx bxs-file'></i>
                        </div>
                                <span class="num px-3" data-val="237">000</span>
                            <p class="px-3"> <span>↗ +12 </span> bulan ini </p>
                        </div>
                    </div>
                     <div class="col-sm-12 col-md-4 col-xl-4 mt-3 mt-md-0 dataa">
                        <div class="card py-3 px-3">
                            <div class="d-flex justify-content-between">
                            <h5 class="px-3 py-3">Pengaduan Diproses</h5>
                            <i class='bx bxs-time text-danger'></i>
                        </div>
                                <span class="num px-3" data-val="34">00</span>
                            <p class="px-3"> <span>↗ +5 </span> bulan ini </p>
                        </div>
                    </div>
                     <div class="col-sm-12 col-md-4 col-xl-4 mt-3 mt-md-0 dataa">
                        <div class="card py-3 px-3">
                            <div class="d-flex justify-content-between">
                                <h5 class="px-3 py-3">Pengaduan Selesai</h5>
                                <i class='bx bxs-check-circle text-primary'></i>
                            </div>
                                <span class="num px-3" data-val="98">00</span>
                            <p class="px-3"> <span>↗ +8 </span> bulan ini </p>
                        </div>
                    </div>

                </div>

                <!-- aksi cepat -->
                <div class="row aksii py-3 px-2" style="margin-top: 20px;">
                    <div class="card aksi py-4 px-3" style="display: flex; justify-content: center">
                        <h3>Akses Cepat ke Layanan Utama</h3>
                        <div class="d-flex justify-content-center gap-3 mt-3">
                            <button class="w-100" style="background: #1f2937;">
                                <a href="masyarakat.php?aksi=tambah-pengaduan"><i class='bx bx-plus'></i> Buat Pengaduan</a>
                            </button>
                            <button class="w-100">
                                <a href=""><i class='bx bx-send'></i> Tanya CiMin</a>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- informasi penting -->
                <div class="row" style="margin-top: 20px;">
                    <div class="col-sm-12 col-md-7 col-xl-8">
                        <div class="card pengaduann py-3 px-3">
                            <h3 class="">Daftar Pengaduan Terbaru</h3>
   
                           <div class="table-responsive">
                               <table class="table">
                                   <thead>
                                       <tr>
                                           <td>No</td>
                                           <td>Tanggal Pengaduan</td>
                                           <td>NIK</td>
                                           <td>Isi Laporan</td>
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
                                               <td><?php echo $row['status'] ?></td>
                                           </tr>
                                       <?php } ?>
                                   </tbody>
                               </table>
                           </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-5 col-xl-4 mt-3 mt-md-0">
                        <div class="row d-flex">
                            <div class="col-md-12 pp">
                                <div class="card py-3 px-3 statistik" style="border-radius: 15px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.252); border: 1px solid rgba(170, 166, 166, 0.416); background: #f8fafc;">
                                    <h3>Statistik Bulanan</h3>
                                      <div class="d-flex align-items-center mb-3 bulan">
                                        <div class="month mt-3">Apr</div>
                                            <div class="flex-grow-1 mx-3">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span class="text-muted">Total: 61</span>
                                                    <span class="text-muted">Selesai: 30</span>
                                                </div>
                                                <div class="progress" style="height: 9px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                            <div class="percentage fw-medium small mt-4">50%</div>
                                      </div>
                                      <div class="d-flex align-items-center mb-3 bulan">
                                        <div class="month mt-3">Mei</div>
                                            <div class="flex-grow-1 mx-3">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span class="text-muted">Total: 30</span>
                                                    <span class="text-muted">Selesai: 30</span>
                                                </div>
                                                <div class="progress" style="height: 9px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                            <div class="percentage fw-medium small mt-4">100%</div>
                                      </div>
                                      <div class="d-flex align-items-center mb-3 bulan">
                                        <div class="month mt-3">Jun</div>
                                            <div class="flex-grow-1 mx-3">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span class="text-muted">Total: 67</span>
                                                    <span class="text-muted">Selesai: 58</span>
                                                </div>
                                                <div class="progress" style="height: 9px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                            <div class="percentage fw-medium small mt-4">85%</div>
                                      </div>
                                      <div class="d-flex align-items-center mb-3 bulan">
                                        <div class="month mt-3">Jul</div>
                                            <div class="flex-grow-1 mx-3">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span class="text-muted">Total: 80</span>
                                                    <span class="text-muted">Selesai: 40</span>
                                                </div>
                                                <div class="progress" style="height: 9px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                            <div class="percentage fw-medium small mt-4">40%</div>
                                      </div>
                                </div>
                            </div>
                             <div class="col-md-12 mt-3 pp">
                                <div class="card py-3 px-3 kategori" style="border-radius: 15px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.252); border: 1px solid rgba(170, 166, 166, 0.416); background: #f8fafc;">
                                    <h3 class="mb-3">Kategori Pengaduan</h3>
                                    <div class="d-flex align-items-center mb-3" >
                                        <div class="rounded-circle bg-primary mt-4" style="width:10px; height:10px; margin-right:10px;"></div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span class="kat-title">Pelayanan Publik</span>
                                                    <span class="text-muted">60 pengaduan</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" 
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                        <div class="small fw-medium ms-3 mt-3">50%</div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-primary mt-4" style="width:10px; height:10px; margin-right:10px;"></div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span class="kat-title">Infrastruktur</span>
                                                    <span class="text-muted">40 pengaduan</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" 
                                                    aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                        <div class="small fw-medium ms-3 mt-3">70%</div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-primary mt-4" style="width:10px; height:10px; margin-right:10px;"></div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span class="kat-title">Kebersihan</span>
                                                    <span class="text-muted">50 pengaduan</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 60%;" 
                                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                        <div class="small fw-medium ms-3 mt-3">60%</div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-primary mt-4" style="width:10px; height:10px; margin-right:10px;"></div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span class="kat-title">Kebersihan</span>
                                                    <span class="text-muted">20 pengaduan</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 90%;" 
                                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div> 
                                        <div class="small fw-medium ms-3 mt-3">90%</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- activity lately -->
                <div class="container aktivitas d-flex flex-column py-4 px-3">
                    <h3 class="ms-3">Aktivitas Terbaru</h3>
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
      
</div>

<!-- tambah pengaduan -->
<?php
        break;

    case 'tambah-pengaduan':
    include '../koneksi/koneksi.php';
    $nik = $_SESSION['nik'];
    $query = mysqli_query($config, "SELECT * FROM masyarakat WHERE nik = '$nik'");
    $row = mysqli_fetch_array($query);
        ?>

<div class="container" id="body-pd">
        <!-- sidebar -->
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>
             <div class="header__img">
                <img src="../../img/lol.png" alt="">
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

                <a href="../logout.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <!-- form tambah pengaduan -->
        <div class="row lol">
            <div class="col-sm-12 col-md-5 col-xl-5 mt-3 mt-md-0"> 
                <div class="row content-tambah">
                    <div class="col-12 panduan">
                        <div class="card py-2 px-2">
                            <h3>💡 Panduan Melapor yang Baik</h3>
                            <ul class="mt-1 ms-4">
                                <li><p>Sertakan foto atau dokumen pendukung bila memungkinkan.</p></li>
                                <li><p>Cantumkan lokasi kejadian selengkap mungkin (alamat, RT/RW)</p></li>
                                <li><p>Gunakan bahasa sopan, jelas, dan mudah dipahami.</p></li>
                                <li><p>Pastikan semua data sudah benar sebelum menekan tombol kirim.</p></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 estimasi mt-3">
                        <div class="card py-2 px-2">
                            <h3>⏳ Estimasi Waktu Proses</h3>
                            <ul class="mt-2 ms-4">
                                <li><p>Verifikasi Awal 1-2 hari kerja</p></li>
                                <li><p>Pengaduan akan ditinjau dalam waktu 3-7 hari kerja.</p></li>
                                <li><p>Anda akan mendapat notifikasi ketika ada perkembangan.</p></li>
                                <li><p>Untuk laporan kompleks, proses bisa lebih lama.</p></li>
                        </div>
                    </div>
                    
                    <div class="col-12 faqss mt-3">
                          <section class="about" id="#about">
                            <div class="container2">
                                <div class="wrapper2">
                                <!-- box about 1 faqs -->
                                <div class="box-about1 faqs">
                                    <div class="wrapperrrr">
                                        <button class="toggle">
                                            <h3>Apakah saya bisa melapor tanpa foto?</h3>
                                            <i class='bx bx-chevron-down icon'></i>
                                        </button>
                                        <div class="content">
                                            <p>Bisa. Tapi laporan dengan foto/dokumen akan lebih cepat diproses karena petugas memiliki bukti tambahan.</p>
                                        </div>
                                    </div>
                                
                                    <div class="wrapperrrr">
                                        <button class="toggle">
                                            <h3>Bagaimana cara mengecek status laporan?</h3>
                                            <i class='bx bx-chevron-down icon'></i>
                                        </button>
                                        <div class="content">
                                            <p>Masuk ke menu “Lihat Pengaduan” di dashboard. Di sana status laporan Anda ditampilkan.</p>
                                        </div>
                                    </div>

                                    <div class="wrapperrrr">
                                        <button class="toggle">
                                            <h3>Apakah identitas saya aman?</h3>
                                            <i class='bx bx-chevron-down icon'></i>
                                        </button>
                                        <div class="content">
                                            <p>Sangat aman. Identitas Anda digunakan untuk proses verifikasi internal, tidak akan dipublikasikan & disebarkan ke pihak luar.</p>
                                        </div>
                                    </div>

                                    <div class="wrapperrrr">
                                        <button class="toggle">
                                            <h3>Apakah saya bisa melapor lebih dari sekali?</h3>
                                            <i class='bx bx-chevron-down icon'></i>
                                        </button>
                                        <div class="content">
                                            <p>Bisa, terutama jika ada kasus berbeda. Namun untuk kasus yang sama, cukup lapor sekali agar tidak duplikasi.</p>
                                        </div>
                                    </div>

                                </div>
                                <!-- end of box1 -->
                                </div>
                            </div>
                          </section>
                    </div>

                </div>       
            </div>
            <div class="col-sm-12 col-md-7 col-xl-7 mt-3 mt-md-0">
                <form action="switch_masyarakat.php?aksi=tambah-pengaduan" method="post">
                    <div class="card tambah py-4 px-3" style="border-radius: 15px;">
                        <h3 class="form">Form Pengaduan</h3>
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
                            <input type="text" class="form-control" name="nik" value="<?= $row['nik']; ?>" readonly />
                        </div>
                        <div class="form-group mb-3 px-3">
                            <label>Isi Laporan</label>
                            <textarea class="form-control" name="isi_laporan" placeholder="Tuliskan laporan anda di sini dengan detail..." style="height: 200px"></textarea>
                        </div>
                        <div class="form-group mb-3 px-3">
                            <label>Foto</label><br>
                            <input type="hidden" class="upload-care" name="foto" role="uploadcare-uploader" data-public-key="38882543888abfb41547" data-images-only />
                        </div>
                        <div class="form-group mb-3 px-3">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                        <button class="btn-primary mt-4">Kirim Laporan</button>
                        <p class="note">⚡ Data anda dijamin aman dan rahasia.</p>
                    </div>
                </form>
            </div>

        </div>
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
<div class="container" id="body-pd" style="margin-top: 90px;">
    <!-- sidebar -->
    <header class="header d-flex justify-content-between align-items-center mb-4" id="header">
        <div class="header__toggle">
            <i class='bx bx-menu' id="header-toggle" style="font-size:1.4rem"></i>
        </div>
        <div class="header__img">
            <img src="../../img/lol.png" alt="" style="width:44px; height:44px; object-fit:cover; border-radius:8px;">
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
                    <a href="masyarakat.php?aksi=edit-profile" class="nav__link">
                        <i class='bx bx-user nav__icon' ></i>
                        <span class="nav__name">Profile</span>
                    </a>
                </div>
            </div>
            <a href="../logout.php" class="nav__link">
                <i class='bx bx-log-out nav__icon' ></i>
                <span class="nav__name">Log Out</span>
            </a>
        </nav>
    </div>

    <form action="switch_masyarakat.php?aksi=edit-pengaduan" method="post">
      <div class="card tambah py-4 px-4">
        <h3>Edit Pengaduan Anda</h3>
        <p class="subtext">Silakan perbarui isi laporan bila ada kesalahan atau tambahan informasi.</p>

        <div class="info-box">
          <i class='bx bx-info-circle fs-5'></i> 
          Pastikan isi laporan sudah jelas dan benar sebelum disimpan.
        </div>

        <!-- hidden id_pengaduan -->
        <input type="hidden" name="id_pengaduan" value="<?= $row['id_pengaduan'] ?>">

        <div class="form-group mb-3">
            <label class="fw-semibold mb-2">Isi Laporan</label>
            <textarea class="form-control" name="isi_laporan" placeholder="Tuliskan laporan anda di sini..." style="height: 150px" required><?= htmlspecialchars($row['isi_laporan']); ?></textarea>
        </div>

        <div class="d-flex justify-content-end mt-3">
          <button class="btn-save text-light"><i class='bx bx-save'></i> Simpan Perubahan</button>
        </div>
      </div>
    </form>
</div>

<!-- lihat tanggapan -->
<?php
    break;
    case 'lihat-pengaduan':
    include '../koneksi/koneksi.php';
    $nik = $_SESSION['nik'];
?>
<div class="container lihat"  id="body-pd">
        <!-- sidebar -->
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <div class="header__img">
                <img src="../../img/lol.png" alt="">
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

                <a href="../logout.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>
        
        <!-- Judul Halaman -->
        <!-- <div class="mb-4 welcome">
            <h3 class="hero-text">📋 Daftar Pengaduan Anda</h3>
            <p class="text-hero">Pantau status dan perkembangan setiap laporan yang telah Anda sampaikan.</p>
        </div> -->

        <!-- Statistik Ringkas -->
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body text-center lil">
                        <h5 class="">Total Pengaduan</h5>
                        <p class="nor">
                            <?php 
                            $total = mysqli_num_rows(mysqli_query($config, "SELECT * FROM pengaduan WHERE nik='$nik'"));
                            echo $total;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body text-center lil">
                        <h5 class="">Pending</h5>
                        <p class="nor">
                            <?php 
                            $proses = mysqli_num_rows(mysqli_query($config, "SELECT * FROM pengaduan WHERE nik='$nik' AND status='pending'"));
                            echo $proses;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body text-center lil">
                        <h5 class="">Decline</h5>
                        <p class="nor">
                            <?php 
                            $proses = mysqli_num_rows(mysqli_query($config, "SELECT * FROM pengaduan WHERE nik='$nik' AND status='decline'"));
                            echo $proses;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body text-center lil">
                        <h5 class="">Accept</h5>
                        <p class="nor">
                            <?php 
                            $selesai = mysqli_num_rows(mysqli_query($config, "SELECT * FROM pengaduan WHERE nik='$nik' AND status='accept'"));
                            echo $selesai;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- tampilkan tanggapan -->
        <div class="table-responsive py-3 px-3">
            
                    <table class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Tanggal Pengaduan</td>
                                <td>NIK</td>
                                <td>Isi Laporan</td>
                                <td>Foto</td>
                                <td>Tanggapan</td>
                                <td>Status</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>                                           
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($config, "
                            SELECT pengaduan.id_pengaduan, pengaduan.tgl_pengaduan, pengaduan.nik, pengaduan.isi_laporan, pengaduan.foto, pengaduan.status, tanggapan.tanggapan, tanggapan.tgl_tanggapan
                            FROM pengaduan
                            LEFT JOIN tanggapan 
                            ON tanggapan.id_pengaduan = pengaduan.id_pengaduan
                            WHERE pengaduan.nik = '$nik'
                            ");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['tgl_pengaduan'] ?></td>
                                    <td><?php echo $row['nik'] ?></td>
                                    <td><?php echo $row['isi_laporan'] ?></td>
                                    <td><img src="<?= $row['foto'] ?>" alt="foto" width="100" height="100"></td>
                                    <td><?php echo $row['tanggapan'] ?? '-' ?></td>
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
</div>

<!-- edit profile -->
<?php
    break;
    case 'edit-profile':
    include '../koneksi/koneksi.php';
    $nik = $_SESSION['nik'];
    $query = mysqli_query($config, "SELECT * FROM masyarakat WHERE nik = '$nik'");
    $row = mysqli_fetch_assoc($query);
?>
<div class="container prof" id="body-pd" >
        <!-- sidebar -->
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <div class="header__img">
                <img src="../../img/lol.png" alt="">
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

                        <a href="masyarakat.php?aksi=lihat-pengaduan" class="nav__link ">
                            <i class='bx bx-bookmark nav__icon' ></i>
                            <span class="nav__name">Lihat Tanggapan</span>
                        </a>

                        <a href="masyarakat.php?aksi=edit-profile" class="nav__link active">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Profile</span>
                        </a>
                    </div>
                </div>

                <a href="../logout.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

    <div class="row justify-content-center" style="margin-top: 100px;">
        <!-- Profile Sidebar -->
        <div class="col-md-4 mb-4">
            <div class="card profile-sidebar px-4 py-5">
                <img src="../../img/lol.png" alt="" class="img-profile">
                <h5 class="fw-bold mb-1 profile-name"><?= $row['nama']; ?></h5>
                <p class="mb-2 profile-username">@<?= $row['username']; ?></p>
                <div class="profile-info">
                    <div class="info-item">
                        <i class='bx bx-phone info-icon'></i>
                        <span class="info-text"><?= $row['telp']; ?></span>
                    </div>
                    <div class="info-item">
                        <i class='bx bx-id-card info-icon'></i>
                        <span class="info-text"><?= $row['nik']; ?></span>
                    </div>
                </div>
                <button class="ganti-foto"><i class='bx bx-edit'></i> Ganti Foto</button>
            </div>
        </div>

        <!-- Edit Profile Form -->
        <div class="col-md-8">
            <div class="card edit-profile-card ">
                <div class="card-body">
                <h3><i class="bx bx-edit"></i> Edit Profile</h3>
                    <form action="switch_masyarakat.php?aksi=edit-profile" method="post" class="mt-3">
                        <input type="hidden" name="nik_lama" value="<?= $row['nik'] ?>">

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-user form-icon'></i>
                                    Nama Lengkap
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control border-0 shadow-sm" name="nama" value="<?= $row['nama'] ?>" required>
                                    <div class="input-group-text bg-light border-0">
                                        <i class='bx bx-check-circle text-success validation-icon'></i>
                                    </div>
                                </div>
                                <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-at form-icon'></i>
                                    Username
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control border-0 shadow-sm" name="username" value="<?= $row['username'] ?>" required>
                                    <div class="input-group-text bg-light border-0">
                                        <i class='bx bx-check-circle text-success validation-icon'></i>
                                    </div>
                                </div>
                                <div class="invalid-feedback">Username wajib diisi.</div>
                            </div>
                        </div>

                        <div class="mb-3 mt-2">
                            <label class="form-label fw-semibold">
                                <i class='bx bx-phone form-icon'></i>
                                No. Telepon
                            </label>
                            <div class="input-group">
                                <input type="tel" class="form-control border-0 shadow-sm" name="telp" value="<?= $row['telp'] ?>" required pattern="[0-9]{10,13}">
                                <div class="input-group-text bg-light border-0">
                                    <i class='bx bx-check-circle text-success validation-icon'></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions d-flex justify-content-end gap-3 mt-3">
                            <button class="btn-cancel px-4" style="margin-top: 30px;">
                                <a href="masyarakat.php">
                                    <i class='bx bx-x'></i>
                                    Batal
                                </a>
                            </button>
                            <button type="submit" class=" btn-save px-4" style="margin-top: 30px;">
                                <i class='bx bx-save' style="color: white;"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





<?php
break;
}
?>
<script src="../../js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>