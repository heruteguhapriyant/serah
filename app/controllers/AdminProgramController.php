<?php
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
        $data = $this->sanitize($_POST);
        $data['foto_url'] = $this->uploadFoto() ?? '';
        $this->model->create($data);
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
            $this->view('admin/program/form', [
                'program' => array_merge($_POST, ['id' => $id]),
                'errors'  => $errors
            ]);
            return;
        }
        $data = $this->sanitize($_POST);
        $uploadedFoto     = $this->uploadFoto();
        $data['foto_url'] = $uploadedFoto ?? ($_POST['foto_url_lama'] ?? '');
        $this->model->update((int)$id, $data);
        $this->redirect('/admin/program');
    }

    public function delete(string $id): void {
        $this->requireAdmin();
        $this->model->delete((int)$id);
        $this->redirect('/admin/program');
    }

    public function detail(string $id): void {
        $program = $this->model->find((int)$id);
        if (!$program) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }
        $this->view('public/program/detail', ['program' => $program]);
    }

    private function uploadFoto(): ?string {
        if (empty($_FILES['foto']['name'])) return null;

        $file    = $_FILES['foto'];
        $maxSize = 2 * 1024 * 1024;
        $allowed = ['image/jpeg', 'image/png', 'image/webp'];
        $ext     = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];

        if ($file['error'] !== UPLOAD_ERR_OK) return null;
        if ($file['size'] > $maxSize) return null;

        $mime = mime_content_type($file['tmp_name']);
        if (!in_array($mime, $allowed)) return null;

        $filename  = uniqid('prog_', true) . '.' . $ext[$mime];
        $uploadDir = APP_ROOT . '/public/uploads/program/';

        if (!is_dir($uploadDir)) mkdir($uploadDir, 0775, true);
        if (!move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) return null;

        return APP_URL . '/uploads/program/' . $filename;
    }

    private function validate(array $data): array {
        $errors = [];
        if (empty($data['judul']))     $errors['judul']     = 'Judul wajib diisi.';
        if (empty($data['deskripsi'])) $errors['deskripsi'] = 'Deskripsi wajib diisi.';
        if (empty($data['tanggal']))   $errors['tanggal']   = 'Tanggal wajib diisi.';
        return $errors;
    }

    private function sanitize(array $data): array {
        return [
            'judul'     => htmlspecialchars(trim($data['judul'])),
            'deskripsi' => htmlspecialchars(trim($data['deskripsi'])),
            'isi'       => trim($data['isi'] ?? ''),
            'tanggal'   => $data['tanggal'],
            'foto_url'  => '',
        ];
    }
}