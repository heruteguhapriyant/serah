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

        if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
            $_SESSION['admin']    = true;
            $_SESSION['username'] = $username;
            $this->redirect('/admin');
        }

        $this->view('admin/auth/login', ['error' => 'Username atau password salah.']);
    }

    public function logout(): void {
        session_destroy();
        $this->redirect('/admin/login');
    }
}
