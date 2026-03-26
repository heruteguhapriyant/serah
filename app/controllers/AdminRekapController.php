<?php
// app/controllers/AdminRekapController.php

class AdminRekapController extends Controller {
    private RekapModel $model;

    public function __construct() {
        $this->model = new RekapModel();
    }

    public function index(): void {
        $this->requireAdmin();
        $rekaps = $this->model->getAll();
        $this->view('admin/rekap/index', ['rekaps' => $rekaps]);
    }

    public function create(): void {
        $this->requireAdmin();
        $this->view('admin/rekap/form', ['rekap' => null, 'errors' => []]);
    }

    public function store(): void {
        $this->requireAdmin();
        $errors = $this->validate($_POST);
        if ($errors) {
            $this->view('admin/rekap/form', ['rekap' => $_POST, 'errors' => $errors]);
            return;
        }
        $this->model->create($this->sanitize($_POST));
        $this->redirect('/admin/rekap');
    }

    public function edit(string $id): void {
        $this->requireAdmin();
        $rekap = $this->model->find((int)$id);
        if (!$rekap) $this->redirect('/admin/rekap');
        $this->view('admin/rekap/form', ['rekap' => $rekap, 'errors' => []]);
    }

    public function update(string $id): void {
        $this->requireAdmin();
        $errors = $this->validate($_POST);
        if ($errors) {
            $this->view('admin/rekap/form', ['rekap' => array_merge($_POST, ['id' => $id]), 'errors' => $errors]);
            return;
        }
        $this->model->update((int)$id, $this->sanitize($_POST));
        $this->redirect('/admin/rekap');
    }

    public function delete(string $id): void {
        $this->requireAdmin();
        $this->model->delete((int)$id);
        $this->redirect('/admin/rekap');
    }

    private function validate(array $data): array {
        $errors = [];
        if (empty($data['judul']))    $errors['judul']    = 'Judul wajib diisi.';
        if (empty($data['deskripsi'])) $errors['deskripsi'] = 'Deskripsi wajib diisi.';
        if (empty($data['tanggal'])) $errors['tanggal']  = 'Tanggal wajib diisi.';
        if (empty($data['pdf_url'])) $errors['pdf_url']  = 'URL PDF wajib diisi.';
        return $errors;
    }

    private function sanitize(array $data): array {
        return [
            'judul'     => htmlspecialchars(trim($data['judul'])),
            'deskripsi' => htmlspecialchars(trim($data['deskripsi'])),
            'tanggal'   => $data['tanggal'],
            'foto_url'  => trim($data['foto_url'] ?? ''),
            'pdf_url'   => trim($data['pdf_url']),
        ];
    }
}
