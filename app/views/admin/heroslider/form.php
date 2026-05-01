<?php
$isEdit     = !empty($slide['id']);
$pageTitle  = $isEdit ? 'Edit Foto Slider' : 'Tambah Foto Slider';
$activeMenu = 'heroslider';
$actionUrl  = $isEdit
    ? APP_URL . '/admin/heroslider/update/' . $slide['id']
    : APP_URL . '/admin/heroslider/store';
require APP_ROOT . '/app/views/layouts/admin_layout.php';
?>

<div style="margin-bottom:1.2rem">
  <a href="<?= APP_URL ?>/admin/heroslider" class="btn btn-outline btn-sm">← Kembali</a>
</div>

<div class="form-card">
  <div class="form-card-title">
    <?= $isEdit ? 'Edit Foto Slider' : 'Tambah Foto Slider Baru' ?>
  </div>

  <form method="POST" action="<?= $actionUrl ?>" enctype="multipart/form-data">

    <div class="form-group">
      <label for="urutan">Urutan Tampil</label>
      <input type="number" id="urutan" name="urutan"
             value="<?= htmlspecialchars($slide['urutan'] ?? '0') ?>"
             min="0" placeholder="0" style="max-width:120px;" />
      <div class="form-hint">Angka kecil tampil lebih dulu.</div>
    </div>

    <div class="form-group">
      <label for="foto">Foto <span class="required">*</span></label>

      <?php if (!empty($slide['foto_url'])): ?>
        <div style="margin-bottom:0.8rem; border-radius:6px; overflow:hidden; max-height:200px;">
          <img src="<?= htmlspecialchars($slide['foto_url']) ?>"
               alt="Foto saat ini"
               style="width:100%; height:200px; object-fit:cover;" />
        </div>
        <p style="font-size:0.72rem; color:var(--warm-gray); margin-bottom:0.5rem;">
          Upload baru untuk mengganti foto di atas.
        </p>
        <input type="hidden" name="foto_url_lama" value="<?= htmlspecialchars($slide['foto_url']) ?>" />
      <?php endif; ?>

      <input type="file" id="foto" name="foto"
             accept="image/jpeg,image/png,image/webp"
             onchange="previewFoto(this)"
             class="<?= isset($errors['foto']) ? 'is-error' : '' ?>"
             style="width:100%; padding:0.6rem 0.8rem;
                    background:var(--base-light);
                    border:1.5px dashed rgba(28,31,33,0.2);
                    border-radius:var(--radius-sm);
                    font-family:var(--font-body);
                    font-size:0.85rem; color:var(--warm-gray); cursor:pointer;" />
      <div class="form-hint">Format: JPG, PNG, WebP. Maks. 5MB. Disarankan rasio 16:9 atau landscape.</div>
      <?php if (isset($errors['foto'])): ?>
        <div class="field-error"><?= $errors['foto'] ?></div>
      <?php endif; ?>

      <div id="fotoPreview" style="display:none; margin-top:0.8rem; border-radius:6px; overflow:hidden; max-height:200px;">
        <img id="fotoPreviewImg" src="" alt="Preview"
             style="width:100%; height:200px; object-fit:cover;" />
      </div>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-primary">
        <?= $isEdit ? 'Simpan Perubahan' : 'Simpan Foto' ?>
      </button>
      <a href="<?= APP_URL ?>/admin/heroslider" class="btn btn-outline">Batal</a>
    </div>

  </form>
</div>

<script>
function previewFoto(input) {
  const preview = document.getElementById('fotoPreview');
  const img     = document.getElementById('fotoPreviewImg');
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => { img.src = e.target.result; preview.style.display = 'block'; };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

<?php require APP_ROOT . '/app/views/layouts/admin_footer.php'; ?>