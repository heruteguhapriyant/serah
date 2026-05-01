<?php
// app/views/layouts/public_header.php
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base = parse_url(APP_URL, PHP_URL_PATH);
$path = '/' . trim(str_replace($base, '', $currentPath), '/');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $pageTitle ?? APP_NAME ?> — <?= APP_TAGLINE ?></title>
  <link rel="stylesheet" href="<?= APP_URL ?>/css/style.css" />
</head>
<body>

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

    <!-- Label + Logo Sponsor Utama -->
    <div style="display:flex; align-items:center; gap:0.6rem;">
      <span style="font-size:0.62rem; font-weight:500; letter-spacing:0.12em;
                  text-transform:uppercase; color:var(--warm-gray); white-space:nowrap;">
        Didukung oleh
      </span>
      <a href="https://www.djarumfoundation.org/" target="_blank" rel="noopener nofollow">
        <img src="<?= APP_URL ?>/img/logo-sponsor-utama.png"
            alt="Djarum Foundation"
            style="height:110px; width:auto; display:block; opacity:0.85; transition:opacity 0.2s;"
            onmouseover="this.style.opacity='1'"
            onmouseout="this.style.opacity='0.85'" />
      </a>
    </div>

  </div>

  <!-- KANAN: Navigasi -->
  <ul class="navbar-links">
    <li><a href="<?= APP_URL ?>/"        class="<?= $path === '/'        ? 'active' : '' ?>">Beranda</a></li>
    <li><a href="<?= APP_URL ?>/program" class="<?= $path === '/program' ? 'active' : '' ?>">Program</a></li>
    <li><a href="<?= APP_URL ?>/rekap"   class="<?= $path === '/rekap'   ? 'active' : '' ?>">Rekap Kegiatan</a></li>
  </ul>

</nav>

<div class="page-wrap">
