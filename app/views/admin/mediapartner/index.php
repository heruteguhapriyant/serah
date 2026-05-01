<?php
$pageTitle  = 'Kelola Media Partner';
$activeMenu = 'mediapartner';
require APP_ROOT . '/app/views/layouts/admin_layout.php';
?>

<div class="table-wrap">
  <div class="table-header">
    <h3>Daftar Media Partner</h3>
    <a href="<?= APP_URL ?>/admin/mediapartner/create" class="btn btn-primary btn-sm">+ Tambah Partner</a>
  </div>

  <?php if (empty($partners)): ?>
    <div class="empty-state">
      <div class="empty-icon">🤝</div>
      <p>Belum ada media partner. <a href="<?= APP_URL ?>/admin/mediapartner/create" style="color:var(--terracotta)">Tambah sekarang →</a></p>
    </div>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Urutan</th>
          <th>Logo</th>
          <th>Nama</th>
          <th>URL Website</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($partners as $p): ?>
          <tr>
            <td style="color:var(--warm-gray); text-align:center;"><?= $p['urutan'] ?></td>
            <td>
              <img src="<?= htmlspecialchars($p['logo_url']) ?>"
                   alt="<?= htmlspecialchars($p['nama']) ?>"
                   style="height:40px; width:auto; object-fit:contain;
                          background:var(--dark); padding:4px; border-radius:4px;" />
            </td>
            <td class="td-title"><?= htmlspecialchars($p['nama']) ?></td>
            <td class="td-url">
              <?php if (!empty($p['url'])): ?>
                <a href="<?= htmlspecialchars($p['url']) ?>" target="_blank">
                  <?= htmlspecialchars($p['url']) ?> ↗
                </a>
              <?php else: ?>
                <span style="color:var(--warm-gray); font-size:0.8rem">—</span>
              <?php endif; ?>
            </td>
            <td class="td-actions">
              <a href="<?= APP_URL ?>/admin/mediapartner/edit/<?= $p['id'] ?>" class="btn btn-outline btn-sm">Edit</a>
              <form method="POST" action="<?= APP_URL ?>/admin/mediapartner/delete/<?= $p['id'] ?>"
                    style="display:inline" onsubmit="return confirm('Hapus media partner ini?')">
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