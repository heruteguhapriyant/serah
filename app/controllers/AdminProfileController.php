<?php
// app/controllers/AdminProfileController.php

class AdminProfileController extends Controller {
    private AdminModel $model;

    public function __construct() {
        $this->model = new AdminModel();
    }

    public function index(): void {
        $this->requireAdmin();
        $admin = $this->model->findByUsername($_SESSION['username']); // ← fix
        $this->view('admin/profile/index', [
            'admin'   => $admin,
            'errors'  => [],
            'success' => null,
        ]);
    }

    public function update(): void {
        $this->requireAdmin();
        $admin  = $this->model->findByUsername($_SESSION['username']); // ← fix
        $errors = [];

        $newUsername = trim($_POST['username'] ?? '');
        if (empty($newUsername)) {
            $errors['username'] = 'Username tidak boleh kosong.';
        } elseif ($newUsername !== $admin['username']) {
            $ok = $this->model->updateUsername($admin['id'], $newUsername);
            if (!$ok) {
                $errors['username'] = 'Username sudah digunakan.';
            } else {
                $_SESSION['username'] = $newUsername; // ← fix
                $admin['username'] = $newUsername;
            }
        }

        // ── Ganti password (opsional, hanya jika diisi) ─────────
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword     = $_POST['new_password']     ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if ($newPassword !== '' || $currentPassword !== '') {
            if (!password_verify($currentPassword, $admin['password'])) {
                $errors['current_password'] = 'Password saat ini salah.';
            } elseif (strlen($newPassword) < 8) {
                $errors['new_password'] = 'Password baru minimal 8 karakter.';
            } elseif ($newPassword !== $confirmPassword) {
                $errors['confirm_password'] = 'Konfirmasi password tidak cocok.';
            } else {
                $hash = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]);
                $this->model->updatePassword($admin['id'], $hash);
            }
        }

        $success = empty($errors) ? 'Profil berhasil diperbarui.' : null;

        $this->view('admin/profile/index', [
            'admin'   => $admin,
            'errors'  => $errors,
            'success' => $success,
        ]);
    }
}