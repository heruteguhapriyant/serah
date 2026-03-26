<?php
// app/views/admin/program/index.php
$pageTitle  = 'Kelola Program';
$activeMenu = 'program';
require APP_ROOT . '/app/views/layouts/admin_layout.php';
?>

<div class="table-wrap">
  <div class="table-header">
    <h3>Daftar Program</h3>
    <a href="<?= APP_URL ?>/admin/program/create" class="btn btn-primary btn-sm">+ Tambah Program</a>
  </div>

  <?php if (empty($programs)): ?>
    <div class="empty-state">
      <div class="empty-icon">🎭</div>
      <p>Belum ada program. <a href="<?= APP_URL ?>/admin/program/create" style="color:var(--terracotta)">Tambah sekarang →</a></p>
    </div>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Judul</th>
          <th>Deskripsi</th>
          <th>Tanggal</th>
          <th>Foto URL</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($programs as $i => $p): ?>
          <tr>
            <td style="color:var(--warm-gray);font-size:0.8rem"><?= $i + 1 ?></td>
            <td class="td-title"><?= htmlspecialchars($p['judul']) ?></td>
            <td class="td-desc"><?= htmlspecialchars($p['deskripsi']) ?></td>
            <td class="td-date"><?= date('d M Y', strtotime($p['tanggal'])) ?></td>
            <td class="td-url">
              <?php if (!empty($p['foto_url'])): ?>
                <a href="<?= htmlspecialchars($p['foto_url']) ?>" target="_blank">Lihat Foto ↗</a>
              <?php else: ?>
                <span style="color:var(--warm-gray);font-size:0.8rem">—</span>
              <?php endif; ?>
            </td>
            <td class="td-actions">
              <a href="<?= APP_URL ?>/admin/program/edit/<?= $p['id'] ?>" class="btn btn-outline btn-sm">Edit</a>
              <form method="POST" action="<?= APP_URL ?>/admin/program/delete/<?= $p['id'] ?>" style="display:inline"
                    onsubmit="return confirm('Hapus program ini?')">
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
