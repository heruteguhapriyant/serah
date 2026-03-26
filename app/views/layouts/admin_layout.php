<?php
// app/views/layouts/admin_layout.php
// Usage: require at top of every admin view
// Variables expected: $pageTitle, $activeMenu
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $pageTitle ?? 'Admin' ?> — SERAH Admin</title>
  <link rel="stylesheet" href="<?= APP_URL ?>/css/admin.css" />
</head>
<body>
<div class="admin-layout">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-brand">
      <div class="sidebar-brand-name">SERAH<span>.</span></div>
      <div class="sidebar-brand-sub">Panel Admin</div>
    </div>

    <nav class="sidebar-nav">
      <div class="sidebar-nav-label">Menu Utama</div>
      <a href="<?= APP_URL ?>/admin" class="<?= ($activeMenu ?? '') === 'dashboard' ? 'active' : '' ?>">
        <span class="nav-icon">◈</span> Dashboard
      </a>

      <div class="sidebar-nav-label" style="margin-top:0.8rem">Konten</div>
      <a href="<?= APP_URL ?>/admin/program" class="<?= ($activeMenu ?? '') === 'program' ? 'active' : '' ?>">
        <span class="nav-icon">🎭</span> Program
      </a>
      <a href="<?= APP_URL ?>/admin/rekap" class="<?= ($activeMenu ?? '') === 'rekap' ? 'active' : '' ?>">
        <span class="nav-icon">📄</span> Rekap Kegiatan
      </a>

      <div class="sidebar-nav-label" style="margin-top:0.8rem">Publik</div>
      <a href="<?= APP_URL ?>/" target="_blank">
        <span class="nav-icon">↗</span> Lihat Website
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="user-avatar">A</div>
        <div class="user-info">
          <small>Masuk sebagai</small>
          <strong><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></strong>
        </div>
      </div>
      <a href="<?= APP_URL ?>/admin/logout" class="sidebar-logout">
        ↩ Keluar
      </a>
    </div>
  </aside>

  <!-- MAIN -->
  <main class="admin-main">
    <div class="admin-topbar">
      <div class="topbar-title"><?= $pageTitle ?? 'Dashboard' ?></div>
      <div class="topbar-right">
        <span class="topbar-badge">Admin</span>
      </div>
    </div>
    <div class="admin-content">
