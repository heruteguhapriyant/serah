<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Admin — SERAH</title>
  <link rel="stylesheet" href="<?= APP_URL ?>/css/admin.css" />
</head>
<body>
<div class="login-page">

  <!-- LEFT: Decorative -->
  <div class="login-left">
    <div class="login-art">
      <div class="login-art-title">SERAH</div>
      <div class="login-art-line"></div>
      <div class="login-art-sub">Panel Admin</div>
    </div>
    <!-- abstract bg circles -->
    <svg style="position:absolute;inset:0;width:100%;height:100%;pointer-events:none" viewBox="0 0 600 700" xmlns="http://www.w3.org/2000/svg">
      <circle cx="100" cy="100" r="180" fill="none" stroke="rgba(200,151,58,0.06)" stroke-width="1"/>
      <circle cx="500" cy="600" r="200" fill="none" stroke="rgba(184,92,56,0.06)" stroke-width="1"/>
      <circle cx="300" cy="350" r="120" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="1"/>
    </svg>
  </div>

  <!-- RIGHT: Form -->
  <div class="login-right">
    <div class="login-box">
      <div class="login-header">
        <h1>Masuk</h1>
        <p>Gunakan kredensial admin untuk mengakses panel pengelolaan SERAH.</p>
      </div>

      <?php if (!empty($error)): ?>
        <div class="alert alert-error">
          ⚠ <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="<?= APP_URL ?>/admin/login">
        <div class="form-group">
          <label for="username">Username <span class="required">*</span></label>
          <input type="text" id="username" name="username"
                 value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                 autocomplete="username" required autofocus />
        </div>
        <div class="form-group">
          <label for="password">Password <span class="required">*</span></label>
          <input type="password" id="password" name="password"
                 autocomplete="current-password" required />
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:0.5rem">
          Masuk ke Dashboard →
        </button>
      </form>

      <p style="margin-top:1.5rem;text-align:center">
        <a href="<?= APP_URL ?>/" style="font-size:0.8rem;color:var(--warm-gray);text-decoration:none">
          ← Kembali ke Website
        </a>
      </p>
    </div>
  </div>

</div>
</body>
</html>
