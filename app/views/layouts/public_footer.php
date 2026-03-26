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
      <div class="footer-tagline">Forum Literasi Seni &amp; Pertunjukan</div>
      <p class="footer-about">
        Ruang temu publik untuk membaca karya, mendiskusikan gagasan, serta menyaksikan pertunjukan sebagai bentuk refleksi kebudayaan.
      </p>
      <div class="footer-socials">
        <a class="social-btn" href="#">ig</a>
        <a class="social-btn" href="#">yt</a>
        <a class="social-btn" href="#">tw</a>
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
      <h4>Kontak</h4>
      <address>
        Forum Literasi Seni &amp; Pertunjukan<br>
        Indonesia<br><br>
        <a href="mailto:info@serah.id">info@serah.id</a>
      </address>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© <?= date('Y') ?> SERAH. Forum Literasi Seni &amp; Pertunjukan.</p>
    <div class="footer-bottom-links">
      <a href="#">Kebijakan Privasi</a>
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
