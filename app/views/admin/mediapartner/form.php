<?php
$isEdit     = !empty($partner['id']);
$pageTitle  = $isEdit ? 'Edit Media Partner' : 'Tambah Media Partner';
$activeMenu = 'mediapartner';
$actionUrl  = $isEdit
    ? APP_URL . '/admin/mediapartner/update/' . $partner['id']
    : APP_URL . '/admin/mediapartner/store';
require APP_ROOT . '/app/views/layouts/admin_layout.php';
?>

<div style="margin-bottom:1.2rem">
  <a href="<?= APP_URL ?>/admin/mediapartner" class="btn btn-outline btn-sm">← Kembali</a>
</div>

<div class="form-card">
  <div class="form-card-title">
    <?= $isEdit ? 'Edit Media Partner' : 'Tambah Media Partner Baru' ?>
  </div>

  <form method="POST" action="<?= $actionUrl ?>" enctype="multipart/form-data">

    <div class="form-group">
      <label for="nama">Nama Media Partner <span class="required">*</span></label>
      <input type="text" id="nama" name="nama"
             value="<?= htmlspecialchars($partner['nama'] ?? '') ?>"
             class="<?= isset($errors['nama']) ? 'is-error' : '' ?>"
             placeholder="Cth: Kompas, Tempo, RRI" required />
      <?php if (isset($errors['nama'])): ?>
        <div class="field-error"><?= $errors['nama'] ?></div>
      <?php endif; ?>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="url">URL Website <span style="color:var(--warm-gray);font-weight:300">(opsional)</span></label>
        <input type="url" id="url" name="url"
               value="<?= htmlspecialchars($partner['url'] ?? '') ?>"
               placeholder="https://www.contoh.com" />
        <div class="form-hint">Link ketika logo diklik oleh pengunjung.</div>
      </div>

      <div class="form-group">
        <label for="urutan">Urutan Tampil</label>
        <input type="number" id="urutan" name="urutan"
               value="<?= htmlspecialchars($partner['urutan'] ?? '0') ?>"
               min="0" placeholder="0" />
        <div class="form-hint">Angka kecil tampil lebih dulu. Default: 0.</div>
      </div>
    </div>

    <div class="form-group">
      <label for="logo">Logo <span class="required">*</span></label>

      <?php if (!empty($partner['logo_url'])): ?>
        <div style="margin-bottom:0.8rem; padding:1rem;
                    background:var(--dark); border-radius:6px; display:inline-block;">
          <img src="<?= htmlspecialchars($partner['logo_url']) ?>"
               alt="Logo saat ini"
               style="height:50px; width:auto; object-fit:contain; display:block;" />
        </div>
        <p style="font-size:0.72rem; color:var(--warm-gray); margin-bottom:0.5rem;">
          Upload baru untuk mengganti logo di atas.
        </p>
        <input type="hidden" name="logo_url_lama"
               value="<?= htmlspecialchars($partner['logo_url']) ?>" />
      <?php endif; ?>

      <input type="file" id="logo" name="logo"
             accept="image/jpeg,image/png,image/webp,image/svg+xml"
             onchange="previewLogo(this)"
             class="<?= isset($errors['logo']) ? 'is-error' : '' ?>"
             style="width:100%; padding:0.6rem 0.8rem;
                    background:var(--base-light);
                    border:1.5px dashed rgba(28,31,33,0.2);
                    border-radius:var(--radius-sm);
                    font-family:var(--font-body);
                    font-size:0.85rem; color:var(--warm-gray); cursor:pointer;" />
      <div class="form-hint">Format: JPG, PNG, WebP, SVG. Maks. 2MB. Disarankan format PNG/SVG dengan background transparan.</div>
      <?php if (isset($errors['logo'])): ?>
        <div class="field-error"><?= $errors['logo'] ?></div>
      <?php endif; ?>

      <div id="logoPreview" style="display:none; margin-top:0.8rem;
           padding:1rem; background:var(--dark); border-radius:6px; display:none;">
        <img id="logoPreviewImg" src="" alt="Preview"
             style="height:50px; width:auto; object-fit:contain; display:block;" />
      </div>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-primary">
        <?= $isEdit ? 'Simpan Perubahan' : 'Simpan Partner' ?>
      </button>
      <a href="<?= APP_URL ?>/admin/mediapartner" class="btn btn-outline">Batal</a>
    </div>

  </form>
</div>

<script>
function previewLogo(input) {
  const preview = document.getElementById('logoPreview');
  const img     = document.getElementById('logoPreviewImg');
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      img.src = e.target.result;
      preview.style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

<?php require APP_ROOT . '/app/views/layouts/admin_footer.php'; ?>