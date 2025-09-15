<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Masyarakat</title>
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

        /* Button Styling */
        .btn-primary-custom {
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            color: var(--text-white);
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
            color: var(--text-white);
        }

        .btn-success-custom {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            border-radius: 12px;
            padding: 0.5rem 1rem;
            color: var(--text-white);
            font-weight: 600;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin: 0.25rem;
        }

        .btn-success-custom:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-light);
            color: var(--text-white);
        }

        .btn-danger-custom {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            border-radius: 12px;
            padding: 0.5rem 1rem;
            color: var(--text-white);
            font-weight: 600;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin: 0.25rem;
        }

        .btn-danger-custom:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-light);
            color: var(--text-white);
        }

        /* Modal Styling */
        .modal-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            box-shadow: var(--shadow-heavy);
        }

        .modal-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 20px 20px 0 0;
        }

        .form-control {
            border: 2px solid rgba(10, 36, 114, 0.2);
            border-radius: 12px;
            padding: 0.875rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--bg-sidebar);
            box-shadow: 0 0 0 3px rgba(10, 36, 114, 0.1);
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
    </style>
</head>

<?php 
session_start();
include "../koneksi/koneksi.php";

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

switch ($aksi) {
    default:
?>

<body>
    <!-- Advanced Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="admin.php" class="logo">
                <div class="logo-icon">
                    <i class='bx bx-layer'></i>
                </div>
                <span>CITIZEN</span>
            </a>
        </div>
        
        <nav class="nav-menu">
            <div class="nav-item">
                <a href="admin.php" class="nav-link">
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
                <a href="lihat_petugas.php?aksi=lihat-petugas" class="nav-link">
                    <i class='bx bx-user nav-icon'></i>
                    <span>Lihat Petugas</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="lihat_masyarakat.php?aksi=lihat-masyarakat" class="nav-link active">
                    <i class='bx bx-user nav-icon'></i>
                    <span>Lihat Masyarakat</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="lihat_report.php" class="nav-link">
                    <i class='bx bx-file nav-icon'></i>
                    <span>Laporan</span>
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
            <h1 class="header-title">Data Masyarakat</h1>
        </div>
        
        <div class="header-right">
            <button class="notification-btn">
                <i class='bx bx-bell'></i>
            </button>
            
            <div class="user-profile">
                <img src="../../img/adminpetugas.png" alt="Profile" class="user-avatar">
                <div class="user-info">
                    <h6><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin'; ?></h6>
                    <p>Administrator</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero-section fade-in-up">
            <h1 class="hero-title">Tampilan Data Masyarakat 👥</h1>
            <p class="hero-subtitle">Kelola data masyarakat yang terdaftar dalam sistem pengaduan. Tambah, edit, atau hapus data sesuai kebutuhan.</p>
        </section>

        <!-- Content Section -->
        <section class="content-card fade-in-up">
            <!-- Button trigger modal -->
            <button type="button" class="btn-primary-custom d-flex gap-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class='bx bx-plus' style="margin-top:2.8px;"></i> Tambah Masyarakat
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                <i class='bx bx-user-plus'></i> Tambah Masyarakat
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="switch_admin.php?aksi=tambah-masyarakat" method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nik" class="form-label">📋 NIK</label>
                                    <input type="text" class="form-control" name="nik" placeholder="Isi NIK Anda" required>
                                </div>

                                <div class="mb-3">
                                    <label for="nama" class="form-label">👤 Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Isi Nama Lengkap Anda" required>
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">🔤 Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Isi Username Anda" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">🔐 Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Isi Password Anda" required>
                                </div>

                                <div class="mb-3">
                                    <label for="telp" class="form-label">📞 Telepon</label>
                                    <input type="number" class="form-control" name="telp" placeholder="Isi Telepon Anda" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="submit" class="btn-primary-custom">
                                    <i class='bx bx-save'></i> Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <h3 class="card-title">
                <div class="card-icon">
                    <i class='bx bx-group'></i>
                </div>
                Data Masyarakat Terdaftar
            </h3>
            
            <div class="table-responsive">
                <table class="advanced-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($config, "SELECT * FROM masyarakat");
                        $no = 1;
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['nik'] ?></td>
                            <td><?php echo $row['nama'] ?></td>
                            <td><?php echo $row['username'] ?></td>
                            <td><?php echo $row['password'] ?></td>
                            <td>
                                <a href="admin.php?aksi=edit-masyarakat&id=<?= $row['nik'] ?>" class="btn-success-custom">
                                    <i class='bx bx-edit'></i> Edit
                                </a>
                                <a href="switch_admin.php?aksi=hapus-masyarakat&nik=<?php echo $row['nik'] ?>" class="btn-danger-custom" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class='bx bx-trash'></i> Hapus
                                </a>
                            </td>
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
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>