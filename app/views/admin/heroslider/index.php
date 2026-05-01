<?php
$pageTitle  = 'Kelola Hero Slider';
$activeMenu = 'heroslider';
require APP_ROOT . '/app/views/layouts/admin_layout.php';
?>

<div class="table-wrap">
  <div class="table-header">
    <h3>Foto Hero Slider</h3>
    <a href="<?= APP_URL ?>/admin/heroslider/create" class="btn btn-primary btn-sm">+ Tambah Foto</a>
  </div>

  <?php if (empty($slides)): ?>
    <div class="empty-state">
      <div class="empty-icon">🖼️</div>
      <p>Belum ada foto slider. <a href="<?= APP_URL ?>/admin/heroslider/create" style="color:var(--terracotta)">Tambah sekarang →</a></p>
    </div>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Urutan</th>
          <th>Foto</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($slides as $s): ?>
          <tr>
            <td style="color:var(--warm-gray); text-align:center; width:80px;"><?= $s['urutan'] ?></td>
            <td>
              <img src="<?= htmlspecialchars($s['foto_url']) ?>"
                   alt="Slide <?= $s['id'] ?>"
                   style="height:60px; width:100px; object-fit:cover; border-radius:4px;" />
            </td>
            <td class="td-actions">
              <a href="<?= APP_URL ?>/admin/heroslider/edit/<?= $s['id'] ?>" class="btn btn-outline btn-sm">Edit</a>
              <form method="POST" action="<?= APP_URL ?>/admin/heroslider/delete/<?= $s['id'] ?>"
                    style="display:inline" onsubmit="return confirm('Hapus foto slider ini?')">
                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require APP_ROOT . '/app/views/layouts/admin_footer.php'; ?>