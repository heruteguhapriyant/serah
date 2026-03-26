<?php
// app/controllers/AuthController.php

class AuthController extends Controller {

    public function showLogin(): void {
        if ($this->isAdmin()) {
            $this->redirect('/admin');
        }
        $this->view('admin/auth/login', ['error' => '']);
    }

    public function login(): void {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $adminModel = new AdminModel();
        $admin      = $adminModel->findByUsername($username);

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin']          = true;
            $_SESSION['admin_id']       = $admin['id'];
            $_SESSION['username']       = $admin['username'];
            $this->redirect('/admin');
        }

        $this->view('admin/auth/login', ['error' => 'Username atau password salah.']);
    }

    public function logout(): void {
        session_destroy();
        $this->redirect('/admin/login');
    }
}