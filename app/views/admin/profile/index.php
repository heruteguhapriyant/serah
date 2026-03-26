<?php
// app/views/admin/profile/index.php
$pageTitle  = 'Profil Admin';
$activeMenu = 'profile';
require APP_ROOT . '/app/views/layouts/admin_layout.php';
?>

<style>
/* ── Profile Page Styles ── */
.profile-grid {
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 1.8rem;
  max-width: 960px;
}

/* Identity Card */
.profile-identity {
  background: var(--white);
  border-radius: var(--radius);
  border: 1px solid rgba(28,31,33,.07);
  overflow: hidden;
}
.profile-identity-top {
  background: var(--dark);
  padding: 2.5rem 1.8rem;
  display: flex; flex-direction: column; align-items: center; gap: .9rem;
  position: relative; overflow: hidden;
}
.profile-identity-top::before {
  content: '';
  position: absolute; inset: 0;
  background:
    radial-gradient(ellipse at 20% 0%,   rgba(200,151,58,.18) 0%, transparent 60%),
    radial-gradient(ellipse at 85% 100%, rgba(184,92,56,.15)  0%, transparent 55%);
}
.profile-avatar {
  width: 76px; height: 76px; border-radius: 50%;
  background: linear-gradient(135deg, var(--terracotta), #e07550);
  display: flex; align-items: center; justify-content: center;
  font-family: var(--font-display);
  font-size: 2rem; font-weight: 900; color: white;
  box-shadow: 0 8px 24px rgba(184,92,56,.4);
  border: 3px solid rgba(255,255,255,.12);
  position: relative; z-index: 1;
}
.profile-identity-name {
  font-family: var(--font-display);
  font-size: 1.15rem; font-weight: 700; color: white;
  position: relative; z-index: 1; text-align: center;
}
.profile-identity-role {
  font-size: .63rem; font-weight: 500;
  letter-spacing: .18em; text-transform: uppercase;
  color: var(--gold); position: relative; z-index: 1;
}
.profile-identity-meta { padding: 1.2rem 1.6rem; }
.meta-row {
  display: flex; justify-content: space-between; align-items: center;
  padding: .7rem 0;
  border-bottom: 1px solid rgba(28,31,33,.06);
  font-size: .82rem;
}
.meta-row:last-child { border-bottom: none; }
.meta-label { color: var(--warm-gray); font-size: .68rem; text-transform: uppercase; letter-spacing: .1em; }
.meta-value { font-weight: 500; color: var(--dark); }
.status-dot {
  display: inline-flex; align-items: center; gap: .4rem;
  font-size: .72rem; font-weight: 500; color: var(--success);
}
.status-dot::before {
  content: ''; width: 6px; height: 6px; border-radius: 50%;
  background: var(--success); box-shadow: 0 0 6px rgba(39,174,96,.5);
}

/* Form Card */
.profile-form-card {
  background: var(--white);
  border-radius: var(--radius);
  border: 1px solid rgba(28,31,33,.07);
  overflow: hidden;
}
.pfc-header {
  padding: 1.5rem 1.8rem;
  border-bottom: 1px solid rgba(28,31,33,.07);
  display: flex; align-items: center; gap: .9rem;
}
.pfc-icon {
  width: 36px; height: 36px; border-radius: var(--radius-sm);
  background: rgba(184,92,56,.1);
  display: flex; align-items: center; justify-content: center;
  font-size: 1rem; color: var(--terracotta); flex-shrink: 0;
}
.pfc-title { font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; }
.pfc-subtitle { font-size: .74rem; color: var(--warm-gray); margin-top: .1rem; }
.pfc-body { padding: 1.8rem; }

/* Section label */
.section-label {
  font-size: .62rem; font-weight: 500;
  letter-spacing: .16em; text-transform: uppercase;
  color: var(--warm-gray);
  display: flex; align-items: center; gap: .75rem;
  margin-bottom: 1.3rem;
}
.section-label::after {
  content: ''; flex: 1; height: 1px; background: rgba(28,31,33,.08);
}

/* Input with icon */
.input-wrap { position: relative; }
.input-icon {
  position: absolute; left: .9rem; top: 50%; transform: translateY(-50%);
  font-size: .85rem; color: var(--warm-gray); pointer-events: none;
  transition: color var(--transition);
}
.input-wrap input { padding-left: 2.5rem !important; }
.input-wrap:focus-within .input-icon { color: var(--terracotta); }

/* Password section */
.pw-section { margin-top: 1.8rem; padding-top: 1.8rem; }
.pw-note {
  background: rgba(28,31,33,.03);
  border: 1px solid rgba(28,31,33,.07);
  border-radius: var(--radius-sm);
  padding: .7rem 1rem;
  font-size: .79rem; color: var(--warm-gray);
  display: flex; align-items: flex-start; gap: .5rem;
  margin-bottom: 1.3rem; line-height: 1.5;
}
.pw-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; }

/* Strength bar */
.pw-strength { margin-top: .45rem; }
.pw-bars { display: flex; gap: 3px; margin-bottom: .28rem; }
.pw-bar {
  height: 3px; flex: 1; border-radius: 2px;
  background: rgba(28,31,33,.1); transition: background .3s;
}
.pw-bar.weak   { background: var(--error); }
.pw-bar.medium { background: var(--gold); }
.pw-bar.strong { background: var(--success); }
.pw-label { font-size: .67rem; color: var(--warm-gray); }

/* Match hint */
.match-ok  { font-size: .72rem; color: var(--success); margin-top: .35rem; }
.match-err { font-size: .72rem; color: var(--error);   margin-top: .35rem; }

/* Form actions */
.pfc-actions {
  display: flex; justify-content: flex-end; align-items: center; gap: .75rem;
  padding: 1.2rem 1.8rem;
  border-top: 1px solid rgba(28,31,33,.07);
  background: var(--base-light);
}
.pfc-actions-note { margin-right: auto; font-size: .73rem; color: var(--warm-gray); }

/* Animate in */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(12px); }
  to   { opacity: 1; transform: translateY(0); }
}
.profile-grid > * { animation: fadeUp .38s ease both; }
.profile-grid > *:nth-child(2) { animation-delay: .07s; }
</style>

<?php if (!empty($success)): ?>
  <div class="alert alert-success">✓ <?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<div class="profile-grid">

  <!-- ── Identity Card ── -->
  <div class="profile-identity">
    <div class="profile-identity-top">
      <div class="profile-avatar">
        <?= strtoupper(substr($admin['username'], 0, 1)) ?>
      </div>
      <div class="profile-identity-name"><?= htmlspecialchars($admin['username']) ?></div>
      <div class="profile-identity-role">Administrator</div>
    </div>
    <div class="profile-identity-meta">
      <div class="meta-row">
        <span class="meta-label">Status</span>
        <span class="status-dot">Aktif</span>
      </div>
      <div class="meta-row">
        <span class="meta-label">Peran</span>
        <span class="meta-value">Super Admin</span>
      </div>
      <div class="meta-row">
        <span class="meta-label">Login Terakhir</span>
        <span class="meta-value" style="font-size:.78rem"><?= date('d M Y, H:i') ?></span>
      </div>
    </div>
  </div>

  <!-- ── Form Card ── -->
  <div class="profile-form-card">
    <div class="pfc-header">
      <div class="pfc-icon">✎</div>
      <div>
        <div class="pfc-title">Edit Profil</div>
        <div class="pfc-subtitle">Perbarui username dan password akun Anda</div>
      </div>
    </div>

    <form method="POST" action="<?= APP_URL ?>/admin/profile/update">
      <div class="pfc-body">

        <!-- Username -->
        <div class="section-label">Informasi Akun</div>
        <div class="form-group">
          <label for="username">Username <span class="required">*</span></label>
          <div class="input-wrap">
            <span class="input-icon">@</span>
            <input type="text" id="username" name="username"
                   value="<?= htmlspecialchars($admin['username']) ?>"
                   class="<?= !empty($errors['username']) ? 'is-error' : '' ?>"
                   required autocomplete="username" />
          </div>
          <?php if (!empty($errors['username'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['username']) ?></div>
          <?php endif; ?>
        </div>

        <!-- Password -->
        <div class="pw-section">
          <div class="section-label">Ubah Password</div>

          <div class="pw-note">
            <span style="flex-shrink:0">ℹ</span>
            Biarkan kosong jika tidak ingin mengubah password.
          </div>

          <div class="form-group">
            <label for="current_password">Password Saat Ini</label>
            <div class="input-wrap">
              <span class="input-icon">🔒</span>
              <input type="password" id="current_password" name="current_password"
                     class="<?= !empty($errors['current_password']) ? 'is-error' : '' ?>"
                     autocomplete="current-password" />
            </div>
            <?php if (!empty($errors['current_password'])): ?>
              <div class="field-error"><?= htmlspecialchars($errors['current_password']) ?></div>
            <?php endif; ?>
          </div>

          <div class="pw-grid">
            <div class="form-group" style="margin-bottom:0">
              <label for="new_password">
                Password Baru
                <span style="color:var(--warm-gray);font-size:.68rem;font-weight:300;text-transform:none;letter-spacing:0">
                  (min. 8 karakter)
                </span>
              </label>
              <div class="input-wrap">
                <span class="input-icon">✦</span>
                <input type="password" id="new_password" name="new_password"
                       class="<?= !empty($errors['new_password']) ? 'is-error' : '' ?>"
                       autocomplete="new-password"
                       oninput="checkStrength(this.value)" />
              </div>
              <div class="pw-strength">
                <div class="pw-bars">
                  <div class="pw-bar" id="b1"></div>
                  <div class="pw-bar" id="b2"></div>
                  <div class="pw-bar" id="b3"></div>
                  <div class="pw-bar" id="b4"></div>
                </div>
                <div class="pw-label" id="pwLabel">—</div>
              </div>
              <?php if (!empty($errors['new_password'])): ?>
                <div class="field-error"><?= htmlspecialchars($errors['new_password']) ?></div>
              <?php endif; ?>
            </div>

            <div class="form-group" style="margin-bottom:0">
              <label for="confirm_password">Konfirmasi Password Baru</label>
              <div class="input-wrap">
                <span class="input-icon">✦</span>
                <input type="password" id="confirm_password" name="confirm_password"
                       class="<?= !empty($errors['confirm_password']) ? 'is-error' : '' ?>"
                       autocomplete="new-password"
                       oninput="checkMatch()" />
              </div>
              <div id="matchHint"></div>
              <?php if (!empty($errors['confirm_password'])): ?>
                <div class="field-error"><?= htmlspecialchars($errors['confirm_password']) ?></div>
              <?php endif; ?>
            </div>
          </div><!-- /pw-grid -->

        </div><!-- /pw-section -->

      </div><!-- /pfc-body -->

      <div class="pfc-actions">
        <span class="pfc-actions-note">* Wajib diisi</span>
        <a href="<?= APP_URL ?>/admin/dashboard" class="btn btn-outline btn-sm">Batal</a>
        <button type="submit" class="btn btn-primary btn-sm">✓ Simpan Perubahan</button>
      </div>
    </form>
  </div><!-- /profile-form-card -->

</div><!-- /profile-grid -->

<script>
function checkStrength(val) {
  const bars  = ['b1','b2','b3','b4'].map(id => document.getElementById(id));
  const label = document.getElementById('pwLabel');
  bars.forEach(b => b.className = 'pw-bar');
  if (!val) { label.textContent = '—'; label.style.color = ''; return; }
  let s = 0;
  if (val.length >= 8)  s++;
  if (val.length >= 12) s++;
  if (/[A-Z]/.test(val) && /[0-9]/.test(val)) s++;
  if (/[^A-Za-z0-9]/.test(val)) s++;
  const cls = ['weak','weak','medium','strong'];
  const txt = ['Terlalu pendek','Lemah','Sedang','Kuat','Sangat kuat'];
  const col = ['#C0392B','#C0392B','#C8973A','#27AE60','#27AE60'];
  for (let i = 0; i < s; i++) bars[i].classList.add(cls[Math.min(s-1,3)]);
  label.textContent = txt[s];
  label.style.color = col[s];
  checkMatch();
}
function checkMatch() {
  const np = document.getElementById('new_password').value;
  const cp = document.getElementById('confirm_password').value;
  const el = document.getElementById('matchHint');
  if (!cp) { el.textContent = ''; el.className = ''; return; }
  if (np === cp) { el.textContent = '✓ Password cocok'; el.className = 'match-ok'; }
  else           { el.textContent = '✗ Tidak cocok';    el.className = 'match-err'; }
}
</script>

<?php require APP_ROOT . '/app/views/layouts/admin_footer.php'; ?>