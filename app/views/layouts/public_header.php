<nav class="navbar" id="navbar">

  <!-- KIRI: Logo SERAH + Sponsor Utama -->
  <div style="display:flex; align-items:center; gap:1.2rem;">

    <!-- Logo SERAH (ganti src dengan path logo kamu) -->
    <a href="<?= APP_URL ?>/">
      <img src="<?= APP_URL ?>/img/logo-serah.png"
           alt="SERAH"
           style="height:36px; width:auto; display:block;" />
    </a>

    <!-- Garis pemisah -->
    <span style="width:1px; height:28px; background:rgba(28,31,33,0.15);"></span>

    <!-- Logo Sponsor Utama -->
    <a href="https://URL-WEBSITE-SPONSOR-UTAMA.com" target="_blank" rel="noopener"
       title="Sponsor Utama">
      <img src="<?= APP_URL ?>/img/logo-sponsor-utama.png"
           alt="Sponsor Utama"
           style="height:28px; width:auto; display:block; opacity:0.85; transition:opacity 0.2s;"
           onmouseover="this.style.opacity='1'"
           onmouseout="this.style.opacity='0.85'" />
    </a>

  </div>

  <!-- KANAN: Navigasi -->
  <ul class="navbar-links">
    <li><a href="<?= APP_URL ?>/"        class="<?= $path === '/'        ? 'active' : '' ?>">Beranda</a></li>
    <li><a href="<?= APP_URL ?>/program" class="<?= $path === '/program' ? 'active' : '' ?>">Program</a></li>
    <li><a href="<?= APP_URL ?>/rekap"   class="<?= $path === '/rekap'   ? 'active' : '' ?>">Rekap Kegiatan</a></li>
  </ul>

</nav>