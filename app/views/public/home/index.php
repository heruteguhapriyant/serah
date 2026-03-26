<?php
// app/views/public/home/index.php
$pageTitle = 'Beranda';
require APP_ROOT . '/app/views/layouts/public_header.php';
?>

<!-- HERO -->
<section class="hero">
  <div class="hero-left">
    <div class="section-eyebrow">Forum Literasi Seni &amp; Pertunjukan</div>
    <h1 class="hero-title">
      <em>SERAH</em>
      <span class="hero-sub">Ruang temu untuk<br>seni &amp; gagasan</span>
    </h1>
    <p class="hero-desc">
      Sebuah forum literasi seni dan pertunjukan yang menjadi ruang temu publik untuk membaca karya, mendiskusikan gagasan, serta menyaksikan pertunjukan sebagai bentuk refleksi kebudayaan.
    </p>
    <div class="hero-actions">
      <a href="<?= APP_URL ?>/rekap" class="btn btn-primary">Rekap Kegiatan</a>
      <a href="<?= APP_URL ?>/program" class="btn btn-ghost">Lihat Program →</a>
    </div>
  </div>
  <div class="hero-right">
    <svg class="bg-art" viewBox="0 0 700 800" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <radialGradient id="g1" cx="25%" cy="65%">
          <stop offset="0%" stop-color="#B85C38" stop-opacity="0.28"/>
          <stop offset="100%" stop-color="#2A4240" stop-opacity="0"/>
        </radialGradient>
        <radialGradient id="g2" cx="75%" cy="25%">
          <stop offset="0%" stop-color="#C8973A" stop-opacity="0.18"/>
          <stop offset="100%" stop-color="#2A4240" stop-opacity="0"/>
        </radialGradient>
      </defs>
      <rect width="700" height="800" fill="#2A4240"/>
      <ellipse cx="175" cy="520" rx="380" ry="380" fill="url(#g1)"/>
      <ellipse cx="525" cy="200" rx="280" ry="280" fill="url(#g2)"/>
      <circle cx="130" cy="130" r="100" fill="none" stroke="rgba(200,151,58,0.1)" stroke-width="1"/>
      <circle cx="130" cy="130" r="65"  fill="none" stroke="rgba(200,151,58,0.06)" stroke-width="1"/>
      <circle cx="580" cy="650" r="150" fill="none" stroke="rgba(184,92,56,0.08)" stroke-width="1"/>
      <line x1="0" y1="400" x2="700" y2="400" stroke="rgba(255,255,255,0.03)" stroke-width="1"/>
      <line x1="350" y1="0" x2="350" y2="800" stroke="rgba(255,255,255,0.03)" stroke-width="1"/>
      <rect x="260" y="180" width="180" height="180" fill="none" stroke="rgba(200,151,58,0.07)" stroke-width="1" transform="rotate(18 350 270)"/>
    </svg>
    <div class="hero-wordmark">SERAH</div>
    <div class="hero-stats">
      <div class="stat">
        <div class="stat-n"><?= count($programs) ?>+</div>
        <div class="stat-l">Program</div>
      </div>
      <div class="stat">
        <div class="stat-n"><?= count($rekaps) ?>+</div>
        <div class="stat-l">Rekap Kegiatan</div>
      </div>
      <div class="stat">
        <div class="stat-n">∞</div>
        <div class="stat-l">Gagasan</div>
      </div>
    </div>
  </div>
</section>

<!-- MARQUEE -->
<div class="marquee-strip">
  <div class="marquee-track">
    <?php $items = ['Literasi Seni','Pertunjukan','Refleksi Kebudayaan','Diskusi Gagasan','Membaca Karya','Forum Publik','Literasi Seni','Pertunjukan','Refleksi Kebudayaan','Diskusi Gagasan','Membaca Karya','Forum Publik']; ?>
    <?php foreach ($items as $item): ?>
      <span class="m-item"><?= $item ?></span><span class="m-dot"></span>
    <?php endforeach; ?>
  </div>
</div>

<!-- PROGRAM TERBARU -->
<section class="section section-light">
  <div class="section-header split">
    <div>
      <div class="section-eyebrow">Program</div>
      <h2 class="section-title">Kegiatan <em>Terkini</em></h2>
    </div>
    <a href="<?= APP_URL ?>/program" class="btn btn-ghost">Semua Program →</a>
  </div>

  <?php if (empty($programs)): ?>
    <div class="empty-state">
      <div class="empty-icon">🎭</div>
      <p>Belum ada program yang ditambahkan.</p>
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
            <div class="program-card-date">
              <?= date('d M Y', strtotime($p['tanggal'])) ?>
            </div>
            <h3 class="program-card-title"><?= htmlspecialchars($p['judul']) ?></h3>
            <p class="program-card-desc"><?= htmlspecialchars($p['deskripsi']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>

<!-- REKAP TERBARU -->
<section class="section section-dark">
  <div class="section-header split">
    <div>
      <div class="section-eyebrow" style="color:var(--gold)"><span style="background:var(--gold);display:inline-block;width:24px;height:1.5px;margin-right:0.5rem;vertical-align:middle"></span>Rekap Kegiatan</div>
      <h2 class="section-title light">Dokumentasi <em style="color:var(--gold)">Kegiatan</em></h2>
    </div>
    <a href="<?= APP_URL ?>/rekap" class="btn btn-ghost" style="color:var(--gold)">Semua Rekap →</a>
  </div>

  <?php if (empty($rekaps)): ?>
    <div class="empty-state" style="color:rgba(255,255,255,0.3)">
      <div class="empty-icon">📄</div>
      <p>Belum ada rekap kegiatan.</p>
    </div>
  <?php else: ?>
    <div class="rekap-grid">
      <?php foreach ($rekaps as $r): ?>
        <div class="rekap-card fade-up" onclick="openPdfModal('<?= htmlspecialchars(addslashes($r['judul'])) ?>', '<?= htmlspecialchars($r['pdf_url']) ?>')">
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
