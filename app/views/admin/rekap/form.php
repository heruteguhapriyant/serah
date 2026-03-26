<?php
// app/views/admin/rekap/form.php
$isEdit     = !empty($rekap['id']);
$pageTitle  = $isEdit ? 'Edit Rekap Kegiatan' : 'Tambah Rekap Kegiatan';
$activeMenu = 'rekap';
$actionUrl  = $isEdit
  ? APP_URL . '/admin/rekap/update/' . $rekap['id']
  : APP_URL . '/admin/rekap/store';
require APP_ROOT . '/app/views/layouts/admin_layout.php';
?>

<div style="margin-bottom:1.2rem">
  <a href="<?= APP_URL ?>/admin/rekap" class="btn btn-outline btn-sm">← Kembali</a>
</div>

<div class="form-card">
  <div class="form-card-title">
    <?= $isEdit ? 'Edit Rekap Kegiatan' : 'Tambah Rekap Kegiatan Baru' ?>
  </div>

  <form method="POST" action="<?= $actionUrl ?>">

    <div class="form-group">
      <label for="judul">Judul Kegiatan <span class="required">*</span></label>
      <input type="text" id="judul" name="judul"
             value="<?= htmlspecialchars($rekap['judul'] ?? '') ?>"
             class="<?= isset($errors['judul']) ? 'is-error' : '' ?>"
             placeholder="Cth: Rekap Pertunjukan Malam Literasi #3" required />
      <?php if (isset($errors['judul'])): ?>
        <div class="field-error"><?= $errors['judul'] ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="deskripsi">Deskripsi <span class="required">*</span></label>
      <textarea id="deskripsi" name="deskripsi"
                class="<?= isset($errors['deskripsi']) ? 'is-error' : '' ?>"
                placeholder="Deskripsi singkat isi rekap kegiatan ini..."
                required><?= htmlspecialchars($rekap['deskripsi'] ?? '') ?></textarea>
      <?php if (isset($errors['deskripsi'])): ?>
        <div class="field-error"><?= $errors['deskripsi'] ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="pdf_url">URL PDF Google Drive <span class="required">*</span></label>
      <input type="url" id="pdf_url" name="pdf_url"
             value="<?= htmlspecialchars($rekap['pdf_url'] ?? '') ?>"
             class="<?= isset($errors['pdf_url']) ? 'is-error' : '' ?>"
             placeholder="https://drive.google.com/file/d/..." required />
      <div class="form-hint">
        Paste URL langsung dari Google Drive. Pastikan file sudah di-set akses <strong>"Anyone with the link"</strong> agar bisa dibuka publik.
      </div>
      <?php if (isset($errors['pdf_url'])): ?>
        <div class="field-error"><?= $errors['pdf_url'] ?></div>
      <?php endif; ?>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="tanggal">Tanggal Kegiatan <span class="required">*</span></label>
        <input type="date" id="tanggal" name="tanggal"
               value="<?= htmlspecialchars($rekap['tanggal'] ?? '') ?>"
               class="<?= isset($errors['tanggal']) ? 'is-error' : '' ?>"
               required />
        <?php if (isset($errors['tanggal'])): ?>
          <div class="field-error"><?= $errors['tanggal'] ?></div>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="foto_url">URL Foto Thumbnail <span style="color:var(--warm-gray);font-weight:300">(opsional)</span></label>
        <input type="url" id="foto_url" name="foto_url"
               value="<?= htmlspecialchars($rekap['foto_url'] ?? '') ?>"
               placeholder="https://drive.google.com/..." />
        <div class="form-hint">URL gambar untuk tampilan kartu (Google Drive, Imgur, dsb.)</div>
      </div>
    </div>

    <!-- PDF URL Preview -->
    <?php if (!empty($rekap['pdf_url'])): ?>
      <div class="form-group">
        <label>PDF Saat Ini</label>
        <div style="background:var(--base-light);padding:0.85rem 1rem;border-radius:var(--radius-sm);border:1px solid rgba(28,31,33,0.1);display:flex;align-items:center;gap:0.8rem">
          <span style="font-size:1.2rem">📄</span>
          <a href="<?= htmlspecialchars($rekap['pdf_url']) ?>" target="_blank"
             style="font-size:0.83rem;color:var(--terracotta);word-break:break-all">
            <?= htmlspecialchars($rekap['pdf_url']) ?> ↗
          </a>
        </div>
      </div>
    <?php endif; ?>

    <div class="form-actions">
      <button type="submit" class="btn btn-primary">
        <?= $isEdit ? 'Simpan Perubahan' : 'Simpan Rekap' ?>
      </button>
      <a href="<?= APP_URL ?>/admin/rekap" class="btn btn-outline">Batal</a>
    </div>

  </form>
</div>

<?php require APP_ROOT . '/app/views/layouts/admin_footer.php'; ?>
