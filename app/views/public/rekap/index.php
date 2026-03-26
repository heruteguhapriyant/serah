<?php
// app/views/public/rekap/index.php
$pageTitle = 'Rekap Kegiatan';
require APP_ROOT . '/app/views/layouts/public_header.php';
?>

<div class="page-hero" data-title="REKAP">
  <div class="breadcrumb">
    <a href="<?= APP_URL ?>/">Beranda</a>
    <span>›</span>
    <span>Rekap Kegiatan</span>
  </div>
  <div class="section-eyebrow">Dokumentasi</div>
  <h1>Rekap <em>Kegiatan</em></h1>
  <p>Kumpulan rekap dan dokumentasi kegiatan SERAH dalam format PDF. Klik kartu untuk membuka dokumen.</p>
</div>

<section class="section">
  <?php if (empty($rekaps)): ?>
    <div class="empty-state">
      <div class="empty-icon">📄</div>
      <p>Belum ada rekap kegiatan yang tersedia.</p>
    </div>
  <?php else: ?>
    <div class="rekap-grid">
      <?php foreach ($rekaps as $r): ?>
        <div class="rekap-card fade-up"
             onclick="openPdfModal(
               '<?= htmlspecialchars(addslashes($r['judul'])) ?>',
               '<?= htmlspecialchars($r['pdf_url']) ?>'
             )">
          <div class="rekap-card-thumb">
            <?php if (!empty($r['foto_url'])): ?>
              <img src="<?= htmlspecialchars($r['foto_url']) ?>" alt="<?= htmlspecialchars($r['judul']) ?>" loading="lazy" />
            <?php else: ?>
              <div class="rekap-thumb-placeholder">S</div>
            <?php endif; ?>
            <div class="rekap-pdf-badge">📄 PDF</div>
          </div>
          <div class="rekap-card-body">
            <div class="rekap-card-date"><?= date('d M Y', strtotime($r['tanggal'])) ?></div>
            <h3 class="rekap-card-title"><?= htmlspecialchars($r['judul']) ?></h3>
            <p class="rekap-card-desc"><?= htmlspecialchars($r['deskripsi']) ?></p>
          </div>
          <div class="rekap-card-footer">
            <span class="btn btn-ghost btn-sm" style="color:var(--terracotta)">Lihat PDF →</span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>

<?php require APP_ROOT . '/app/views/layouts/public_footer.php'; ?>
