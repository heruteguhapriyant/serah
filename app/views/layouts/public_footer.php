<?php // app/views/layouts/public_footer.php ?>

</div><!-- .page-wrap -->

<!-- MODAL KONFIRMASI PDF -->
<div class="modal-overlay" id="pdfModal">
  <div class="modal-box">
    <div class="modal-icon">📄</div>
    <h3 class="modal-title">Buka Dokumen PDF</h3>
    <p class="modal-desc" id="modalDesc">
      Apakah Anda ingin melihat rekap kegiatan ini?<br>
      Dokumen akan dibuka di tab baru.
    </p>
    <div class="modal-actions">
      <button class="btn btn-outline" onclick="closeModal()">Batal</button>
      <a href="#" class="btn btn-primary" id="modalPdfLink" target="_blank" rel="noopener" onclick="closeModal()">
        Ya, Buka PDF →
      </a>
    </div>
  </div>
</div>

<footer class="footer">
  <div class="footer-grid">
    <div>
      <div class="footer-brand-name">SERAH<span>.</span></div>
      <div class="footer-tagline">Ruang Literasi Seni &amp; Pertunjukan</div>
      <p class="footer-about">
        Ruang temu publik untuk membaca karya, mendiskusikan gagasan, serta menyaksikan pertunjukan sebagai refleksi kebudayaan.
      </p>
      <div class="footer-socials">
        <a class="social-btn" href="https://www.instagram.com/serah.hub/" target="_blank" rel="noopener nofollow">ig</a>
        <a class="social-btn" href="https://www.youtube.com/@serah-hub" target="_blank" rel="noopener nofollow">yt</a>
      </div>
    </div>
    <div class="footer-col">
      <h4>Navigasi</h4>
      <ul>
        <li><a href="<?= APP_URL ?>/">Beranda</a></li>
        <li><a href="<?= APP_URL ?>/program">Program</a></li>
        <li><a href="<?= APP_URL ?>/rekap">Rekap Kegiatan</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Contact</h4>
      <address>
       +62 889-8024-6368<br>
        <a>suratserah@gmail.com</a>
      </address>
    </div>
  </div>

  <?php
  $partnerModel = new MediaPartnerModel();
  $partners     = $partnerModel->getAll();
  ?>

  <?php if (!empty($partners)): ?>
  <div style="border-top:1px solid rgba(255,255,255,0.06);
              padding:2rem 0 2.5rem; position:relative; z-index:1;">
    <p style="font-size:0.62rem; font-weight:500; letter-spacing:0.16em;
              text-transform:uppercase; color:rgba(255,255,255,0.2);
              margin-bottom:1.2rem;">Media Partner</p>
    <div style="display:flex; align-items:center; gap:2.5rem; flex-wrap:wrap;">
      <?php foreach ($partners as $index => $mp): ?>
        <a href="<?= !empty($mp['url']) ? htmlspecialchars($mp['url']) : '#' ?>"
          <?php if (!empty($mp['url'])): ?>
            target="_blank" rel="noopener<?= $index !== 0 ? ' nofollow' : '' ?>"
          <?php endif; ?>>
          <img src="<?= htmlspecialchars($mp['logo_url']) ?>"
              alt="<?= htmlspecialchars($mp['nama']) ?>"
              style="height:68px; width:auto; opacity:0.55; transition:opacity 0.2s;"
              onmouseover="this.style.opacity='1'"
              onmouseout="this.style.opacity='0.55'" />
        </a>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>

  <div class="footer-bottom">
    <p>© <?= date('Y') ?> SERAH. Ruang Literasi Seni &amp; Pertunjukan.</p>
    <div class="footer-bottom-links">
      <a href="#" rel="nofollow">Kebijakan Privasi</a>
    </div>
  </div>
</footer>

<script>
  // Navbar scroll
  window.addEventListener('scroll', () => {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 40);
  });

  // Fade-up observer
  const obs = new IntersectionObserver((entries) => {
    entries.forEach((e, i) => {
      if (e.isIntersecting) setTimeout(() => e.target.classList.add('visible'), i * 80);
    });
  }, { threshold: 0.1 });
  document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));

  // PDF Modal
  function openPdfModal(title, pdfUrl) {
    document.getElementById('modalDesc').innerHTML =
      'Apakah Anda ingin melihat rekap kegiatan<br><strong>"' + title + '"</strong>?<br><span style="font-size:0.82rem;color:#6B7478">Dokumen akan dibuka di tab baru.</span>';
    document.getElementById('modalPdfLink').href = pdfUrl;
    document.getElementById('pdfModal').classList.add('open');
  }
  function closeModal() {
    document.getElementById('pdfModal').classList.remove('open');
  }
  document.getElementById('pdfModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
  });
</script>
</body>
</html>
