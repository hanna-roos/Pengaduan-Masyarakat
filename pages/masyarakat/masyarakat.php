<?php
include "../koneksi/koneksi.php";
session_start();
if (!isset($_SESSION['email']) == 'email' && !isset($_SESSION['nik']) == 'nik'){
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
    <title>Masyarakat Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
    UPLOADCARE_PUBLIC_KEY = '38882543888abfb41547';
    </script>
    <script src="https://ucarecdn.com/libs/widget/3.x/uploadcare.full.min.js"></script>
    
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
            --glass-bg: rgba(255, 255, 255, 0.15);
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

/* Animasi glow bergerak lembut */
@keyframes pulseGlow {
    0% {
        transform: scale(1);
        opacity: 0.6;
    }
    100% {
        transform: scale(1.1);
        opacity: 0.9;
    }
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
            /* animation: logoFloat 3s ease-in-out infinite; */
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-5px) rotate(2deg); }
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

        .search-box {
            position: relative;
            width: 400px;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 1.25rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--bg-sidebar);
            box-shadow: 0 0 0 3px rgba(10, 36, 114, 0.1);
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
            border:none;
            transform: scale(1.05);
        }

        .notification-badge {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            animation: pulse 2s infinite;
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
/* 
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        } */

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: var(--text-black);
            opacity: 0.8;
            margin-bottom: 2rem;
        }

        .quick-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .quick-action-btn {
            padding: 1rem 2rem;
            background: var(--primary-gradient);
            color: var(--text-white);
            border: none;
            border-radius: 16px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .quick-action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .quick-action-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
            color: var(--text-white);
        }

        .quick-action-btn:hover::before {
            left: 100%;
        }

        .quick-action-btn.secondary {
            background: var(--secondary-gradient);
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

        /* .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        } */

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-heavy);
        }

        .stat-header {
            display: flex;
            justify-content: between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
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
            color: var(--text-black);
            opacity: 0.8;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--title);
            margin-bottom: 1rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-change {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .stat-change.positive {
            color: #00ffaaff;
        }

        .stat-change.negative {
            color: #ef4444;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .content-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        /* .content-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--secondary-gradient);
        } */

        .card-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--title);
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
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-light);
        }

        .advanced-table thead {
            background: var(--primary-gradient);
        }

        .advanced-table th {
            padding: 1.25rem 1rem;
            color: var(--text-white);
            font-weight: 600;
            font-size: 0.9rem;
            text-align: left;
            border: none;
        }

        .advanced-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-size: 0.9rem;
            color: var(--text-black);
        }

        .advanced-table tbody tr {
            transition: all 0.3s ease;
        }

        .advanced-table tbody tr:hover {
            background: rgba(10, 36, 114, 0.05);
            transform: scale(1.01);
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

        /* Action Buttons */
        .action-btn {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 0 0.25rem;
        }

        .action-btn.edit {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
        }

        .action-btn.delete {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .action-btn:hover {
            transform: scale(1.1);
            box-shadow: var(--shadow-light);
        }

        /* Progress Bars */
        .progress-container {
            margin-bottom: 1.5rem;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-black);
        }

        .progress-bar-custom {
            height: 8px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 50px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--secondary-gradient);
            border-radius: 50px;
            transition: width 1s ease;
            position: relative;
        }

        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Activity Feed */
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .activity-item:hover {
            background: rgba(10, 36, 114, 0.02);
            border-radius: 12px;
            padding: 1rem;
            margin: 0 -1rem;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            background: var(--secondary-gradient);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-white);
            font-size: 1rem;
            flex-shrink: 0;
        }

        .activity-content h6 {
            margin: 0 0 0.25rem 0;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--title);
        }

        .activity-content p {
            margin: 0;
            font-size: 0.8rem;
            color: var(--text-black);
            opacity: 0.7;
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

        /* .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        } */

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--title);
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
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .search-box {
                width: 300px;
            }
        }

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
            
            .search-box {
                display: none;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .quick-actions {
                flex-direction: column;
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

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.7;
                transform: scale(1.1);
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
include "../koneksi/koneksi.php";

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

switch ($aksi) {
    default:
        // ================= DASHBOARD =================
        ?>

<body>

    <!-- Advanced Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="masyarakat.php" class="logo">
                <div class="logo-icon">
                    <i class='bx bx-layer'></i>
                </div>
                <span>CITIZEN</span>
            </a>
        </div>
        
        <nav class="nav-menu">
            <div class="nav-item">
                <a href="masyarakat.php" class="nav-link active">
                    <i class='bx bx-grid-alt nav-icon'></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="masyarakat.php?aksi=tambah-pengaduan" class="nav-link">
                    <i class='bx bx-message-square-detail nav-icon'></i>
                    <span>Submit Pengaduan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="masyarakat.php?aksi=lihat-pengaduan" class="nav-link">
                    <i class='bx bx-bookmark nav-icon'></i>
                    <span>Lihat Tanggapan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="masyarakat.php?aksi=edit-profile" class="nav-link">
                    <i class='bx bx-user nav-icon'></i>
                    <span>Profile</span>
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
            <div class="search-box">
                
                <input type="text" class="search-input" placeholder="Cari pengaduan, status, atau informasi...">
            </div>
        </div>
        
        <div class="header-right">
            <button class="notification-btn">
                <i class='bx bx-bell'></i>
                <div class="notification-badge"></div>
            </button>
            
            <div class="user-profile">
                <img src="../../img/lol.png" alt="Profile" class="user-avatar">
                <div class="user-info">
                    <h6><?php echo $_SESSION['email'] ?></h6>
                    <p>Masyarakat</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero-section fade-in-up">
            <h1 class="hero-title text-white">Selamat Datang, <?php echo $_SESSION['email'] ?>! 👋</h1>
            <p class="hero-subtitle text-white">Sampaikan pengaduan Anda dan bantu kami menciptakan perubahan yang lebih baik untuk masyarakat.</p>
            
            <div class="quick-actions">
                <a href="masyarakat.php?aksi=tambah-pengaduan" class="quick-action-btn">
                    <i class='bx bx-plus'></i>
                    Buat Pengaduan Baru
                </a>
                <a href="masyarakat.php?aksi=lihat-pengaduan" class="quick-action-btn secondary">
                    <i class='bx bx-search'></i>
                    Lihat Status Pengaduan
                </a>
            </div>
        </section>

        <!-- Stats Grid -->
        <section class="stats-grid fade-in-up">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class='bx bx-file'></i>
                </div>
                <div class="stat-title">Total Pengaduan</div>
                <div class="stat-value">237</div>
                <div class="stat-change positive">
                    <i class='bx bx-trending-up'></i>
                    <span>+12 bulan ini</span>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class='bx bx-time'></i>
                </div>
                <div class="stat-title">Sedang Diproses</div>
                <div class="stat-value">34</div>
                <div class="stat-change positive">
                    <i class='bx bx-trending-up'></i>
                    <span>+5 bulan ini</span>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class='bx bx-check-circle'></i>
                </div>
                <div class="stat-title">Selesai</div>
                <div class="stat-value">98</div>
                <div class="stat-change positive">
                    <i class='bx bx-trending-up'></i>
                    <span>+8 bulan ini</span>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class='bx bx-bar-chart'></i>
                </div>
                <div class="stat-title">Tingkat Penyelesaian</div>
                <div class="stat-value">87%</div>
                <div class="stat-change positive">
                    <i class='bx bx-trending-up'></i>
                    <span>+3% bulan ini</span>
                </div>
            </div>
        </section>

        <!-- Content Grid -->
        <section class="content-grid fade-in-up">
            <!-- Recent Reports -->
            <div class="content-card">
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
                                <th>Tanggal</th>
                                <th>NIK</th>
                                <th>Isi Laporan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../koneksi/koneksi.php';
                            $nik = $_SESSION['nik'];
                            $query = mysqli_query($config, "SELECT * FROM pengaduan WHERE nik = '$nik' ORDER BY tgl_pengaduan DESC LIMIT 5");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo date('d/m/Y', strtotime($row['tgl_pengaduan'])) ?></td>
                                    <td><?php echo $row['nik'] ?></td>
                                    <td><?php echo substr($row['isi_laporan'], 0, 50) . '...' ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo $row['status'] ?>">
                                            <?php echo ucfirst($row['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="masyarakat.php?aksi=edit-pengaduan&id_pengaduan=<?php echo $row['id_pengaduan'] ?>" class="action-btn edit">
                                            <i class='bx bx-edit-alt'></i>
                                        </a>
                                        <a href="switch_masyarakat.php?aksi=hapus&id_pengaduan=<?php echo $row['id_pengaduan'] ?>" class="action-btn delete">
                                            <i class='bx bx-trash'></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Statistics & Activity -->
            <div>
                <!-- Monthly Statistics -->
                <div class="content-card" style="margin-bottom: 1.5rem;">
                    <h3 class="card-title">
                        <div class="card-icon">
                            <i class='bx bx-bar-chart-alt-2'></i>
                        </div>
                        Statistik Bulanan
                    </h3>
                    
                    <div class="progress-container">
                        <div class="progress-label">
                            <span>April - Total: 61</span>
                            <span>50%</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill" style="width: 50%"></div>
                        </div>
                    </div>
                    
                    <div class="progress-container">
                        <div class="progress-label">
                            <span>Mei - Total: 30</span>
                            <span>100%</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill" style="width: 100%"></div>
                        </div>
                    </div>
                    
                    <div class="progress-container">
                        <div class="progress-label">
                            <span>Juni - Total: 67</span>
                            <span>85%</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill" style="width: 85%"></div>
                        </div>
                    </div>
                    
                    <div class="progress-container">
                        <div class="progress-label">
                            <span>Juli - Total: 80</span>
                            <span>40%</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill" style="width: 40%"></div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="content-card">
                    <h3 class="card-title">
                        <div class="card-icon">
                            <i class='bx bx-time'></i>
                        </div>
                        Aktivitas Terbaru
                    </h3>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class='bx bx-plus'></i>
                        </div>
                        <div class="activity-content">
                            <h6>Pengaduan baru diterima</h6>
                            <p>2 menit yang lalu</p>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class='bx bx-check'></i>
                        </div>
                        <div class="activity-content">
                            <h6>Status pengaduan #156 diubah menjadi "Selesai"</h6>
                            <p>15 menit yang lalu</p>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class='bx bx-message'></i>
                        </div>
                        <div class="activity-content">
                            <h6>Tanggapan diterima untuk pengaduan #142</h6>
                            <p>1 jam yang lalu</p>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class='bx bx-check-circle'></i>
                        </div>
                        <div class="activity-content">
                            <h6>Pengaduan #138 telah diselesaikan</h6>
                            <p>2 jam yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // Animate numbers on load
        const animateNumbers = () => {
            const numbers = document.querySelectorAll('.stat-value');
            numbers.forEach(number => {
                const target = parseInt(number.textContent);
                let current = 0;
                const increment = target / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    number.textContent = Math.floor(current);
                }, 20);
            });
        };

        // Initialize animations
        window.addEventListener('load', () => {
            setTimeout(animateNumbers, 500);
        });

        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

<?php
        break;

    case 'tambah-pengaduan':
    include '../koneksi/koneksi.php';
    $nik = $_SESSION['nik'];
    $query = mysqli_query($config, "SELECT * FROM masyarakat WHERE nik = '$nik'");
    $row = mysqli_fetch_array($query);
        ?>

<body>
    <!-- Advanced Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="masyarakat.php" class="logo">
                <div class="logo-icon">
                    <i class='bx bx-layer'></i>
                </div>
                <span>CITIZEN</span>
            </a>
        </div>
        
        <nav class="nav-menu">
            <div class="nav-item">
                <a href="masyarakat.php" class="nav-link">
                    <i class='bx bx-grid-alt nav-icon'></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="masyarakat.php?aksi=tambah-pengaduan" class="nav-link active">
                    <i class='bx bx-message-square-detail nav-icon'></i>
                    <span>Submit Pengaduan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="masyarakat.php?aksi=lihat-pengaduan" class="nav-link">
                    <i class='bx bx-bookmark nav-icon'></i>
                    <span>Lihat Tanggapan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="masyarakat.php?aksi=edit-profile" class="nav-link">
                    <i class='bx bx-user nav-icon'></i>
                    <span>Profile</span>
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
            <div class="search-box">
                
                <input type="text" class="search-input" placeholder="Cari pengaduan, status, atau informasi...">
            </div>
        </div>
        
        <div class="header-right">
            <button class="notification-btn">
                <i class='bx bx-bell'></i>
                <div class="notification-badge"></div>
            </button>
            
            <div class="user-profile">
                <img src="../../img/lol.png" alt="Profile" class="user-avatar">
                <div class="user-info">
                    <h6><?php echo $_SESSION['email'] ?></h6>
                    <p>Masyarakat</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-grid">
            <!-- Guidelines -->
            <div>
                <div class="content-card fade-in-up" style="margin-bottom: 1.5rem;">
                    <h3 class="card-title">
                        <div class="card-icon">
                            <i class='bx bx-bulb'></i>
                        </div>
                        💡 Panduan Melapor yang Baik
                    </h3>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 1rem; display: flex; align-items: flex-start; gap: 0.75rem;">
                            <i class='bx bx-check-circle' style="color: #00ffaaff; font-size: 1.2rem; margin-top: 0.1rem;"></i>
                            <span>Sertakan foto atau dokumen pendukung bila memungkinkan.</span>
                        </li>
                        <li style="margin-bottom: 1rem; display: flex; align-items: flex-start; gap: 0.75rem;">
                            <i class='bx bx-check-circle' style="color: #00ffaaff; font-size: 1.2rem; margin-top: 0.1rem;"></i>
                            <span>Cantumkan lokasi kejadian selengkap mungkin (alamat, RT/RW)</span>
                        </li>
                        <li style="margin-bottom: 1rem; display: flex; align-items: flex-start; gap: 0.75rem;">
                            <i class='bx bx-check-circle' style="color: #00ffaaff; font-size: 1.2rem; margin-top: 0.1rem;"></i>
                            <span>Gunakan bahasa sopan, jelas, dan mudah dipahami.</span>
                        </li>
                        <li style="display: flex; align-items: flex-start; gap: 0.75rem;">
                            <i class='bx bx-check-circle' style="color: #00ffaaff; font-size: 1.2rem; margin-top: 0.1rem;"></i>
                            <span>Pastikan semua data sudah benar sebelum menekan tombol kirim.</span>
                        </li>
                    </ul>
                </div>

                <div class="content-card fade-in-up">
                    <h3 class="card-title">
                        <div class="card-icon">
                            <i class='bx bx-time'></i>
                        </div>
                        ⏳ Estimasi Waktu Proses
                    </h3>
                    <div class="progress-container">
                        <div class="progress-label">
                            <span>Verifikasi Awal</span>
                            <span>1-2 hari kerja</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill" style="width: 25%"></div>
                        </div>
                    </div>
                    <div class="progress-container">
                        <div class="progress-label">
                            <span>Peninjauan</span>
                            <span>3-7 hari kerja</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill" style="width: 60%"></div>
                        </div>
                    </div>
                    <div class="progress-container">
                        <div class="progress-label">
                            <span>Penyelesaian</span>
                            <span>Tergantung kompleksitas</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="form-container fade-in-up">
                <h3 class="card-title">
                    <div class="card-icon">
                        <i class='bx bx-edit'></i>
                    </div>
                    Form Pengaduan
                </h3>
                
                <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 1rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 0.75rem;">
                    <i class='bx bx-info-circle' style="color: #3b82f6; font-size: 1.2rem;"></i>
                    <span style="color: #1e40af; font-weight: 500;">Pastikan data yang anda masukkan benar dan jelas.</span>
                </div>

                <form action="switch_masyarakat.php?aksi=tambah-pengaduan" method="post">
                    <div class="form-group">
                        <label class="form-label">📅 Tanggal Pengaduan</label>
                        <input class="form-control" type="text" name="tgl_pengaduan" value="<?php echo date('Y/m/d'); ?>" readonly />
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">🆔 NIK</label>
                        <input type="text" class="form-control" name="nik" value="<?= $row['nik']; ?>" readonly />
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">📝 Isi Laporan</label>
                        <textarea class="form-control" name="isi_laporan" placeholder="Tuliskan laporan anda di sini dengan detail..." style="height: 200px; resize: vertical;" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">📷 Foto Pendukung</label>
                        <input type="hidden" class="upload-care" name="foto" role="uploadcare-uploader" data-public-key="38882543888abfb41547" data-images-only />
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">📊 Status</label>
                        <select class="form-control" name="status">
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn-primary-custom" style="width: 100%; margin-top: 1rem;">
                        <i class='bx bx-send'></i>
                        Kirim Laporan
                    </button>
                    
                    <p style="text-align: center; margin-top: 1rem; color: var(--text-black); opacity: 0.7; font-size: 0.9rem;">
                        ⚡ Data anda dijamin aman dan rahasia.
                    </p>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>

<?php
        break;

    case 'lihat-pengaduan':
    include '../koneksi/koneksi.php';
    $nik = $_SESSION['nik'];
?>

<body>
    <!-- Advanced Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="masyarakat.php" class="logo">
                <div class="logo-icon">
                    <i class='bx bx-layer'></i>
                </div>
                <span>CITIZEN</span>
            </a>
        </div>
        
        <nav class="nav-menu">
            <div class="nav-item">
                <a href="masyarakat.php" class="nav-link">
                    <i class='bx bx-grid-alt nav-icon'></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="masyarakat.php?aksi=tambah-pengaduan" class="nav-link">
                    <i class='bx bx-message-square-detail nav-icon'></i>
                    <span>Submit Pengaduan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="masyarakat.php?aksi=lihat-pengaduan" class="nav-link active">
                    <i class='bx bx-bookmark nav-icon'></i>
                    <span>Lihat Tanggapan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="masyarakat.php?aksi=edit-profile" class="nav-link">
                    <i class='bx bx-user nav-icon'></i>
                    <span>Profile</span>
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
            <div class="search-box">
                
                <input type="text" class="search-input" placeholder="Cari pengaduan, status, atau informasi...">
            </div>
        </div>
        
        <div class="header-right">
            <button class="notification-btn">
                <i class='bx bx-bell'></i>
                <div class="notification-badge"></div>
            </button>
            
            <div class="user-profile">
                <img src="../../img/lol.png" alt="Profile" class="user-avatar">
                <div class="user-info">
                    <h6><?php echo $_SESSION['email'] ?></h6>
                    <p>Masyarakat</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero-section fade-in-up">
            <h1 class="hero-title">📋 Daftar Pengaduan Anda</h1>
            <p class="hero-subtitle">Pantau status dan perkembangan setiap laporan yang telah Anda sampaikan.</p>
        </section>

        <!-- Stats Grid -->
        <section class="stats-grid fade-in-up">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class='bx bx-file'></i>
                </div>
                <div class="stat-title">Total Pengaduan</div>
                <div class="stat-value">
                    <?php 
                    $total = mysqli_num_rows(mysqli_query($config, "SELECT * FROM pengaduan WHERE nik='$nik'"));
                    echo $total;
                    ?>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class='bx bx-time'></i>
                </div>
                <div class="stat-title">Pending</div>
                <div class="stat-value">
                    <?php 
                    $pending = mysqli_num_rows(mysqli_query($config, "SELECT * FROM pengaduan WHERE nik='$nik' AND status='pending'"));
                    echo $pending;
                    ?>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class='bx bx-x-circle'></i>
                </div>
                <div class="stat-title">Decline</div>
                <div class="stat-value">
                    <?php 
                    $decline = mysqli_num_rows(mysqli_query($config, "SELECT * FROM pengaduan WHERE nik='$nik' AND status='decline'"));
                    echo $decline;
                    ?>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class='bx bx-check-circle'></i>
                </div>
                <div class="stat-title">Accept</div>
                <div class="stat-value">
                    <?php 
                    $accept = mysqli_num_rows(mysqli_query($config, "SELECT * FROM pengaduan WHERE nik='$nik' AND status='accept'"));
                    echo $accept;
                    ?>
                </div>
            </div>
        </section>

        <!-- Table Section -->
        <section class="content-card fade-in-up">
            <h3 class="card-title">
                <div class="card-icon">
                    <i class='bx bx-list-ul'></i>
                </div>
                Riwayat Pengaduan Lengkap
            </h3>
            
            <div class="table-responsive">
                <table class="advanced-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NIK</th>
                            <th>Isi Laporan</th>
                            <th>Foto</th>
                            <th>Tanggapan</th>
                            <th>Status</th>
                            <th>Aksi</th>
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
                        ORDER BY pengaduan.tgl_pengaduan DESC
                        ");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['tgl_pengaduan'])) ?></td>
                                <td><?php echo $row['nik'] ?></td>
                                <td><?php echo substr($row['isi_laporan'], 0, 100) . '...' ?></td>
                                <td>
                                    <?php if($row['foto']): ?>
                                        <img src="<?= $row['foto'] ?>" alt="foto" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                    <?php else: ?>
                                        <span style="color: #9ca3af;">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $row['tanggapan'] ? substr($row['tanggapan'], 0, 50) . '...' : '-' ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo $row['status'] ?>">
                                        <?php echo ucfirst($row['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="masyarakat.php?aksi=edit-pengaduan&id_pengaduan=<?php echo $row['id_pengaduan'] ?>" class="action-btn edit">
                                        <i class='bx bx-edit-alt'></i>
                                    </a>
                                    <a href="switch_masyarakat.php?aksi=hapus&id_pengaduan=<?php echo $row['id_pengaduan'] ?>" class="action-btn delete" onclick="return confirm('Yakin ingin menghapus pengaduan ini?')">
                                        <i class='bx bx-trash'></i>
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
        
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>

<?php
    break;

    case 'edit-profile':
    include '../koneksi/koneksi.php';
    $nik = $_SESSION['nik'];
    $query = mysqli_query($config, "SELECT * FROM masyarakat WHERE nik = '$nik'");
    $row = mysqli_fetch_assoc($query);
?>

<body>
    <!-- Advanced Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="masyarakat.php" class="logo">
                <div class="logo-icon">
                    <i class='bx bx-layer'></i>
                </div>
                <span>CITIZEN</span>
            </a>
        </div>
        
        <nav class="nav-menu">
            <div class="nav-item">
                <a href="masyarakat.php" class="nav-link">
                    <i class='bx bx-grid-alt nav-icon'></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="masyarakat.php?aksi=tambah-pengaduan" class="nav-link">
                    <i class='bx bx-message-square-detail nav-icon'></i>
                    <span>Submit Pengaduan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="masyarakat.php?aksi=lihat-pengaduan" class="nav-link">
                    <i class='bx bx-bookmark nav-icon'></i>
                    <span>Lihat Tanggapan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="masyarakat.php?aksi=edit-profile" class="nav-link active">
                    <i class='bx bx-user nav-icon'></i>
                    <span>Profile</span>
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
            <div class="search-box">
                
                <input type="text" class="search-input" placeholder="Cari pengaduan, status, atau informasi...">
            </div>
        </div>
        
        <div class="header-right">
            <button class="notification-btn">
                <i class='bx bx-bell'></i>
                <div class="notification-badge"></div>
            </button>
            
            <div class="user-profile">
                <img src="../../img/lol.png" alt="Profile" class="user-avatar">
                <div class="user-info">
                    <h6><?php echo $_SESSION['email'] ?></h6>
                    <p>Masyarakat</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-grid">
            <!-- Profile Sidebar -->
            <div class="content-card fade-in-up">
                <div style="text-align: center; padding: 2rem 0;">
                    <div style="position: relative; display: inline-block; margin-bottom: 2rem;">
                        <img src="../../img/lol.png" alt="Profile" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 4px solid var(--bg-sidebar); box-shadow: var(--shadow-medium);">
                        <div style="position: absolute; bottom: 0; right: 0; width: 40px; height: 40px; background: var(--secondary-gradient); border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: var(--shadow-light);">
                            <i class='bx bx-camera' style="color: white; font-size: 1.2rem;"></i>
                        </div>
                    </div>
                    
                    <h4 style="margin: 0 0 0.5rem 0; color: var(--title); font-weight: 700;"><?= $row['nama']; ?></h4>
                    <p style="margin: 0 0 2rem 0; color: var(--text-black); opacity: 0.7;">@<?= $row['email']; ?></p>
                    
                    <div style="display: flex; flex-direction: column; gap: 1rem; text-align: left;">
                        <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: rgba(59, 130, 246, 0.1); border-radius: 12px;">
                            <div style="width: 40px; height: 40px; background: var(--secondary-gradient); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class='bx bx-phone' style="color: white;"></i>
                            </div>
                            <div>
                                <p style="margin: 0; font-size: 0.8rem; color: var(--text-black); opacity: 0.7;">Telepon</p>
                                <p style="margin: 0; font-weight: 600; color: var(--title);"><?= $row['telp']; ?></p>
                            </div>
                        </div>
                        
                        <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: rgba(59, 130, 246, 0.1); border-radius: 12px;">
                            <div style="width: 40px; height: 40px; background: var(--secondary-gradient); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class='bx bx-id-card' style="color: white;"></i>
                            </div>
                            <div>
                                <p style="margin: 0; font-size: 0.8rem; color: var(--text-black); opacity: 0.7;">NIK</p>
                                <p style="margin: 0; font-weight: 600; color: var(--title);"><?= $row['nik']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="form-container fade-in-up">
                <h3 class="card-title">
                    <div class="card-icon">
                        <i class='bx bx-edit'></i>
                    </div>
                    Edit Profile
                </h3>
                
                <form action="switch_masyarakat.php?aksi=edit-profile" method="post">
                    <input type="hidden" name="nik_lama" value="<?= $row['nik'] ?>">

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                        <div class="form-group">
                            <label class="form-label">👤 Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" value="<?= $row['nama'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">🔤 email</label>
                            <input type="text" class="form-control" name="email" value="<?= $row['email'] ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">📱 No. Telepon</label>
                        <input type="tel" class="form-control" name="telp" value="<?= $row['telp'] ?>" required pattern="[0-9]{10,13}">
                    </div>

                    <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
                        <a href="masyarakat.php" style="padding: 1rem 2rem; background: rgba(239, 68, 68, 0.1); color: #dc2626; border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 12px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                            <i class='bx bx-x'></i>
                            Batal
                        </a>
                        <button type="submit" class="btn-primary-custom">
                            <i class='bx bx-save'></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>

<?php
break;
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>