<?php
// app/views/admin/dashboard.php
$pageTitle  = 'Dashboard';
$activeMenu = 'dashboard';
require APP_ROOT . '/app/views/layouts/admin_layout.php';
?>

<div class="stat-cards">
  <div class="stat-card">
    <div class="stat-card-label">Total Program</div>
    <div class="stat-card-value"><?= $stats['programs'] ?></div>
  </div>
  <div class="stat-card">
    <div class="stat-card-label">Rekap Kegiatan</div>
    <div class="stat-card-value"><?= $stats['rekaps'] ?></div>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
  <!-- Quick Actions -->
  <div class="table-wrap" style="padding:0">
    <div class="table-header">
      <h3>Aksi Cepat</h3>
    </div>
    <div style="padding:1.5rem;display:flex;flex-direction:column;gap:0.8rem">
      <a href="<?= APP_URL ?>/admin/program/create" class="btn btn-primary">
        + Tambah Program Baru
      </a>
      <a href="<?= APP_URL ?>/admin/rekap/create" class="btn btn-dark">
        + Tambah Rekap Kegiatan
      </a>
      <a href="<?= APP_URL ?>/" target="_blank" class="btn btn-outline">
        ↗ Lihat Website Publik
      </a>
    </div>
  </div>

  <!-- Info -->
  <div class="table-wrap" style="padding:0">
    <div class="table-header">
      <h3>Informasi Sistem</h3>
    </div>
    <div style="padding:1.5rem">
      <table style="width:100%">
        <tbody>
          <tr>
            <td style="padding:0.5rem 0;font-size:0.82rem;color:var(--warm-gray)">Nama Aplikasi</td>
            <td style="padding:0.5rem 0;font-size:0.82rem;font-weight:500"><?= APP_NAME ?></td>
          </tr>
          <tr>
            <td style="padding:0.5rem 0;font-size:0.82rem;color:var(--warm-gray)">Admin Aktif</td>
            <td style="padding:0.5rem 0;font-size:0.82rem;font-weight:500"><?= htmlspecialchars($_SESSION['username']) ?></td>
          </tr>
          <tr>
            <td style="padding:0.5rem 0;font-size:0.82rem;color:var(--warm-gray)">Tanggal</td>
            <td style="padding:0.5rem 0;font-size:0.82rem;font-weight:500"><?= date('d M Y, H:i') ?> WIB</td>
          </tr>
          <tr>
            <td style="padding:0.5rem 0;font-size:0.82rem;color:var(--warm-gray)">PHP Version</td>
            <td style="padding:0.5rem 0;font-size:0.82rem;font-weight:500"><?= PHP_VERSION ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php require APP_ROOT . '/app/views/layouts/admin_footer.php'; ?>
