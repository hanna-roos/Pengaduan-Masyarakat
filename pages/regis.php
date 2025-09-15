<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Registrasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            background: linear-gradient(135deg, 
                var(--bg-sidebar) 0%, 
                #1e3a8a 25%, 
                #3b82f6 50%, 
                #60a5fa 75%, 
                var(--bg-web) 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(10, 36, 114, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(0, 28, 85, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(59, 130, 246, 0.2) 0%, transparent 50%);
            pointer-events: none;
        }

        .container-fluid {
            position: relative;
            z-index: 1;
        }

        .registration-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .registration-card {
            background: rgba(248, 250, 252, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            width: 100%;
            max-width: 420px;
            max-width: 360px;
            padding: 0;
            overflow: hidden;
            position: relative;
            animation: slideInUp 0.8s ease-out;
        }

        .registration-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        .registration-card::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            animation: rotate 20s linear infinite;
            z-index: -1;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-body {
            padding: 2rem 1.75rem;
            position: relative;
            z-index: 1;
        }

        .registration-title {
            color: var(--title);
            font-weight: 700;
            font-size: 1.6rem;
            margin-bottom: 1.5rem;
            text-align: center;
            position: relative;
            text-shadow: 0 2px 4px rgba(0, 7, 45, 0.1);
        }

        .registration-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--bg-sidebar), var(--bg-button));
            border-radius: 2px;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
                transform: translateX(-50%) scaleX(1);
            }
            50% {
                opacity: 0.7;
                transform: translateX(-50%) scaleX(1.1);
            }
        }

        .form-group {
            margin-bottom: 0.85rem;
            position: relative;
        }

        .form-group label {
            color: var(--text-black);
            font-weight: 500;
            font-size: 0.85rem;
            margin-bottom: 0.4rem;
            display: block;
            position: relative;
        }

        .form-group label::before {
            content: '';
            position: absolute;
            left: -12px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 4px;
            background: var(--bg-sidebar);
            border-radius: 50%;
            opacity: 0.6;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            padding: 0.65rem 0.9rem;
            font-size: 0.95rem;
            font-weight: 400;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            position: relative;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.95);
            border-color: var(--bg-sidebar);
            box-shadow: 0 0 0 3px rgba(10, 36, 114, 0.1);
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: #9ca3af;
            font-weight: 400;
        }

        .input-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--bg-sidebar);
            opacity: 0.5;
            font-size: 1.1rem;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .form-group:focus-within .input-icon {
            opacity: 0.8;
            transform: translateY(-50%) scale(1.1);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--bg-sidebar) 0%, var(--bg-button) 100%);
            border: none;
            border-radius: 12px;
            padding: 0.7rem 1.8rem;
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-white);
            width: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            margin-top: 0.6rem;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 28, 85, 0.3);
            color:white;
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .signin-link {
            text-align: center;
            color: var(--text-black);
            font-size: 0.85rem;
        }

        .signin-link a {
            color: var(--bg-sidebar);
            text-decoration: none;
            font-weight: 600;
            position: relative;
            transition: all 0.3s ease;
        }

        .signin-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--bg-sidebar);
            transition: width 0.3s ease;
        }

        .signin-link a:hover {
            color: var(--bg-button);
        }

        .signin-link a:hover::after {
            width: 100%;
        }

        /* Floating animation for background elements */
        .floating-shape {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-shape:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-shape:nth-child(2) {
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .floating-shape:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        .floating-shape:nth-child(4) {
            top: 30%;
            right: 30%;
            animation-delay: 1s;
        }

        .floating-shape:nth-child(5) {
            bottom: 40%;
            right: 20%;
            animation-delay: 3s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .registration-container {
                padding: 0.75rem;
            }
            
            .card-body {
                padding: 1.75rem 1.25rem;
            }
            
            .registration-title {
                font-size: 1.4rem;
            }
        }

        @media (max-width: 480px) {
            .card-body {
                padding: 1.5rem 1rem;
            }
            
            .registration-title {
                font-size: 1.3rem;
            }
            
            .registration-card {
                max-width: 320px;
            }
        }
    </style>

    <style>
    .neuro-spinner {
  width: 64px;
  height: 64px;
  border: 6px solid transparent;
  border-top: 6px solid var(--bg-sidebar);
  border-right: 6px solid var(--bg-button);
  border-radius: 50%;
  animation: spin 1.2s ease-in-out infinite;
  box-shadow: 0 0 16px var(--bg-sidebar), 0 0 24px var(--bg-button) inset;
  background: radial-gradient(
    circle at center,
    rgba(10, 36, 114, 0.15) 0%,
    transparent 70%
  );
  transition: all 0.3s ease;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.complaint-spinner {
  width: 80px;
  height: 80px;
  position: relative;
}

.complaint-spinner::before {
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  border: 4px solid var(--bg-card);
  border-top: 4px solid var(--bg-sidebar);
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

.complaint-spinner::after {
  content: '📢';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 24px;
  animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
  0%, 100% {
    transform: translate(-50%, -50%) scale(1);
  }
  50% {
    transform: translate(-50%, -50%) scale(1.1);
  }
}

.loading-dots {
  display: flex;
  gap: 4px;
  margin-top: 8px;
}

.loading-dots span {
  width: 8px;
  height: 8px;
  background: var(--bg-sidebar);
  border-radius: 50%;
  animation: bounce 1.4s ease-in-out infinite both;
}

.loading-dots span:nth-child(1) { animation-delay: -0.32s; }
.loading-dots span:nth-child(2) { animation-delay: -0.16s; }
.loading-dots span:nth-child(3) { animation-delay: 0s; }

@keyframes bounce {
  0%, 80%, 100% {
    transform: scale(0);
  }
  40% {
    transform: scale(1);
  }
}
</style>
</head>
<body>

    <!-- preloader -->
<div id="preloader" class="fixed inset-0 z-[9999999999999999] bg-white flex items-center justify-center">
    <div class="flex flex-col items-center gap-6">
        <div class="complaint-spinner"></div>
        <div class="text-center">
            <h3 class="text-xl font-semibold mb-2" style="color: var(--title);">
                Platform Pengaduan Masyarakat CITIZEN
            </h3>
            <p class="text-sm font-medium mb-3" style="color: var(--bg-sidebar);">
                Memuat sistem pengaduan...
            </p>
            <div class="loading-dots" style="display: flex; gap: 6px; justify-content: center; align-items: center;">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</div> 

    <!-- Floating background shapes -->
    <div class="floating-shape" style="width: 100px; height: 100px; background: linear-gradient(45deg, var(--bg-sidebar), var(--bg-button)); border-radius: 50%;"></div>
    <div class="floating-shape" style="width: 80px; height: 80px; background: linear-gradient(45deg, var(--bg-button), #3b82f6); border-radius: 30px; transform: rotate(45deg);"></div>
    <div class="floating-shape" style="width: 120px; height: 120px; background: linear-gradient(45deg, #3b82f6, var(--bg-sidebar)); border-radius: 20px;"></div>
    <div class="floating-shape" style="width: 60px; height: 60px; background: linear-gradient(45deg, var(--bg-sidebar), #3b82f6); border-radius: 15px; transform: rotate(30deg);"></div>
    <div class="floating-shape" style="width: 90px; height: 90px; background: linear-gradient(45deg, #3b82f6, var(--bg-button)); border-radius: 50%; opacity: 0.08;"></div>

    <div class="container-fluid">
        <div class="registration-container">
            <div class="registration-card">
                <div class="card-body">
                    <h3 class="registration-title">REGISTRASI</h3>
                    <form action="cek_regis.php" method="post">
                        <div class="form-group">
                            <label for="nik">NIK:</label>
                            <input type="text" class="form-control" name="nik" id="nik" placeholder="Isi NIK Anda" required>
                            <span class="input-icon mt-3">🆔</span>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Lengkap:</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Isi Nama Lengkap Anda" required>
                            <span class="input-icon mt-3">👤</span>
                        </div>

                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Isi Username Anda" required>
                            <span class="input-icon mt-3">🔤</span>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Isi Password Anda" required>
                            <span class="input-icon mt-3">🔒</span>
                        </div>

                        <div class="form-group">
                            <label for="telp">Telepon:</label>
                            <input type="number" class="form-control" name="telp" id="telp" placeholder="Isi No. Telepon Anda" required>
                            <!-- <span class="input-icon mt-3">📱</span> -->
                        </div>

                        <input type="submit" name="submit" value="DAFTAR" class="btn btn-register">
                        
                        <div class="signin-link">
                            Sudah Memiliki Akun? <a href="login.php">Login Sekarang</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="load.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
</html>