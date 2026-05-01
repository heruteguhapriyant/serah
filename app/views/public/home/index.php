<?php
// app/views/public/home/index.php
$pageTitle = 'Beranda';
require APP_ROOT . '/app/views/layouts/public_header.php';
?>

<!-- HERO -->
<section class="hero">
  <div class="hero-left">
    <div class="section-eyebrow">Ruang Literasi Seni &amp; Pertunjukan</div>
    <h1 class="hero-title">
      <em>SERAH</em>
      <span class="hero-sub">Berjumpa dalam<br>karya</span>
    </h1>
    <p class="hero-desc">
      Sebuah forum literasi seni dan pertunjukan yang menjadi ruang temu publik untuk membaca karya, mendiskusikan gagasan, serta menyaksikan pertunjukan sebagai refleksi kebudayaan.
    </p>
    <div class="hero-actions">
      <a href="<?= APP_URL ?>/rekap" class="btn btn-primary">Rekap Kegiatan</a>
      <a href="<?= APP_URL ?>/program" class="btn btn-ghost">Lihat Program →</a>
    </div>
  </div>
  <div class="hero-right" style="position:relative; overflow:hidden;">

    <?php if (!empty($slides)): ?>
      <!-- SLIDER -->
      <div id="heroSlider" style="position:relative; width:100%; height:100%;">

        <?php foreach ($slides as $i => $s): ?>
          <div class="slide"
              style="position:absolute; inset:0;
                      opacity:<?= $i === 0 ? '1' : '0' ?>;
                      transition:opacity 0.8s ease;
                      background:#1C1F21;">
            <img src="<?= htmlspecialchars($s['foto_url']) ?>"
                alt="Slide <?= $i + 1 ?>"
                style="width:100%; height:100%; object-fit:cover;" />
          </div>
        <?php endforeach; ?>

        <!-- Overlay gelap tipis -->
        <div style="position:absolute; inset:0; background:rgba(28,31,33,0.25); z-index:1;"></div>

        <!-- Dots navigasi -->
        <?php if (count($slides) > 1): ?>
          <div style="position:absolute; bottom:1.5rem; left:50%; transform:translateX(-50%);
                      display:flex; gap:0.5rem; z-index:2;">
            <?php foreach ($slides as $i => $s): ?>
              <button onclick="goToSlide(<?= $i ?>)"
                      id="dot-<?= $i ?>"
                      style="width:<?= $i === 0 ? '24px' : '8px' ?>; height:8px;
                            border-radius:4px; border:none; cursor:pointer;
                            background:<?= $i === 0 ? 'white' : 'rgba(255,255,255,0.4)' ?>;
                            transition:all 0.3s ease; padding:0;"></button>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

      </div>

    <?php else: ?>
      <!-- Fallback jika belum ada foto slider -->
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
      </svg>
      <div class="hero-wordmark">
        <img src="<?= APP_URL ?>/img/logo-serah.png" alt="SERAH"
            style="width:clamp(300px,55vw,700px); height:auto; opacity:0.06;
                    filter:brightness(0) invert(1); pointer-events:none;" />
      </div>
    <?php endif; ?>

  </div>

  <script>
  (function() {
    const slides = document.querySelectorAll('#heroSlider .slide');
    const dots   = document.querySelectorAll('[id^="dot-"]');
    if (slides.length <= 1) return;

    let current = 0;

    window.goToSlide = function(index) {
      slides[current].style.opacity = '0';
      dots[current].style.width     = '8px';
      dots[current].style.background = 'rgba(255,255,255,0.4)';

      current = index;

      slides[current].style.opacity = '1';
      dots[current].style.width     = '24px';
      dots[current].style.background = 'white';
    };

    // Auto-play 5 detik
    setInterval(() => {
      goToSlide((current + 1) % slides.length);
    }, 5000);
  })();
  </script>
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
        <div class="program-card fade-up" style="cursor:pointer"
             onclick="window.location='<?= APP_URL ?>/program/<?= $p['id'] ?>'">
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
          <div style="padding:0.9rem 1.6rem; border-top:1px solid rgba(28,31,33,0.06);
                      background:var(--base-light); display:flex; justify-content:flex-end;">
            <span class="btn btn-ghost btn-sm" style="color:var(--terracotta)">
              Baca Selengkapnya →
            </span>
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