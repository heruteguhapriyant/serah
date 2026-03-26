<?php
// app/controllers/AdminProgramController.php

class AdminProgramController extends Controller {
    private ProgramModel $model;

    public function __construct() {
        $this->model = new ProgramModel();
    }

    public function index(): void {
        $this->requireAdmin();
        $programs = $this->model->getActive();
        $this->view('admin/program/index', ['programs' => $programs]);
    }

    public function create(): void {
        $this->requireAdmin();
        $this->view('admin/program/form', ['program' => null, 'errors' => []]);
    }

    public function store(): void {
        $this->requireAdmin();
        $errors = $this->validate($_POST);
        if ($errors) {
            $this->view('admin/program/form', ['program' => $_POST, 'errors' => $errors]);
            return;
        }
        $this->model->create($this->sanitize($_POST));
        $this->redirect('/admin/program');
    }

    public function edit(string $id): void {
        $this->requireAdmin();
        $program = $this->model->find((int)$id);
        if (!$program) $this->redirect('/admin/program');
        $this->view('admin/program/form', ['program' => $program, 'errors' => []]);
    }

    public function update(string $id): void {
        $this->requireAdmin();
        $errors = $this->validate($_POST);
        if ($errors) {
            $this->view('admin/program/form', ['program' => array_merge($_POST, ['id' => $id]), 'errors' => $errors]);
            return;
        }
        $this->model->update((int)$id, $this->sanitize($_POST));
        $this->redirect('/admin/program');
    }

    public function delete(string $id): void {
        $this->requireAdmin();
        $this->model->delete((int)$id);
        $this->redirect('/admin/program');
    }

    private function validate(array $data): array {
        $errors = [];
        if (empty($data['judul']))    $errors['judul']    = 'Judul wajib diisi.';
        if (empty($data['deskripsi'])) $errors['deskripsi'] = 'Deskripsi wajib diisi.';
        if (empty($data['tanggal'])) $errors['tanggal']  = 'Tanggal wajib diisi.';
        return $errors;
    }

    private function sanitize(array $data): array {
        return [
            'judul'     => htmlspecialchars(trim($data['judul'])),
            'deskripsi' => htmlspecialchars(trim($data['deskripsi'])),
            'tanggal'   => $data['tanggal'],
            'foto_url'  => trim($data['foto_url'] ?? ''),
        ];
    }
}
