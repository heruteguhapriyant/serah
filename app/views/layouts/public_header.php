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
  <a href="<?= APP_URL ?>/" class="navbar-brand">
    SERAH<span>.</span>
  </a>
  <ul class="navbar-links">
    <li><a href="<?= APP_URL ?>/"        class="<?= $path === '/'        ? 'active' : '' ?>">Beranda</a></li>
    <li><a href="<?= APP_URL ?>/program" class="<?= $path === '/program' ? 'active' : '' ?>">Program</a></li>
    <li><a href="<?= APP_URL ?>/rekap"   class="<?= $path === '/rekap'   ? 'active' : '' ?>">Rekap Kegiatan</a></li>
  </ul>
</nav>

<div class="page-wrap">
