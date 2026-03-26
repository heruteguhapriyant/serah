<?php
// app/views/admin/rekap/index.php
$pageTitle  = 'Kelola Rekap Kegiatan';
$activeMenu = 'rekap';
require APP_ROOT . '/app/views/layouts/admin_layout.php';
?>

<div class="table-wrap">
  <div class="table-header">
    <h3>Daftar Rekap Kegiatan</h3>
    <a href="<?= APP_URL ?>/admin/rekap/create" class="btn btn-primary btn-sm">+ Tambah Rekap</a>
  </div>

  <?php if (empty($rekaps)): ?>
    <div class="empty-state">
      <div class="empty-icon">📄</div>
      <p>Belum ada rekap kegiatan. <a href="<?= APP_URL ?>/admin/rekap/create" style="color:var(--terracotta)">Tambah sekarang →</a></p>
    </div>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Judul</th>
          <th>Deskripsi</th>
          <th>Tanggal</th>
          <th>PDF</th>
          <th>Foto</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rekaps as $i => $r): ?>
          <tr>
            <td style="color:var(--warm-gray);font-size:0.8rem"><?= $i + 1 ?></td>
            <td class="td-title"><?= htmlspecialchars($r['judul']) ?></td>
            <td class="td-desc"><?= htmlspecialchars($r['deskripsi']) ?></td>
            <td class="td-date"><?= date('d M Y', strtotime($r['tanggal'])) ?></td>
            <td class="td-url">
              <a href="<?= htmlspecialchars($r['pdf_url']) ?>" target="_blank">
                <span class="badge badge-pdf">PDF ↗</span>
              </a>
            </td>
            <td class="td-url">
              <?php if (!empty($r['foto_url'])): ?>
                <a href="<?= htmlspecialchars($r['foto_url']) ?>" target="_blank">Foto ↗</a>
              <?php else: ?>
                <span style="color:var(--warm-gray);font-size:0.8rem">—</span>
              <?php endif; ?>
            </td>
            <td class="td-actions">
              <a href="<?= APP_URL ?>/admin/rekap/edit/<?= $r['id'] ?>" class="btn btn-outline btn-sm">Edit</a>
              <form method="POST" action="<?= APP_URL ?>/admin/rekap/delete/<?= $r['id'] ?>" style="display:inline"
                    onsubmit="return confirm('Hapus rekap kegiatan ini?')">
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
