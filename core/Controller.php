<?php
// core/Controller.php

class Controller {

    protected function view(string $path, array $data = []): void {
        extract($data);
        $viewFile = APP_ROOT . '/app/views/' . $path . '.php';
        if (!file_exists($viewFile)) {
            die("View not found: $path");
        }
        require $viewFile;
    }

    protected function redirect(string $url): void {
        header('Location: ' . APP_URL . $url);
        exit;
    }

    protected function isAdmin(): bool {
        return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
    }

    protected function requireAdmin(): void {
        if (!$this->isAdmin()) {
            $this->redirect('/admin/login');
        }
    }

    protected function json(mixed $data, int $code = 200): void {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
