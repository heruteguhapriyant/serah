<?php
$pageTitle = htmlspecialchars($program['judul']);
require APP_ROOT . '/app/views/layouts/public_header.php';
?>

<div class="page-hero" data-title="PROGRAM">
  <div class="breadcrumb">
    <a href="<?= APP_URL ?>/">Beranda</a>
    <span>›</span>
    <a href="<?= APP_URL ?>/program">Program</a>
    <span>›</span>
    <span><?= htmlspecialchars($program['judul']) ?></span>
  </div>
  <div class="section-eyebrow">Program</div>
  <h1><?= htmlspecialchars($program['judul']) ?></h1>
  <p><?= date('d F Y', strtotime($program['tanggal'])) ?></p>
</div>

<section class="section section-light">
  <div style="max-width:820px; margin:0 auto;">

    <!-- FOTO -->
    <?php if (!empty($program['foto_url'])): ?>
    <div style="margin-bottom:2.5rem; border-radius:8px; overflow:hidden; text-align:center;">
        <img src="<?= htmlspecialchars($program['foto_url']) ?>"
            alt="<?= htmlspecialchars($program['judul']) ?>"
            style="max-width:100%; height:auto; display:inline-block; border-radius:8px;" />
    </div>
    <?php endif; ?>

    <!-- META -->
    <div style="display:flex; align-items:center; gap:1.5rem; margin-bottom:2rem;
                padding-bottom:1.5rem; border-bottom:1px solid rgba(28,31,33,0.1);">
      <div style="font-size:0.78rem; color:var(--warm-gray);
                  text-transform:uppercase; letter-spacing:0.1em; font-weight:500;">
        📅 <?= date('d F Y', strtotime($program['tanggal'])) ?>
      </div>
    </div>

    <!-- SHARE -->
    <div style="display:flex; align-items:center; gap:0.8rem; margin-bottom:2rem; flex-wrap:wrap;">
    <span style="font-size:0.72rem; font-weight:500; letter-spacing:0.12em;
                text-transform:uppercase; color:var(--warm-gray);">Bagikan:</span>

    <!-- Copy Link -->
    <button onclick="copyLink()"
            style="display:inline-flex; align-items:center; gap:0.4rem;
                    padding:0.45rem 1rem; border:1.5px solid rgba(28,31,33,0.15);
                    border-radius:3px; background:white; cursor:pointer;
                    font-family:var(--font-body); font-size:0.75rem; font-weight:500;
                    color:var(--dark); transition:all 0.2s;"
            onmouseover="this.style.borderColor='var(--terracotta)';this.style.color='var(--terracotta)'"
            onmouseout="this.style.borderColor='rgba(28,31,33,0.15)';this.style.color='var(--dark)'"
            id="copyBtn">
        🔗 Salin Tautan
    </button>

    <!-- WhatsApp -->
    <a href="https://wa.me/?text=<?= urlencode($program['judul'] . ' — ' . (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>"
        target="_blank" rel="noopener"
        style="display:inline-flex; align-items:center; gap:0.4rem;
                padding:0.45rem 1rem; border:1.5px solid rgba(28,31,33,0.15);
                border-radius:3px; background:white;
                font-size:0.75rem; font-weight:500; color:var(--dark);
                text-decoration:none; transition:all 0.2s;"
        onmouseover="this.style.borderColor='#25D366';this.style.color='#25D366'"
        onmouseout="this.style.borderColor='rgba(28,31,33,0.15)';this.style.color='var(--dark)'">
        WhatsApp
    </a>

    <!-- X / Twitter -->
    <a href="https://twitter.com/intent/tweet?text=<?= urlencode($program['judul']) ?>&url=<?= urlencode((isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>"
        target="_blank" rel="noopener"
        style="display:inline-flex; align-items:center; gap:0.4rem;
                padding:0.45rem 1rem; border:1.5px solid rgba(28,31,33,0.15);
                border-radius:3px; background:white;
                font-size:0.75rem; font-weight:500; color:var(--dark);
                text-decoration:none; transition:all 0.2s;"
        onmouseover="this.style.borderColor='#000';this.style.color='#000'"
        onmouseout="this.style.borderColor='rgba(28,31,33,0.15)';this.style.color='var(--dark)'">
        X / Twitter
    </a>

    <!-- Facebook -->
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode((isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>"
        target="_blank" rel="noopener"
        style="display:inline-flex; align-items:center; gap:0.4rem;
                padding:0.45rem 1rem; border:1.5px solid rgba(28,31,33,0.15);
                border-radius:3px; background:white;
                font-size:0.75rem; font-weight:500; color:var(--dark);
                text-decoration:none; transition:all 0.2s;"
        onmouseover="this.style.borderColor='#1877F2';this.style.color='#1877F2'"
        onmouseout="this.style.borderColor='rgba(28,31,33,0.15)';this.style.color='var(--dark)'">
        Facebook
    </a>
    </div>

    <script>
    function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const btn = document.getElementById('copyBtn');
        btn.textContent = '✓ Tautan Disalin!';
        btn.style.borderColor = 'var(--success, #27AE60)';
        btn.style.color = 'var(--success, #27AE60)';
        setTimeout(() => {
        btn.textContent = '🔗 Salin Tautan';
        btn.style.borderColor = 'rgba(28,31,33,0.15)';
        btn.style.color = 'var(--dark)';
        }, 2000);
    });
    }
    </script>

    <!-- ISI -->
    <?php if (!empty($program['isi'])): ?>
      <div style="font-size:1rem; line-height:1.9; color:var(--dark);
                  font-weight:300; white-space:pre-wrap;">
        <?= htmlspecialchars($program['isi']) ?>
      </div>
    <?php else: ?>
      <div style="font-size:1rem; line-height:1.9; color:var(--warm-gray); font-style:italic;">
        <?= htmlspecialchars($program['deskripsi']) ?>
      </div>
    <?php endif; ?>

    <!-- BACK -->
    <div style="margin-top:3.5rem; padding-top:2rem;
                border-top:1px solid rgba(28,31,33,0.08);">
      <a href="<?= APP_URL ?>/program" class="btn btn-outline">← Kembali ke Program</a>
    </div>

  </div>
</section>

<?php require APP_ROOT . '/app/views/layouts/public_footer.php'; ?>