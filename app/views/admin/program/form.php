<?php
// app/views/admin/program/form.php
$isEdit     = !empty($program['id']);
$pageTitle  = $isEdit ? 'Edit Program' : 'Tambah Program';
$activeMenu = 'program';
$actionUrl  = $isEdit
  ? APP_URL . '/admin/program/update/' . $program['id']
  : APP_URL . '/admin/program/store';
require APP_ROOT . '/app/views/layouts/admin_layout.php';
?>

<div style="margin-bottom:1.2rem">
  <a href="<?= APP_URL ?>/admin/program" class="btn btn-outline btn-sm">← Kembali</a>
</div>

<div class="form-card">
  <div class="form-card-title">
    <?= $isEdit ? 'Edit Program' : 'Tambah Program Baru' ?>
  </div>

  <form method="POST" action="<?= $actionUrl ?>">

    <div class="form-group">
      <label for="judul">Judul Program <span class="required">*</span></label>
      <input type="text" id="judul" name="judul"
             value="<?= htmlspecialchars($program['judul'] ?? '') ?>"
             class="<?= isset($errors['judul']) ? 'is-error' : '' ?>"
             placeholder="Cth: Pertunjukan Puisi Malam Kebudayaan" required />
      <?php if (isset($errors['judul'])): ?>
        <div class="field-error"><?= $errors['judul'] ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="deskripsi">Deskripsi <span class="required">*</span></label>
      <textarea id="deskripsi" name="deskripsi"
                class="<?= isset($errors['deskripsi']) ? 'is-error' : '' ?>"
                placeholder="Deskripsi singkat tentang program ini..."
                required><?= htmlspecialchars($program['deskripsi'] ?? '') ?></textarea>
      <?php if (isset($errors['deskripsi'])): ?>
        <div class="field-error"><?= $errors['deskripsi'] ?></div>
      <?php endif; ?>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="tanggal">Tanggal Kegiatan <span class="required">*</span></label>
        <input type="date" id="tanggal" name="tanggal"
               value="<?= htmlspecialchars($program['tanggal'] ?? '') ?>"
               class="<?= isset($errors['tanggal']) ? 'is-error' : '' ?>"
               required />
        <?php if (isset($errors['tanggal'])): ?>
          <div class="field-error"><?= $errors['tanggal'] ?></div>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="foto_url">URL Foto <span style="color:var(--warm-gray);font-weight:300">(opsional)</span></label>
        <input type="url" id="foto_url" name="foto_url"
               value="<?= htmlspecialchars($program['foto_url'] ?? '') ?>"
               placeholder="https://drive.google.com/..." />
        <div class="form-hint">URL gambar untuk thumbnail program (Google Drive, Imgur, dsb.)</div>
      </div>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-primary">
        <?= $isEdit ? 'Simpan Perubahan' : 'Simpan Program' ?>
      </button>
      <a href="<?= APP_URL ?>/admin/program" class="btn btn-outline">Batal</a>
    </div>

  </form>
</div>

<?php require APP_ROOT . '/app/views/layouts/admin_footer.php'; ?>
