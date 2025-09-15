<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beranda</title>
    <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

    <!-- swiper js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!-- css -->
    <link href="style.css" rel="stylesheet" />
  </head>
  <body>

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

<!-- body -->
<section
      class="hero-container h-screen bg-cover bg-center relative"
    >
      <div class="absolute inset-0 bg-black/10 top-0 left-0 w-full h-full overflow-hidden">
        <video 
          class="w-full h-full object-cover scale-150 blur-sm"
          autoplay
          muted
          loop
          playsinline
        >
          <source src="../img/vidbg.mp4" type="video/mp4" />
        </video>
      </div>

      <div class="absolute inset-0 bg-black/10 z-0"></div>
      <div class="floating-circle circle-ai">
        <div class="circle-gradient"></div>
        <img src="https://i.pinimg.com/1200x/e2/80/0a/e2800a7cc16feaaf598db6f66152d609.jpg" alt="" />
        <div class="label">Infrastruktur</div>
      </div>

      <div class="floating-circle circle-health">
        <div class="circle-gradient"></div>
        <img src="https://i.pinimg.com/1200x/91/48/7a/91487a01cecd3617aa51b9496740482a.jpg" alt="" />
        <div class="label">Layanan Publik</div>
      </div>

      <div class="floating-circle circle-edu">
        <div class="circle-gradient"></div>
        <img src="https://i.pinimg.com/736x/17/72/84/177284b07fded8ad7bce419fc514039e.jpg" alt="" />
        <div class="label">Pendidikan</div>
      </div>

      <div class="floating-circle circle-env">
        <div class="circle-gradient"></div>
        <img src="https://i.pinimg.com/736x/84/54/4d/84544ddb9b316abce024f217f7843e7b.jpg" alt="" />
        <div class="label">Lingkungan</div>
      </div>

      <div class="floating-circle circle-tech">
        <div class="circle-gradient"></div>
        <img src="https://i.pinimg.com/736x/81/6a/70/816a70e2ecaa90f11039358f3d189e1a.jpg" alt="" />
        <div class="label">Keamanan</div>
      </div>

      <div class="floating-circle circle-social">
        <div class="circle-gradient"></div>
        <img src="https://i.pinimg.com/736x/27/9b/96/279b963a1603813406c3f6efec942fe2.jpg" alt="" />
        <div class="label">Sosial</div>
      </div>

      <div
        class="hero-content sm:mt-10 flex justify-center items-center sm:block"
      >
        <div class="max-w-4xl mx-auto">
          <div class="hero-badge">Platform Pengaduan Masyarakat CITIZEN</div>

          <h1 class="hero-title">
            Dengar, Tindak, <br />
            Selesaikan.<br />
            
          </h1>

          <a
            href="login.php"
            class="inline-flex items-center justify-center bg-gradient-to-r from-blue-900 to-blue-700 hover:from-blue-800 hover:to-blue-600 text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-xl hover:shadow-blue-500/25"
          >
            Buat Pengaduan
          </a>
        </div>
      </div>
    </section>

    <script src="load.js"></script>
  </body>
</html>