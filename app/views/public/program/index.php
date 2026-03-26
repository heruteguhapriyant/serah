<?php
// app/views/public/program/index.php
$pageTitle = 'Program';
require APP_ROOT . '/app/views/layouts/public_header.php';
?>

<div class="page-hero" data-title="PROGRAM">
  <div class="breadcrumb">
    <a href="<?= APP_URL ?>/">Beranda</a>
    <span>›</span>
    <span>Program</span>
  </div>
  <div class="section-eyebrow">Kegiatan</div>
  <h1>Program & <em>Kegiatan</em></h1>
  <p>Seluruh program dan kegiatan yang diselenggarakan oleh Forum Literasi Seni &amp; Pertunjukan SERAH.</p>
</div>

<section class="section section-light">
  <?php if (empty($programs)): ?>
    <div class="empty-state">
      <div class="empty-icon">🎭</div>
      <p>Belum ada program yang tersedia saat ini.</p>
    </div>
  <?php else: ?>
    <div class="cards-grid">
      <?php foreach ($programs as $p): ?>
        <div class="program-card fade-up">
          <div class="program-card-img">
            <?php if (!empty($p['foto_url'])): ?>
              <img src="<?= htmlspecialchars($p['foto_url']) ?>" alt="<?= htmlspecialchars($p['judul']) ?>" loading="lazy" />
            <?php else: ?>
              <div class="program-card-img-placeholder">S</div>
            <?php endif; ?>
          </div>
          <div class="program-card-body">
            <div class="program-card-date"><?= date('d M Y', strtotime($p['tanggal'])) ?></div>
            <h3 class="program-card-title"><?= htmlspecialchars($p['judul']) ?></h3>
            <p class="program-card-desc"><?= htmlspecialchars($p['deskripsi']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>

<?php require APP_ROOT . '/app/views/layouts/public_footer.php'; ?>
