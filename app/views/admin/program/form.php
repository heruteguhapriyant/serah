<?php
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

<div class="form-card" style="max-width:800px">
  <div class="form-card-title">
    <?= $isEdit ? 'Edit Program' : 'Tambah Program Baru' ?>
  </div>

  <form method="POST" action="<?= $actionUrl ?>" enctype="multipart/form-data">

    <!-- JUDUL -->
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

    <!-- DESKRIPSI SINGKAT -->
    <div class="form-group">
      <label for="deskripsi">Deskripsi Singkat <span class="required">*</span></label>
      <textarea id="deskripsi" name="deskripsi"
                class="<?= isset($errors['deskripsi']) ? 'is-error' : '' ?>"
                placeholder="Teks singkat yang tampil di kartu program..."
                style="min-height:80px"
                required><?= htmlspecialchars($program['deskripsi'] ?? '') ?></textarea>
      <div class="form-hint">Teks ini yang muncul di kartu pada halaman publik.</div>
      <?php if (isset($errors['deskripsi'])): ?>
        <div class="field-error"><?= $errors['deskripsi'] ?></div>
      <?php endif; ?>
    </div>

    <!-- TANGGAL & FOTO -->
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
        <label for="foto">Foto Program <span style="color:var(--warm-gray);font-weight:300">(opsional)</span></label>

        <?php if (!empty($program['foto_url'])): ?>
          <div style="margin-bottom:0.7rem; border-radius:6px; overflow:hidden; height:140px;">
            <img src="<?= htmlspecialchars($program['foto_url']) ?>"
                 alt="Foto saat ini"
                 style="width:100%; height:100%; object-fit:cover;" />
          </div>
          <p style="font-size:0.72rem; color:var(--warm-gray); margin-bottom:0.5rem;">
            Upload baru untuk mengganti foto di atas.
          </p>
          <input type="hidden" name="foto_url_lama"
                 value="<?= htmlspecialchars($program['foto_url']) ?>" />
        <?php endif; ?>

        <input type="file" id="foto" name="foto"
               accept="image/jpeg,image/png,image/webp"
               onchange="previewFoto(this)"
               style="width:100%; padding:0.6rem 0.8rem;
                      background:var(--base-light);
                      border:1.5px dashed rgba(28,31,33,0.2);
                      border-radius:var(--radius-sm);
                      font-family:var(--font-body);
                      font-size:0.85rem; color:var(--warm-gray); cursor:pointer;" />
        <div class="form-hint">Format: JPG, PNG, WebP. Maks. 2MB.</div>

        <div id="fotoPreview" style="display:none; margin-top:0.7rem;
             border-radius:6px; overflow:hidden; height:140px;">
          <img id="fotoPreviewImg" src="" alt="Preview"
               style="width:100%; height:100%; object-fit:cover;" />
        </div>
      </div>
    </div>

    <!-- ISI LENGKAP -->
    <div class="form-group">
      <label for="isi">Isi / Konten Lengkap <span style="color:var(--warm-gray);font-weight:300">(opsional)</span></label>
      <textarea id="isi" name="isi"
                placeholder="Tulis isi lengkap program di sini. Bisa berisi rundown, deskripsi mendalam, catatan, dsb..."
                style="min-height:280px; font-size:0.9rem; line-height:1.7"><?= htmlspecialchars($program['isi'] ?? '') ?></textarea>
      <div class="form-hint">Konten ini tampil di halaman detail saat kartu program diklik.</div>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-primary">
        <?= $isEdit ? 'Simpan Perubahan' : 'Simpan Program' ?>
      </button>
      <a href="<?= APP_URL ?>/admin/program" class="btn btn-outline">Batal</a>
    </div>

  </form>
</div>

<script>
function previewFoto(input) {
  const preview = document.getElementById('fotoPreview');
  const img     = document.getElementById('fotoPreviewImg');
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