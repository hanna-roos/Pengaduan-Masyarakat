<?php 
session_start();
include "../koneksi/koneksi.php";
// hitung accepted, pending, decline
$pengaduan = mysqli_fetch_array(mysqli_query($config, "SELECT COUNT(*) AS total FROM pengaduan "))['total'];
$tanggapan  = mysqli_fetch_array(mysqli_query($config, "SELECT COUNT(*) AS total FROM tanggapan "))['total'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Petugas Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-web: #ffffff;
            --bg-sidebar: #0a2472;
            --bg-button: #001c55;
            --bg-card: #f8fafc;
            --title: #00072d;
            --text-black: #1f2937;
            --text-white: #ffffff;
            --font-body: "Poppins", sans-serif;
            --primary-gradient: linear-gradient(135deg, #0a2472 0%, #001c55 50%, #1e3a8a 100%);
            --secondary-gradient: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            --glass-bg: rgba(248, 250, 252, 0.08);
            --glass-border: rgba(255, 255, 255, 0.15);
            --shadow-light: 0 8px 32px rgba(10, 36, 114, 0.1);
            --shadow-medium: 0 12px 40px rgba(10, 36, 114, 0.15);
            --shadow-heavy: 0 20px 60px rgba(10, 36, 114, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

body {
    font-family: var(--font-body);
    min-height: 100vh;
    margin: 0;
    background: url("../../img/bg1.jpg") no-repeat center center fixed;
    background-size: cover;
    position: relative;
}

body::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(10, 36, 114, 0.50); /* biru transparan */
    backdrop-filter: blur(px); 
    z-index: -1;
}

        /* Advanced Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100vh;
            background: rgba(10, 36, 114, 0.95);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 1000;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, 
                rgba(255, 255, 255, 0.1) 0%, 
                transparent 50%, 
                rgba(0, 0, 0, 0.1) 100%);
            pointer-events: none;
        }

        .sidebar-header {
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--text-white);
            text-decoration: none;
            font-weight: 700;
            font-size: 1.5rem;
            position: relative;
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            background: var(--secondary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: var(--shadow-light);
        }

        .nav-menu {
            padding: 1rem 0;
        }

        .nav-item {
            margin: 0.5rem 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-white);
            transform: translateX(8px);
            box-shadow: var(--shadow-light);
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link.active {
            background: var(--secondary-gradient);
            color: var(--text-white);
            box-shadow: var(--shadow-medium);
        }

        .nav-icon {
            font-size: 1.3rem;
            min-width: 24px;
        }

        /* Advanced Header */
        .main-header {
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            height: 80px;
            background: rgba(248, 250, 252, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            z-index: 999;
            transition: all 0.3s ease;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--title);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .menu-toggle:hover {
            background: rgba(10, 36, 114, 0.1);
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--title);
            margin: 0;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .notification-btn {
            position: relative;
            background: none;
            border: none;
            font-size: 1.3rem;
            color: var(--title);
            cursor: pointer;
            padding: 0.75rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .notification-btn:hover {
            background: rgba(10, 36, 114, 0.1);
            transform: scale(1.05);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-profile:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-light);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--bg-sidebar);
        }

        .user-info h6 {
            margin: 0;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--title);
        }

        .user-info p {
            margin: 0;
            font-size: 0.75rem;
            color: var(--text-black);
            opacity: 0.7;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            margin-top: 80px;
            padding: 2rem;
            min-height: calc(100vh - 80px);
        }

        /* Hero Section */
        .hero-section {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--text-white);
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: var(--text-white);
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-heavy);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: var(--secondary-gradient);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--text-white);
            margin-bottom: 1rem;
            box-shadow: var(--shadow-light);
        }

        .stat-title {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-white);
            opacity: 0.8;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-white);
            margin-bottom: 1rem;
        }

        /* Content Card */
        .content-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-white);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            background: var(--secondary-gradient);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-white);
            font-size: 1.1rem;
        }

        /* Advanced Table */
        .advanced-table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-light);
        }

        .advanced-table thead {
            background: var(--primary-gradient);
        }

        .advanced-table th, .advanced-table td {
            padding: 1rem;
            text-align: left;
            border: none;
        }

        .advanced-table th {
            color: var(--text-white);
            font-weight: 600;
            font-size: 0.9rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .advanced-table td {
            font-size: 0.9rem;
            color: var(--text-black);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .advanced-table tbody tr {
            transition: all 0.3s ease;
        }

        .advanced-table tbody tr:hover {
            background: rgba(10, 36, 114, 0.05);
        }

        .status-badge {
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: rgba(251, 191, 36, 0.2);
            color: #d97706;
        }

        .status-accept {
            background: rgba(16, 185, 129, 0.2);
            color: #059669;
        }

        .status-decline {
            background: rgba(239, 68, 68, 0.2);
            color: #dc2626;
        }

        /* Form Styling */
        .form-container {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-white);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--bg-sidebar);
            box-shadow: 0 0 0 3px rgba(10, 36, 114, 0.1);
            transform: translateY(-2px);
        }

        .btn-primary-custom {
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            color: var(--text-white);
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
            color: var(--text-white);
        }

        .btn-secondary-custom {
            background: rgba(107, 114, 128, 0.8);
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            color: var(--text-white);
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary-custom:hover {
            background: rgba(107, 114, 128, 1);
            color: var(--text-white);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-header {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .hero-title {
                font-size: 2rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 1px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--secondary-gradient);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-gradient);
        }

        /* Legacy wrapper styles for backward compatibility */
        .wrapper {
            position: relative;
        }

        /* Hide legacy navbar and header */
        .l-navbar, .header {
            display: none;
        }
    </style>
</head>

<?php
include "../koneksi/koneksi.php";
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
switch ($aksi) {

// ================= DEFAULT (DASHBOARD) =================
default:
?>

<body>
    <!-- Advanced Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="petugas.php" class="logo">
                <div class="logo-icon">
                    <i class='bx bx-layer'></i>
                </div>
<<<<<<< HEAD
<<<<<<< HEAD
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="petugas.php" class="sidebar-link">
                        <i class="lni lni-home-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="lihat_pengaduan.php?aksi=lihat-pengaduan" class="sidebar-link">
                        <i class="lni lni-shield-2-check"></i>
                        <span>Lihat Pengaduan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="lihat_tanggapan.php?aksi=lihat-tanggapan" class="sidebar-link">
                        <i class="lni lni-shield-2-check"></i>
                        <span>Lihat Tanggapan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="lihat_masyarakat.php?aksi=lihat-masyarakat" class="sidebar-link">
                        <i class="lni lni-user-multiple-4"></i>
                        <span>Masyarakat</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="../logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
=======

                <a href="../logout.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
>>>>>>> bdc4ff8970c446a9703bcd011dc472a40946d6b9
=======
                <span>CITIZEN</span>
            </a>
        </div>
        
        <nav class="nav-menu">
            <div class="nav-item">
                <a href="petugas.php" class="nav-link active">
                    <i class='bx bx-grid-alt nav-icon'></i>
                    <span>Dashboard</span>
>>>>>>> 001aa14ebe10136a1db7170ac5a394322bdb8806
                </a>
            </div>
            <div class="nav-item">
                <a href="lihat_pengaduan.php?aksi=lihat-pengaduan" class="nav-link">
                    <i class='bx bx-message-square-detail nav-icon'></i>
                    <span>Lihat Pengaduan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="lihat_tanggapan.php?aksi=lihat-tanggapan" class="nav-link">
                    <i class='bx bx-bookmark nav-icon'></i>
                    <span>Lihat Tanggapan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="lihat_masyarakat.php?aksi=lihat-masyarakat" class="nav-link">
                    <i class='bx bx-user nav-icon'></i>
                    <span>Lihat Masyarakat</span>
                </a>
            </div>
            <div class="nav-item" style="margin-top: 2rem;">
                <a href="../logout.php" class="nav-link">
                    <i class='bx bx-log-out nav-icon'></i>
                    <span>Log Out</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Advanced Header -->
    <header class="main-header">
        <div class="header-left">
            <button class="menu-toggle" id="menuToggle">
                <i class='bx bx-menu'></i>
            </button>
            <h1 class="header-title">Dashboard Petugas</h1>
        </div>
        
        <div class="header-right">
            <button class="notification-btn">
                <i class='bx bx-bell'></i>
            </button>
            
            <div class="user-profile">
                <img src="../../img/lol.png" alt="Profile" class="user-avatar">
                <div class="user-info">
                    <h6><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Petugas'; ?></h6>
                    <p>Petugas</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero-section fade-in-up">
            <h1 class="hero-title">Selamat Datang di Dashboard Petugas! 👋</h1>
            <p class="hero-subtitle">Kelola pengaduan masyarakat dan berikan tanggapan yang tepat untuk menciptakan pelayanan yang lebih baik.</p>
        </section>

        <!-- Stats Grid -->
        <section class="stats-grid fade-in-up">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class='bx bx-file'></i>
                </div>
                <div class="stat-title">Total Pengaduan</div>
                <div class="stat-value"><?= $pengaduan; ?></div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class='bx bx-message-dots'></i>
                </div>
                <div class="stat-title">Total Tanggapan</div>
                <div class="stat-value"><?= $tanggapan; ?></div>
            </div>
        </section>

        <!-- Recent Reports Section -->
        <section class="content-card fade-in-up">
            <h3 class="card-title">
                <div class="card-icon">
                    <i class='bx bx-file-blank'></i>
                </div>
                Pengaduan Terbaru
            </h3>
            
            <div class="table-responsive">
                <table class="advanced-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Laporan</th>
                            <th>NIK</th>
                            <th>Isi Laporan</th>
                            <th>Foto</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($config, "SELECT * FROM pengaduan ORDER BY tgl_pengaduan DESC LIMIT 5");
                        $no = 1;
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d/m/Y', strtotime($row['tgl_pengaduan'])) ?></td>
                            <td><?= $row['nik'] ?></td>
                            <td><?= substr($row['isi_laporan'], 0, 50) . '...' ?></td>
                            <td>
                                <?php if($row['foto']): ?>
                                    <img src="<?= $row['foto']; ?>" alt="foto" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                <?php else: ?>
                                    <span style="color: #9ca3af;">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="status-badge status-<?= $row['status'] ?>">
                                    <?= ucfirst($row['status']) ?>
                                </span>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Recent Responses Section -->
        <section class="content-card fade-in-up">
            <h3 class="card-title">
                <div class="card-icon">
                    <i class='bx bx-message-square-detail'></i>
                </div>
                Tanggapan Terbaru
            </h3>
            
            <div class="table-responsive">
                <table class="advanced-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Tanggapan</th>
                            <th>ID Pengaduan</th>
                            <th>Tanggal Tanggapan</th>
                            <th>Tanggapan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($config, "SELECT * FROM tanggapan ORDER BY tgl_tanggapan DESC LIMIT 5");
                        $no = 1;
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['id_tanggapan'] ?></td>
                            <td><?= $row['id_pengaduan'] ?></td>
                            <td><?= date('d/m/Y', strtotime($row['tgl_tanggapan'])) ?></td>
                            <td><?= substr($row['tanggapan'], 0, 50) . '...' ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        }
    </script>

<?php
break;

// ================= EDIT MASYARAKAT =================
case 'edit-masyarakat':
    $id = $_GET['id'];
    $query = mysqli_query($config, "SELECT * FROM masyarakat WHERE nik='$id'");
    $data = mysqli_fetch_array($query);
?>

<body>
    <!-- Advanced Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="petugas.php" class="logo">
                <div class="logo-icon">
                    <i class='bx bx-layer'></i>
                </div>
                <span>CITIZEN</span>
            </a>
        </div>
        
        <nav class="nav-menu">
            <div class="nav-item">
                <a href="petugas.php" class="nav-link">
                    <i class='bx bx-grid-alt nav-icon'></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="lihat_pengaduan.php?aksi=lihat-pengaduan" class="nav-link">
                    <i class='bx bx-message-square-detail nav-icon'></i>
                    <span>Lihat Pengaduan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="lihat_tanggapan.php?aksi=lihat-tanggapan" class="nav-link">
                    <i class='bx bx-bookmark nav-icon'></i>
                    <span>Lihat Tanggapan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="lihat_masyarakat.php?aksi=lihat-masyarakat" class="nav-link active">
                    <i class='bx bx-user nav-icon'></i>
                    <span>Lihat Masyarakat</span>
                </a>
            </div>
            <div class="nav-item" style="margin-top: 2rem;">
                <a href="../logout.php" class="nav-link">
                    <i class='bx bx-log-out nav-icon'></i>
                    <span>Log Out</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Advanced Header -->
    <header class="main-header">
        <div class="header-left">
            <button class="menu-toggle" id="menuToggle">
                <i class='bx bx-menu'></i>
            </button>
            <h1 class="header-title">Edit Data Masyarakat</h1>
        </div>
        
        <div class="header-right">
            <button class="notification-btn">
                <i class='bx bx-bell'></i>
            </button>
            
            <div class="user-profile">
                <img src="../../img/lol.png" alt="Profile" class="user-avatar">
                <div class="user-info">
                    <h6><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Petugas'; ?></h6>
                    <p>Petugas</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="form-container fade-in-up" style="max-width: 600px; margin: 0 auto;">
            <h3 class="card-title">
                <div class="card-icon">
                    <i class='bx bx-edit'></i>
                </div>
                Edit Data Masyarakat
            </h3>
            
            <form method="POST" action="switch_petugas.php?aksi=update-masyarakat">
                <input type="hidden" name="nik" value="<?= $data['nik'] ?>">
                
                <div class="form-group">
                    <label class="form-label">👤 Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">🔤 Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">🔐 Password</label>
                    <input type="text" name="password" class="form-control" value="<?= $data['password'] ?>" required>
                </div>
                
                <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
                    <a href="petugas.php?aksi=lihat-masyarakat" class="btn-secondary-custom">
                        <i class='bx bx-x'></i>
                        Batal
                    </a>
                    <button type="submit" class="btn-primary-custom">
                        <i class='bx bx-save'></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        }
    </script>

<?php
break;

case 'status-accept':
    $id_pengaduan = $_GET['id_pengaduan'];
    $pengaduan = mysqli_query($config, "SELECT * FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
    $row = mysqli_fetch_array($pengaduan);
?>

<body>
    <!-- Advanced Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="petugas.php" class="logo">
                <div class="logo-icon">
                    <i class='bx bx-layer'></i>
                </div>
                <span>CITIZEN</span>
            </a>
        </div>
        
        <nav class="nav-menu">
            <div class="nav-item">
                <a href="petugas.php" class="nav-link">
                    <i class='bx bx-grid-alt nav-icon'></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="lihat_pengaduan.php?aksi=lihat-pengaduan" class="nav-link active">
                    <i class='bx bx-message-square-detail nav-icon'></i>
                    <span>Lihat Pengaduan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="lihat_tanggapan.php?aksi=lihat-tanggapan" class="nav-link">
                    <i class='bx bx-bookmark nav-icon'></i>
                    <span>Lihat Tanggapan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="lihat_masyarakat.php?aksi=lihat-masyarakat" class="nav-link">
                    <i class='bx bx-user nav-icon'></i>
                    <span>Lihat Masyarakat</span>
                </a>
            </div>
            <div class="nav-item" style="margin-top: 2rem;">
                <a href="../logout.php" class="nav-link">
                    <i class='bx bx-log-out nav-icon'></i>
                    <span>Log Out</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Advanced Header -->
    <header class="main-header">
        <div class="header-left">
            <button class="menu-toggle" id="menuToggle">
                <i class='bx bx-menu'></i>
            </button>
            <h1 class="header-title">Tambah Tanggapan</h1>
        </div>
        
        <div class="header-right">
            <button class="notification-btn">
                <i class='bx bx-bell'></i>
            </button>
            
            <div class="user-profile">
                <img src="../../img/lol.png" alt="Profile" class="user-avatar">
                <div class="user-info">
                    <h6><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Petugas'; ?></h6>
                    <p>Petugas</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="form-container fade-in-up" style="max-width: 600px; margin: 0 auto;">
            <h3 class="card-title">
                <div class="card-icon">
                    <i class='bx bx-message-square-add'></i>
                </div>
                Tambah Tanggapan untuk ID Pengaduan: <?= $row['id_pengaduan']; ?>
            </h3>
            
            <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 1rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 0.75rem;">
                <i class='bx bx-info-circle' style="color: #3b82f6; font-size: 1.2rem;"></i>
                <span style="color: #1e40af; font-weight: 500;">Pastikan tanggapan yang diberikan jelas dan membantu menyelesaikan masalah.</span>
            </div>
            
            <form action="switch_petugas.php?aksi=status-accept" method="POST">
                <input type="hidden" name="id_pengaduan" value="<?= $row['id_pengaduan']; ?>">
                
                <div class="form-group">
                    <label for="tanggapan" class="form-label">📝 Tanggapan</label>
                    <textarea class="form-control" name="tanggapan" id="tanggapan" rows="6" placeholder="Tuliskan tanggapan anda untuk pengaduan ini..." required style="resize: vertical;"></textarea>
                </div>
                
                <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
                    <a href="lihat_pengaduan.php?aksi=lihat-pengaduan" class="btn-secondary-custom">
                        <i class='bx bx-x'></i>
                        Batal
                    </a>
                    <button type="submit" name="tanggapi" class="btn-primary-custom">
                        <i class='bx bx-send'></i>
                        Kirim Tanggapan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        }
    </script>

<?php
break;
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>